<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table cosplayer</title>
    <link rel="stylesheet" href="tabela.css">
</head>
<body>

    <div style="
    width: -webkit-fill-available;
">
    <div class="container" style="margin:100px">
    <?php
    
    
    $sql = "
            select * from Personagem
         ";
    $serverName = "localhost"; //serverName\instanceName
    $connectionInfo = array("Database" => "GeekFest");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if ($conn) {

    } else {
      echo "Erro: Sem conexão com banco de dados.<br />";
      die(print_r(sqlsrv_errors(), true));
    }
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
      die(print_r(sqlsrv_errors(), true));
    }
    echo '<table>
        <thead>
        <tr>
            <th>Cosplayer</th>
            <th>Personagem</th>
            <th>Idade</th>
        </tr>
        </thead>
        <tbody>
        ';
    while ($row = sqlsrv_fetch_array($stmt)) {
         echo '<tr>
         <th>'.$row['Nome'].'</th>'
         .'<th>'.$row['NomeArtistico'].'</th>' 
         .'<th>'.$row['Idade'].'</th>' 
         .'<th class="icone"><a href="tabela avaliacao.php?id='.$row['PersonagemId'].'" class="btnColor">Avaliar</button></th></tr>';         
    }
    echo '</tbody>
    </table>';

?>
    </div>
    </div>
</body>
</html>