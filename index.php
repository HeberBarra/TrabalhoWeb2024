<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="javascript/pegarDadosLogin.js" defer></script>
    <script src="javascript/contadorCaracteres.js" defer></script>
    <script src="javascript/controleBotaoComentario.js" defer></script>
    <script src="javascript/index.js"></script>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Meus Desenhos Japoneses</title>
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Meus Desenhos Japoneses</h1>
        <div id="botoes">
            <button><a href="login.php">login</a></button>
            <button><a href="cadastro.php">cadastro</a></button>
            <button><a href="perfil.php" id="link-perfil">perfil</a></button>
        </div>
    </header>
    <main>
        <?php
            global $connection;
            include "databaseConnector.php"
        ?>
        <form action="index.php" method="POST">
            <label>Comentário: <span id="quantidade">0</span>/255 caracteres <input type="text" name="comentario" maxlength="255" required></label>
            <button type="submit" id="botao-comentario">ENVIAR</button>
        </form>
        <?php
            $nome = $_GET["nome"] ?? NULL;
            $comentario = $_POST["comentario"] ?? NULL;

            if ($nome != NULL && $comentario != NULL) {
                salvarComentario($nome, $comentario);
            }

            function salvarComentario(string | null $nome, string | null $comentario): void {
                global $connection;
                $sqlPegarID = "SELECT id_usuario FROM tb_usuario WHERE nome_usuario = ?";
                $pegarID = $connection->prepare($sqlPegarID);
                $pegarID->bind_param("s", $nome);
                $id = NULL;
                $pegarID->bind_result($id);
                $pegarID->execute();
                $pegarID->fetch();
                $pegarID->close();

                $sqlSalvarComentario = "INSERT INTO tb_comentario(id_usuario, texto_comentario) VALUES (?, ?)";
                $salvarComentario = $connection->prepare($sqlSalvarComentario);
                $salvarComentario->bind_param("ss", $id, $comentario);
                $salvarComentario->execute();
                $salvarComentario->close();
            }
        ?>
        <article id="comentarios">
            <?php
                $sqlMostrarComentarios = "SELECT tb_usuario.id_usuario, tb_usuario.nome_usuario, tb_comentario.id_comentario, tb_comentario.texto_comentario
                                          FROM tb_comentario INNER JOIN tb_usuario ON tb_comentario.id_usuario = tb_usuario.id_usuario";
                $mostrarComentarios = $connection->prepare($sqlMostrarComentarios);
                $mostrarComentarios->execute();
                $resultados = $mostrarComentarios->get_result();
                $valores = $resultados->fetch_assoc();
                while ($valores != null) {
                    $idUsuario = $valores["id_usuario"];
                    $idComentario = $valores["id_comentario"];
                    $nomeUsuario = $valores["nome_usuario"];
                    $texto_comentario = $valores["texto_comentario"];

                    echo "<div class='comentario'>";
                    echo "<h4>$idComentario - $nomeUsuario <button><a href='apagar.php?nome=$nome&idComentario=$idComentario'>apagar</a></button></h4>";
                    echo "<p>$texto_comentario</p>";
                    echo "</div>";

                    $valores = $resultados->fetch_assoc();
                }
            ?>
        </article>
    </main>
    <footer>
        Licença MIT &copy; Heber Ferreira Barra, Matheus Jun Alves Matuda.
    </footer>
</body>
</html>