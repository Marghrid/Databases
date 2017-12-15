-- Ficheiro com intruções de criação e população do esquema em estrela
DROP TABLE IF EXISTS d_produto;
DROP TABLE IF EXISTS d_tempo;
DROP TABLE IF EXISTS reposicoes;

--CREATE TABLE d_produto(
--  ean                      NUMERIC(13)  NOT NULL,
--  categoria                VARCHAR(200) NOT NULL,
--  nif_fornecedor_principal NUMERIC(9)   NOT NULL,
--  PRIMARY KEY (ean)
--);

/*
CREATE TABLE d_tempo(
    data_id NUMERIC(8),
    dia     NUMERIC(2),
    mes     NUMERIC(2),
    ano     NUMERIC(4),
    PRIMARY KEY (data_id)
);
*/

SELECT DISTINCT ean AS cean,
                categoria,
                forn_primario AS nif_fornecedor_principal
INTO d_produto
FROM produto NATURAL JOIN reposicao;
-- Usamos NATURAL JOIN para impedir que estejam presentes produtos
--  que nao foram repostos.

ALTER TABLE d_produto ADD PRIMARY KEY (cean);

SELECT DISTINCT to_number(to_char(instante, 'YYYYMMDD'), '99999999') AS data_id,
                CAST(date_part('day',   instante) AS NUMERIC(2)) AS dia,
                CAST(date_part('month', instante) AS NUMERIC(2)) AS mes,
                CAST(date_part('year',  instante) AS NUMERIC(4)) AS ano
INTO d_tempo 
FROM reposicao;
-- Usamos reposicao e nao evento_reposicao para evitar que haja entradas,
--  para as quais nao ha uma entrada de d_produto correspondente.

ALTER TABLE d_tempo ADD PRIMARY KEY (data_id);

-- Tabela de factos:
SELECT DISTINCT ean AS cean,
                to_number(to_char(instante, 'YYYYMMDD'), '99999999') AS data_id
INTO reposicoes
FROM produto NATURAL JOIN reposicao;

ALTER TABLE reposicoes ADD PRIMARY KEY (cean, data_id);

-- Query:
-- Obter o número de reposições de produtos do fornecedor com NIF 123 455 678
-- para cada categoria, com rollup por ano e mês

SELECT categoria, NULL as ano, NULL as mes, COUNT(cean)
FROM reposicoes NATURAL JOIN d_produto NATURAL JOIN d_tempo
WHERE nif_fornecedor_principal = 123455678
GROUP BY categoria
UNION
SELECT categoria, ano, mes, COUNT(cean)
FROM reposicoes NATURAL JOIN d_produto NATURAL JOIN d_tempo
WHERE nif_fornecedor_principal = 123455678
GROUP BY categoria, mes, ano;
