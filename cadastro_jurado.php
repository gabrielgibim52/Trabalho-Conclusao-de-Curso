<?php

if (isset($_POST['submit'])) {
            
    if (
        isset($_POST["firstname"]) &&
        isset($_POST["lastname"]) &&
        isset($_POST["date"]) &&
        isset($_POST["number"]) &&
        isset($_POST["gender"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"]) &&
        isset($_POST["artistname"])

    ) {
        $nome = $_POST["firstname"];
        $sobrenome = $_POST["lastname"];
        $nascimento = $_POST["date"];
        $celular = $_POST["number"];
        $genero = $_POST["gender"];
        $email = $_POST["email"];
        $senha = $_POST["password"];
        $nomeArtistico = $_POST["artistname"];

        $sql = "
        DECLARE @table table (id int);
        INSERT INTO [dbo].[Pessoa]
                 (Nome
                 ,Sobrenome
                 ,Celular
                 ,Genero
                 ,DataNascimento
                 ,NomeArtistico)
                 OUTPUT Inserted.PessoaId into @table
                 VALUES(?,?,?,?,?,?);
                 INSERT INTO[dbo].[Usuario]
                         (Email
                         ,Senha
                         ,PessoaId
                         ,PerfilId)
                         VALUES(?,?,(SELECT id from @table),2)
         ";
        $serverName = "localhost"; //serverName\instanceName
        $params = array($nome, $sobrenome, $celular, $genero, $nascimento,$nomeArtistico,$email,$senha);
        $connectionInfo = array("Database" => "GeekFest");
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        if ($conn) {
            echo "Conexão Realizada com sucesso.<br />";
        } else {
            echo "Erro: Sem conexão com banco de dados.<br />";
            die(print_r(sqlsrv_errors(), true));
        }
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        
    }
        header("Location: login jurado.php");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro_jurado.css">
    <title>CADASTRO USUÁRIO</title>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="img_cadastro/personagem 3.png" alt="">
        </div>
        <div class="form">
            <form method="POST">
                <div class="form-header">
                    <div class="title">
                        <h1>Cadastre-se</h1>
                    </div>
                    <div class="login-button">
                        <button><a href="login_jurado.php">Login</a></button>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="firstname">Primeiro Nome</label>
                        <input id="firstname" type="text" name="firstname" placeholder="Digite seu primeiro nome" required>
                    </div>

                    <div class="input-box">
                        <label for="lastname">Sobrenome</label>
                        <input id="lastname" type="text" name="lastname" placeholder="Digite seu sobrenome" required>
                    </div>
                    <div class="input-box">
                        <label for="artistname">Nome Artístico</label>
                        <input id="artistname" type="text" name="artistname" placeholder="Digite seu nome artístico" required>
                    </div>
                    
                    <div class="input-box">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>

                    <div class="input-box">
                        <label for="password">Senha</label>
                        <input id="password" type="password" name="password" placeholder="Digite sua senha" required maxlength="18">
                    </div>
                    <div class="input-box">
                        <label for="number">Celular</label>
                        <input id="number" type="tel" name="number" placeholder="(xx) xxxx-xxxx" required>
                    </div>

                    <div class="input-box">
                        <label class="date" for="date">Data de Nascimento</label>
                        <input class="date" id="date" type="date" name="date" placeholder="Digite sua Data de Nascimento" required>
                    </div>
                </div>

                <div class="gender-inputs">
                    <div class="gender-title">
                        <h6>Gênero</h6>
                    </div>

                    <div class="gender-group">
                        <div class="gender-input">
                            <input id="female" type="radio" name="gender" value="Feminino">
                            <label for="female">Feminino</label>
                        </div>

                        <div class="gender-input">
                            <input id="male" type="radio" name="gender" value="Masculino">
                            <label for="male">Masculino</label>
                        </div>

                        <div class="gender-input">
                            <input id="others" type="radio" name="gender" value="Outros">
                            <label for="others">Outros</label>
                        </div>

                        <div class="gender-input">
                            <input id="none" type="radio" name="gender" value="Prefiro não dizer">
                            <label for="none">Prefiro não dizer</label>
                        </div>
                    </div>
                </div>

                <div class="continue-button">
                    <input type="submit" name="submit" value="Continuar">
                </div>
            </form>
        </div>
    </div>
</body>

</html>