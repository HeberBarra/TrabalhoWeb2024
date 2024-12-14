<!doctype html>
<html lang="pt-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="javascript/alertar.js"></script>
    <script src="javascript/efetuarLogin.js"></script>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <main>
        <form action="login.php" method="POST">
            <label>E-mail: <span class="aviso" id="aviso-dados" style="display: none">dados de login inválidos</span> <input type="email" name="email" required></label>
            <label>Senha: <input type="password" name="senha" required></label>
            <button type="submit">ENVIAR</button>
        </form>
        <?php
            $connection = null;
            include "databaseConnector.php";

            $email = $_POST["email"] ?? null;
            $senha = $_POST["senha"] ?? null;

            if ($email != null && $senha != null) {
                efetuarLogin($email, $senha);
            }

            function efetuarLogin(string $email, string $senha): void {
                global $connection;
                $sqlVerificarLogin = "SELECT nome_usuario, email_usuario FROM tb_usuario WHERE email_usuario = ? AND senha_usuario = ?";
                $hashSenha = hash("sha256", $senha);
                $verificarLogin = $connection->prepare($sqlVerificarLogin);
                $verificarLogin->bind_param("ss", $email, $hashSenha);
                $verificarLogin->execute();
                $resultado = $verificarLogin->get_result()->fetch_assoc();

                if ($resultado) {
                    $nome = $resultado["nome_usuario"];
                    $email = $resultado["email_usuario"];
                    echo "<script>efetuarLogin('$nome', '$email')</script>";
                    echo "<script src='javascript/redirecionar.js'></script>";
                    return;
                }

                echo "<script src='javascript/alertarLogin.js'></script>";
            }
        ?>
    </main>
    <footer>
        Licença MIT &copy; Heber Ferreira Barra, Matheus Jun Alves Matuda.
    </footer>
</body>
</html>