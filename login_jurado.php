<?php
if (isset($_POST['submit'])) {
  if (
    isset($_POST["email"]) &&
    isset($_POST["password"])

  ) {

    $email = $_POST["email"];
    $senha = $_POST["password"];

    $sql = "
        SELECT UsuarioId,pf.PerfilId  FROM USUARIO u
        left join perfil pf on u.PerfilId=pf.PerfilId 
        WHERE EMAIL= ?  AND SENHA = ? 
         ";
    $serverName = "localhost"; //serverName\instanceName
    $params = array($email, $senha);
    $connectionInfo = array("Database" => "GeekFest");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if ($conn) {

    } else {
      echo "Erro: Sem conexão com banco de dados.<br />";
      die(print_r(sqlsrv_errors(), true));
    }
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
      die(print_r(sqlsrv_errors(), true));
    }
    $return = sqlsrv_fetch_array($stmt);
    if ($return != null && $return["UsuarioId"] != 0) {
      if ($return["PerfilId"] == 1) {
        // redireciona pra tela de cosplay
      } else if ($return["PerfilId"] == 2) {
        session_start();
        $_SESSION["UsuarioId"]=$return["UsuarioId"];
        header("Location: tabela cosplayers.php");
        exit;
      }
    } else
      echo '<script>alert("Login ou senha incorretos");</script>'; //manter aqui e dar msg de erro
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ENTRAR - COSPLAYER</title>
  <link rel="stylesheet" href="login_jurado.css">
  <script src="https://kit.fontawesome.com/cf6fa412bd.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <div class="buttonsForm">
      <div class="btnColor"></div>
    </div>
    <img class="geek-logo" src="img_cadastro/geek logo.png" alt="">
    <form id="signin" method="post">
      <input type="text" name="email" placeholder="Email" required />
      <i class="fas fa-envelope iEmail"></i>
      <input type="password" name="password" placeholder="Password" required />
      <i class="fas fa-lock iPassword"></i>
      <div class="jurado">
        <a href="cadastro_jurado.php">Cadastre-se como Jurado</a>
      </div>
      
      <div class="divCheck">
      </div>
      <button type="submit" name="submit">ENTRAR</button>
    </form>
    <img class="img-final" src="img_cadastro/logo legal.png" alt="">

    <!-- <form id="signup">
      <input type="text" name="email" placeholder="Email" required />
      <i class="fas fa-envelope iEmail"></i>
      <input type="password" name="password" placeholder="Password" required />
      <i class="fas fa-lock iPassword"></i>
      
      <div class="divCheck">
        <input type="checkbox" required />
        <span>Terms</span>
      </div>
      <button type="submit">Sign up</button>
    </form> -->
  </div>

  <script src="index.js"></script>
</body>

</html>