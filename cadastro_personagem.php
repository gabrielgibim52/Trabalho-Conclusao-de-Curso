<?php

if (isset($_POST['submit'])) {
    if (
        isset($_POST["nome"]) &&
        isset($_POST["nomeartistico"]) &&
        isset($_POST["idade"]) &&
        isset($_POST["origem"]) &&
        isset($_POST["instagram"]) &&
        isset($_POST["observacao"]) && 
        isset($_POST["regulamento"])
    ) {

        try {
            $nome = $_POST["nome"];
            $nomeartistico = $_POST["nomeartistico"];
            $idade = $_POST["idade"];
            $origem = $_POST["origem"];
            $instagram = $_POST["instagram"];
            $observacao = $_POST["observacao"];
            $File_Tmp = $_FILES['foto']['tmp_name'];
            $fp = fopen($File_Tmp, 'rb');
            $file_content = fread($fp, filesize($File_Tmp));
            $regulamento = $_POST["regulamento"];
            $sql = "
        INSERT INTO [dbo].[Personagem]
           (Nome
           ,NomeArtistico
           ,Idade
           ,Origem
           ,Instagram
           ,Observacao
           ,Foto
           ,Regulamento
          )
     VALUES
           (?
           ,?
           ,?
           ,?
           ,?
           ,?
           ,CONVERT(VARBINARY(max),?)
           ,?)
         ";
            $serverName = "localhost"; //serverName\instanceName
            $params = array($nome, $nomeartistico, $idade, $origem, $instagram, $observacao, $file_content, $regulamento);
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
        } catch (Exception $e) {
            die(print_r($e, true));
        }
    }
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro_personagem.css">
    <title>CADASTRO USUÁRIO</title>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="img_cadastro/personagem 3.png" alt="">
        </div>
        <div class="form">
            <form method="post" enctype="multipart/form-data">
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
                        <label for="nome">Nome Completo</label>
                        <input id="nome" type="text" name="nome" placeholder="Digite seu nome completo" required>
                    </div>

                    <div class="input-box">
                        <label for="nomeartistico">Nome Artístico</label>
                        <input id="nomeartistico" type="text" name="nomeartistico" placeholder="Digite seu nome artístico" required>
                    </div>


                    <div class="input-box">
                        <label for="idade">Idade</label>
                        <input id="idade" type="tel" name="idade" placeholder="Digite sua idade" required>
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
                        <h5>Anexe uma imagem do seu personagem abaixo:</h5>
                    </div>
                    <br>
                    <br>
                    <label class="picture" for="picture__input" tabIndex="0" >
                        <span class="picture__image"></span>
                    </label>

                    <input type="file" name="foto" id="picture__input" required>

                </div>

                <div class="gender-inputs">
                    <div class="gender-title">
                        <h6>Sobre o Regulamento:</h6>
                    </div>

                    <div class="gender-group">
                        <div class="gender-input">
                            <input id="regulamento" type="radio" name="regulamento" value="1" required>
                            <label for="female">Declaro que li e concordo com o regulamento do Concurso Cosplay GEEK FEST
                                2023.</label>
                        </div>

                    </div>

                    <div class="continue-button">
                        
                        <button type="submit" name="submit">Increver-se agora</button>
                    </div>
            </form>
        </div>
    </div>
    
    <script type="text/javascript" src="arquivo.js"></script>
    
</body>

</html>