<?php
    global $connection;
    include "databaseConnector.php";

    $nomeUsuarioAtual = $_GET["nome"];
    $idComentario = $_GET["idComentario"];

    if ($nomeUsuarioAtual == NULL || $idComentario == NULL) goto redirecionar;

    $sqlPegarIdUsuarioAtual = "SELECT id_usuario FROM tb_usuario WHERE tb_usuario.nome_usuario = ?";
    $pegarIdUsuarioAtual = $connection->prepare($sqlPegarIdUsuarioAtual);
    $pegarIdUsuarioAtual->bind_param("s", $nomeUsuarioAtual);
    $pegarIdUsuarioAtual->bind_result($id);
    $pegarIdUsuarioAtual->execute();
    $pegarIdUsuarioAtual->fetch();
    $pegarIdUsuarioAtual->close();

    $sqlApagarComentario = "DELETE FROM tb_comentario WHERE id_comentario = ? AND id_usuario = ?";
    $apagarComentario = $connection->prepare($sqlApagarComentario);
    $apagarComentario->bind_param("ii", $idComentario, $id);
    $apagarComentario->execute();
    $apagarComentario->execute();

    redirecionar:
    echo "<script src='javascript/redirecionar.js'></script>";
