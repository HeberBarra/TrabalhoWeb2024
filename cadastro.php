<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
    <script src="javascript/validarSenha.js" defer></script>
    <script src="javascript/alertar.js"></script>
    <script src="javascript/efetuarLogin.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Cadastro</h1>
        <div id="botoes">
            <button><a href="index.php">home</a></button>
        </div>
    </header>
    <main>
        <form method="post" action="cadastro.php">
            <label>Nome: <span class="aviso" id="aviso-nome" style="display: none">nome já registrado</span> <input type="text" name="nome" placeholder="Digite seu nome" maxlength="50"></label>
            <label>E-mail: <span class="aviso" id="aviso-email" style="display: none">e-mail já registrado</span> <input type="email" name="email" placeholder="fulano@example.com" maxlength="50" required></label>
            <label>Senha: <span class="aviso" id="aviso-senha" style="display: none">senhas não coincidem</span> <input type="password" name="senha" placeholder="Digite sua senha" required></label>
            <label>Confirmar senha: <input type="password" name="confirmarsenha" placeholder="Confirme sua senha"></label>
            <button type="button">ENVIAR</button>
        </form>
        <?php
            $connection = null;
            include "databaseConnector.php";

            $nome = $_POST["nome"] ?? null;
            $email = $_POST["email"] ?? null;
            $senha = $_POST["senha"] ?? null;

            if ($email != null && $senha != null) {
                cadastrarUsuario($connection, $nome, $email, $senha);
            }

            function cadastrarUsuario($connection, $nome, $email, $senha): void
            {
                $sqlCadastrarUsuario = "INSERT INTO tb_usuario(nome_usuario, email_usuario, senha_usuario) VALUES (?, ?, ?)";
                $queryCadastrarUsuario = $connection->prepare($sqlCadastrarUsuario);
                echo $connection->error;
                $hash = hash("sha256", $senha);
                $queryCadastrarUsuario->bind_param("sss", $nome, $email, $hash);

                try {
                    $queryCadastrarUsuario->execute();
                    efetuarLogin($nome, $email);
                } catch (mysqli_sql_exception $exception) {
                    if ($exception->getCode() != 1062) {
                        goto fechar;
                    }

                    if (str_contains($exception->getMessage(), "tb_usuario.un_Nometb_usuario")) {
                        echo "<script src='javascript/alertarNome.js'></script>";
                        goto fechar;
                    }

                    if (str_contains($exception->getMessage(), "tb_usuario.un_Emailtb_usuario")) {
                        echo "<script src='javascript/alertarEmail.js'></script>";
                        goto fechar;
                    }
                }

                fechar:
                $queryCadastrarUsuario->close();
            }

            function efetuarLogin(string | null $nome, string | null $email): void {
                if ($nome == null || $email == null) {
                    return;
                }

                echo "<script>efetuarLogin('$nome', '$email')</script>";
                echo "<script src='javascript/redirecionar.js'></script>";
            }
    ?>
    </main>
    <footer>
        Licença MIT &copy; Heber Ferreira Barra, Matheus Jun Alves Matuda.
    </footer>
</body>
</html>