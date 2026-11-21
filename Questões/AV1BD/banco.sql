CREATE TABLE usuario (
    IDusuario INT NOT NULL,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(50),
    PRIMARY KEY (IDusuario)
);

CREATE TABLE pergunta (
    IDpergunta INT NOT NULL,
    pergunta VARCHAR(255),
    PRIMARY KEY (IDpergunta)
);

CREATE TABLE resposta (
    IDresposta INT NOT NULL,
    IDpergunta INT NOT NULL,
    resposta VARCHAR(255),
    certa INT,
    PRIMARY KEY (IDresposta),
    FOREIGN KEY (IDpergunta) REFERENCES pergunta(IDpergunta)
);