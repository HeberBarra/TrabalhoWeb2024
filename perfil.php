<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css" >
    <script src="javascript/efetuarLogin.js"></script>
    <script src="javascript/validarSenha.js" defer></script>
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Perfil</h1>
        <div id="botoes">
            <button><a href="index.html">home</a></button>
        </div>
    </header>
    <main>
        <?php
            $nome = $_POST["nome"] ?? NULL;
            $email = $_POST["email"] ?? NULL;
            $senhaAtual = $_POST["password"] ?? NULL;
            $novaSenha = $_POST["senha"] ?? NULL;

            $connection = null;
            include "databaseConnector.php";

            if ($nome == NULL || $email == NULL || $senhaAtual == NULL) {
                goto fim;
            }

            if ($novaSenha == NULL) {
                atualizarDados($nome, $email, $senhaAtual);
            } else {
                atualizarDadosSenha($nome, $email, $senhaAtual, $novaSenha);
            }

            function atualizarDados($nome, $email, $senhaAtual): void {
                global $connection;
                $nomeAntigo = $_GET["nome"] ?? NULL;

                if ($nomeAntigo == NULL) return;

                $sqlAtualizarDados = "UPDATE tb_usuario SET nome_usuario = (?), email_usuario = (?) WHERE senha_usuario = (?) AND nome_usuario = (?) LIMIT 1";
                $atualizarDados = $connection->prepare($sqlAtualizarDados);
                $hashSenha = hash("sha256", $senhaAtual);
                $atualizarDados->bind_param("ssss", $nome, $email, $hashSenha, $nomeAntigo);
                $atualizarDados->execute();

                if ($atualizarDados->affected_rows == 1) {
                    echo "<script>efetuarLogin('$nome', '$email')</script>";
                    echo "<script src='javascript/atualizarPerfil.js'></script>";
                }


                $atualizarDados->close();
            }

            function atualizarDadosSenha($nome, $email, $senhaAtual, $novaSenha): void {
                global $connection;
                $nomeAntigo = $_GET["nome"] ?? NULL;

                if ($nomeAntigo == NULL) return;

                $sqlAtualizarDados = "UPDATE tb_usuario SET nome_usuario = ?, email_usuario = ?, senha_usuario = ? WHERE senha_usuario = ? AND nome_usuario = ? LIMIT 1";
                $atualizarDados = $connection->prepare($sqlAtualizarDados);
                $hashSenhaAtual = hash("sha256", $senhaAtual);
                $hashSenhaNova = hash("sha256", $novaSenha);
                $atualizarDados->bind_param("sssss", $nome, $email, $hashSenhaNova, $hashSenhaAtual, $nomeAntigo);
                $atualizarDados->execute();

                if ($atualizarDados->affected_rows == 1) {
                    echo "<script>efetuarLogin('$nome', '$email')</script>";
                    echo "<script src='javascript/atualizarPerfil.js'></script>";
                }

                $atualizarDados->close();
            }

            fim:
        ?>

        <?php
            $nome = $_GET["nome"] ?? NULL;
            $email = $_GET["email"] ?? NULL;

            if ($nome == NULL || $email == NULL) {
                echo "É necessário efetuar login para visualizar o perfil";
                goto fim;
            }

            echo "<form action='perfil.php?nome=$nome&email=$email' method='POST'>";
            echo "<label>Nome: <input type='text' name='nome' value='$nome' required></label>";
            echo "<label>E-mail: <input type='email' name='email' value='$email' required></label>";
            echo "<label>Senha: <input type='password' name='password' required></label>";
            echo "<label>Nova senha: <span class='aviso' style='display: none'  id='aviso-senha'></span> <input type='password' name='senha'></label>";
            echo "<label>Confirmar senha: <input type='password' name='confirmarsenha'></label>";
            echo "<button type='button'>SALVAR</button>";
            echo "</form>";
        ?>
    </main>
    <footer>
        Licença MIT &copy; Heber Ferreira Barra, Matheus Jun Alves Matuda.
    </footer>
</body>
</html>