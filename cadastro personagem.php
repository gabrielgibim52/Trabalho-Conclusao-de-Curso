<?php

if (isset($_POST['submit'])) {
    if (
        isset($_POST["nome"]) &&
        isset($_POST["nomeartistico"]) &&
        isset($_POST["idade"]) &&
        isset($_POST["origem"]) &&
        isset($_POST["instagram"]) &&
        isset($_POST["oservacao"]) &&
        isset($_POST["foto"]) &&
        isset($_POST["regulamento"]) 

    ) {
        $nome = $_POST["firstname"];
        $NomeArtistico = $_POST["lastname"];
        $idade = $_POST["idade"];
        $origem = $_POST["origem"];
        $instagram = $_POST["instagram"];
        $observacao = $_POST["observacao"];
        $foto = $_POST["foto"];
        $regulamento = $_POST["regulamento"];

        $sql = "
        DECLARE @table table (id int);
        INSERT INTO [dbo].[Personagem]
           (Nome
           ,NomeArtistico
           ,Idade
           ,Origem
           ,Instagram
           ,Observacao
           ,Foto
           ,Regulamento
           ,UsuarioId)
     VALUES
           (?
           ,?
           ,?
           ,?
           ,?
           ,?
           ,?
           ,?
           ,?)
         ";
        $serverName = "localhost"; //serverName\instanceName
        $params = array($nome, $nomeartistico, $idade, $origem, $instagram,$observacao,$foto,$regulamento,$UsuarioId);
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
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro personagem.css">
    <title>CADASTRO USUÁRIO</title>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="img_cadastro/personagem 3.png" alt="">
        </div>
        <div class="form">
            <form action="" method="post">
                <div class="form-header">
                    <div class="title">
                        <h1>Cadastre seu Personagem</h1>
                    </div>
                    <!-- <div class="login-button">
                        <button><a href="#">Login</a></button>
                    </div> -->
                </div>

                <div class="input-group">
                    <div class="input-box">
                        <label for="firstname">Nome Completo</label>
                        <input id="firstname" type="text" name="firstname" placeholder="Digite seu nome completo" required>
                    </div>

                    <div class="input-box">
                        <label for="lastname">Nome Artístico</label>
                        <input id="lastname" type="text" name="lastname" placeholder="Digite seu nome artístico" required>
                    </div>
                    

                    <div class="input-box">
                        <label for="number">Idade</label>
                        <input id="number" type="tel" name="number" placeholder="Digite sua idade" required>
                    </div>

                    <div class="input-box">
                        <label for="origem">Qual a origem do seu Personagem?</label>
                        <input id="origem" type="text" name="origem" placeholder="Filme, Série, Anime, etc.." required>
                    </div>

                    <div class="input-box">
                        <label for="instagram">Instagram</label>
                        <input id="instagram" type="text" name="instagram" placeholder="Exemplo @personagem" required>
                    </div>

                    <div class="input-box">
                        <label for="observacao">Observações</label>
                        <input id="observacao" type="text" name="observacao" placeholder="Digite alguma observação">
                    </div>
                    <div class="title-box">
                        <h5>Anexe uma imagem do seu personagem abaixo</h5>
                    </div>
                    <br>
                    <br>
                    <label class="picture" for="picture__input" tabIndex="0">
                        <span class="picture__image"></span>
                      </label>
                      
                      <input type="file" name="picture__input" id="picture__input">

                </div>

                <div class="gender-inputs">
                    <div class="gender-title">
                        <h6>Sobre o Regulamento:</h6>
                    </div>

                    <div class="gender-group">
                        <div class="gender-input">
                            <input id="female" type="radio" name="gender">
                            <label for="female">Declaro que li e concordo com o regulamento do Concurso Cosplay GEEK FEST
                                2023.</label>
                        </div>
                       
                </div>

                <div class="continue-button">
                <button type="submit" name="submit"><a href="inscrito.php">Increver-se agora</a></button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="arquivo.js"></script>
</body>

</html>