<script src="typescript/redirecionar.ts"></script>
<?php
    include "databaseConnector.php";

    $nome = $_POST["nome"] ?? null;
    $email = $_POST["email"] ?? null;
    $senha = $_POST["senha"] ?? null;

    if ($email == null || $senha == null) return;

    $sqlCadastrarUsuario = "INSERT INTO tb_usuario(nome_usuario, email_usuario, senha_usuario) VALUES (?, ?, ?)";
    $queryCadastrarUsuario = $connection->prepare($sqlCadastrarUsuario);
    echo $connection->error;
    $hash = hash("sha256", $senha);
    $queryCadastrarUsuario->bind_param("sss", $nome, $email, $hash);
    $queryCadastrarUsuario->execute();
    $queryCadastrarUsuario->close();
