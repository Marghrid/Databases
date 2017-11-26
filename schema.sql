/* schema.sql: Ficheiro de criação do esquema da base de dados. */
/* schema.sql: Ficheiro de criação do esquema da base de dados. */

CREATE TYPE tipo_lado   AS ENUM ('direito', 'esquerdo');
CREATE TYPE tipo_altura AS ENUM ('chao', 'medio', 'superior');

CREATE TABLE categoria(
    nome VARCHAR(200) NOT NULL,
    PRIMARY KEY (nome)
);

CREATE TABLE categoria_simples(
    nome VARCHAR(200) NOT NULL,
    PRIMARY KEY (nome),
    FOREIGN KEY (nome) REFERENCES categoria(nome)
);

CREATE TABLE super_categoria(
    nome VARCHAR(200) NOT NULL,
    PRIMARY KEY (nome),
    FOREIGN KEY (nome) REFERENCES categoria(nome)
);

CREATE TABLE constituida(
    super_categoria VARCHAR(200)    NOT NULL,
    categoria       VARCHAR(200)    NOT NULL,
    PRIMARY KEY (super_categoria, categoria),
    FOREIGN KEY (categoria)         REFERENCES categoria(nome),
    FOREIGN KEY (super_categoria)   REFERENCES super_categoria(nome),
    CHECK (super_categoria != categoria)
);

CREATE TABLE fornecedor(
    nif  NUMERIC(9)     NOT NULL,  -- NIF tem sempre 9 digitos
    nome VARCHAR(200)   NOT NULL,
    PRIMARY KEY (nif)
);

CREATE TABLE produto(
    ean           NUMERIC(13)   NOT NULL, -- EAN tem sempre 13 digitos
    design        VARCHAR(200)  NOT NULL,
    categoria     VARCHAR(200)  NOT NULL,
    forn_primario NUMERIC(9)    NOT NULL,
    data          DATE          NOT NULL,
    PRIMARY KEY (ean),
    FOREIGN KEY (categoria)     REFERENCES categoria(nome),
    FOREIGN KEY (forn_primario) REFERENCES fornecedor(nif)
);

CREATE TABLE fornece_sec(
    nif NUMERIC(9)  NOT NULL,
    ean NUMERIC(13) NOT NULL,
    PRIMARY KEY (nif, ean),
    FOREIGN KEY (ean) REFERENCES produto(ean)
);

CREATE TABLE corredor(
    nro     SMALLINT    NOT NULL,  -- o supermercado tem menos de 32767 corredores
    largura SMALLINT    NOT NULL,  -- em centimetros. Corredor tem menos de 327 metros
    PRIMARY KEY (nro)
);

CREATE TABLE prateleira(
    nro    SMALLINT     NOT NULL,
    lado   tipo_lado    NOT NULL,  -- "esquerdo" ou "direito"
    altura tipo_altura  NOT NULL,  -- "chão", "médio" ou "superior"
    PRIMARY KEY (nro, lado, altura),
    FOREIGN KEY (nro) REFERENCES corredor
);

CREATE TABLE planograma(
    ean      NUMERIC(13)    NOT NULL,
    nro      SMALLINT       NOT NULL,
    lado     tipo_lado      NOT NULL,
    altura   tipo_altura    NOT NULL,
    face     SMALLINT       NOT NULL, -- número de frentes de produto visíveis
    unidades INT            NOT NULL,
    loc      INT            NOT NULL, -- número de slot. O supermercado tem menos de 2147483647 slots.
    PRIMARY KEY (ean, nro, lado, altura),
    FOREIGN KEY (ean)               REFERENCES produto(ean),
    FOREIGN KEY (nro, lado, altura) REFERENCES prateleira(nro, lado, altura)
);

CREATE TABLE evento_reposicao(
    operador    NUMERIC(9)  NOT NULL UNIQUE, -- nif do empregado
    instante    TIMESTAMP   NOT NULL UNIQUE CHECK (instante < CURRENT_TIMESTAMP),
    PRIMARY KEY (instante),
    UNIQUE (operador, instante)
);

CREATE TABLE reposicao(
    ean         NUMERIC(13) NOT NULL,
    nro         SMALLINT    NOT NULL,
    lado        tipo_lado   NOT NULL,
    altura      tipo_altura NOT NULL,
    operador    NUMERIC(9)  NOT NULL,
    instante    TIMESTAMP   NOT NULL,
    unidades    INT         NOT NULL,
    PRIMARY KEY (ean, nro, lado, altura, operador, instante),
    FOREIGN KEY (ean, nro, lado, altura)    REFERENCES  planograma(ean, nro, lado, altura),
    FOREIGN KEY (operador, instante)        REFERENCES  evento_reposicao(operador, instante)
);
