/* schema.sql: Ficheiro de criação do esquema da base de dados. */

DROP TABLE IF EXISTS reposicao;
DROP TABLE IF EXISTS evento_reposicao;
DROP TABLE IF EXISTS planograma;
DROP TABLE IF EXISTS prateleira;
DROP TABLE IF EXISTS corredor;
DROP TABLE IF EXISTS fornece_sec;
DROP TABLE IF EXISTS produto;
DROP TABLE IF EXISTS constituida;
DROP TABLE IF EXISTS fornecedor;
DROP TABLE IF EXISTS categoria_simples;
DROP TABLE IF EXISTS super_categoria;
DROP TABLE IF EXISTS categoria;

DROP TYPE IF EXISTS tipo_lado;
DROP TYPE IF EXISTS tipo_altura;


CREATE TYPE tipo_lado   AS ENUM ('direito', 'esquerdo');
CREATE TYPE tipo_altura AS ENUM ('chao', 'medio', 'superior');

CREATE TABLE categoria(
    nome VARCHAR(200) NOT NULL,
    PRIMARY KEY (nome)
);

CREATE TABLE categoria_simples(
    nome VARCHAR(200) NOT NULL,
    PRIMARY KEY (nome) ,
    FOREIGN KEY (nome) REFERENCES categoria(nome) ON DELETE CASCADE
    -- Se uma categoria simples for apagada de categoria, e automaticamente
    --  apagada de categoria_simples.
);

CREATE TABLE super_categoria(
    nome VARCHAR(200) NOT NULL,
    PRIMARY KEY (nome),
    FOREIGN KEY (nome) REFERENCES categoria(nome) ON DELETE CASCADE
);

CREATE TABLE constituida(
    super_categoria VARCHAR(200)  NOT NULL,
    categoria       VARCHAR(200)  NOT NULL,
    PRIMARY KEY (super_categoria, categoria),
    FOREIGN KEY (super_categoria) REFERENCES super_categoria(nome) ON DELETE CASCADE,
        -- nada impede categorias de não pertencerem a nenhuma outra
    FOREIGN KEY (categoria)       REFERENCES categoria(nome),
    CHECK (super_categoria != categoria)
);

CREATE TABLE fornecedor(
    nif  NUMERIC(9)   NOT NULL  CHECK (nif >= 0),  -- NIF tem sempre 9 digitos
    nome VARCHAR(200) NOT NULL,
    PRIMARY KEY (nif)
);

CREATE TABLE produto(
    ean           NUMERIC(13)   NOT NULL CHECK (ean >= 0), -- EAN tem sempre 13 digitos
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
    FOREIGN KEY (nif) REFERENCES fornecedor(nif),
    FOREIGN KEY (ean) REFERENCES produto(ean) ON DELETE CASCADE
        -- Se for eliminado um produto , faz sentido eliminar todas as
        --  relações que este tem com fornecedores secundários
);

CREATE TABLE corredor(
    nro     SMALLINT  NOT NULL CHECK(nro > 0),
        -- o supermercado tem menos de 32767 corredores, e a numeracao começa no 1
    largura SMALLINT  NOT NULL CHECK(largura >= 0),
        -- em centimetros. Todos os corredores tem menos de 327 metros de largura.
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
    ean      NUMERIC(13) NOT NULL,
    nro      SMALLINT    NOT NULL,
    lado     tipo_lado   NOT NULL,
    altura   tipo_altura NOT NULL,
    face     SMALLINT    NOT NULL CHECK (face >= 0),
        -- número de frentes de produto visíveis
    unidades INT         NOT NULL CHECK (unidades > 0),
        -- repoem-se no minimo 1 e no maximo 2147483647 unidades.
    loc      INT         NOT NULL CHECK (loc > 0),
    -- número de slot. O supermercado tem menos de 2147483647 slots, e a numeracao comeca no 1.
    PRIMARY KEY (ean, nro, lado, altura),
    FOREIGN KEY (ean)               REFERENCES produto(ean)                  ON DELETE CASCADE,
    -- Se um produto e eliminado, sao elimidas as entradas de planograma que o referenciam.
    FOREIGN KEY (nro, lado, altura) REFERENCES prateleira(nro, lado, altura) ON DELETE CASCADE
    -- Se for eliminada uma prateleira, sao automaticamente eliminadas
    --  toda sas entradas de planograma que lhe dizem respeito.
);

CREATE TABLE evento_reposicao(
    operador NUMERIC(9)  NOT NULL UNIQUE CHECK (operador >= 0), -- nif do empregado
    instante TIMESTAMP   NOT NULL UNIQUE CHECK (instante < CURRENT_TIMESTAMP),
    PRIMARY KEY (instante),
    UNIQUE (operador, instante)
);

CREATE TABLE reposicao(
    ean      NUMERIC(13) NOT NULL,
    nro      SMALLINT    NOT NULL,
    lado     tipo_lado   NOT NULL,
    altura   tipo_altura NOT NULL,
    operador NUMERIC(9)  NOT NULL,
    instante TIMESTAMP   NOT NULL,
    unidades INT         NOT NULL CHECK (unidades > 0),
    -- unidades repostas. Entre 1 e 2147483647
    PRIMARY KEY (ean, nro, lado, altura, operador, instante),
    FOREIGN KEY (ean, nro, lado, altura) REFERENCES  planograma(ean, nro, lado, altura),
    FOREIGN KEY (operador, instante)     REFERENCES  evento_reposicao(operador, instante)
);
