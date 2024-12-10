CREATE DATABASE bd_SistemaAnimes;

USE bd_SistemaAnimes;

CREATE TABLE tb_usuario (
    id_usuario INT AUTO_INCREMENT,
    nome_usuario VARCHAR(50) DEFAULT 'Anônimo',
    email_usuario VARCHAR(50) NOT NULL,
    senha_usuario CHAR(64) NOT NULL,
    CONSTRAINT pk_tb_usuario PRIMARY KEY (id_usuario),
    CONSTRAINT un_Nometb_usuario UNIQUE KEY(nome_usuario)
);

CREATE TABLE tb_comentario (
    id_comentario INT AUTO_INCREMENT,
    id_usuario INT,
    texto_comentario VARCHAR(255) NOT NULL,
    CONSTRAINT pk_tb_comentario PRIMARY KEY (id_comentario),
    CONSTRAINT fk_tb_usuario_tb_comentario FOREIGN KEY (id_usuario) REFERENCES tb_usuario(id_usuario)
);
