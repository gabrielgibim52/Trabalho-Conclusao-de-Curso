<?php
$personagem= $_GET['id'];
session_start();
$UsuarioId=$_SESSION["UsuarioId"];
$sql = "
        select * from conceito
     ";
$serverName = "localhost"; //serverName\instanceName
$connectionInfo = array("Database" => "GeekFest");
$conn = sqlsrv_connect($serverName, $connectionInfo);
if ($conn) {

} else {
  echo "Erro: Sem conexão com banco de dados.<br />";
  die(print_r(sqlsrv_errors(), true));
}
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );
$row_count = sqlsrv_num_rows($stmt);
if ($stmt === false) {
  die(print_r(sqlsrv_errors(), true));
}

if (isset($_POST['submit'])) {
    while ($row = sqlsrv_fetch_array($stmt)) {
        $id=$row['ConceitoId'];
        $nota = $_POST["conceito$id"];
        $sql = "
        INSERT INTO [dbo].[Avaliacao]
           ([Nota]
           ,[Data]
           ,[PersonagemId]
           ,[UsuarioId]
           ,[ConceitoId])
        VALUES
            (?
            ,?
            ,?
            ,?
            ,?)";
        $params = array($nota, date("d-m-Y H:i:s"), $personagem, $UsuarioId,$id);
        $stmt2 = sqlsrv_query($conn, $sql, $params);
        if ($stmt2 === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }
   
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table avaliação</title>
    <link rel="stylesheet" href="tabela.css">
</head>
<body>
<form method="POST">

    <div class="container">

    <?php
    
    echo '
    <table>
        <thead>
        <tr>
            <th>Conceito</th>
            <th>Nota</th>
        </tr>
        </thead>
        <tbody>
        ';
    while ($row = sqlsrv_fetch_array($stmt)) {
        
         echo '<tr>
         <th>'.$row['Descricao'].'</th>'
         .'<th><input type="number" name="conceito'.$row['ConceitoId'].'"></input></th></tr>' ;
        
    }
    echo '</tbody>
    </table>
    ';

?>

    </div>
    <input type="submit" class="btnColor" name="submit" value="Salvar">
    </form>
</body>
</html>