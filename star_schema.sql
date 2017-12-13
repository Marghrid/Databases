-- Ficheiro com intruções de criação e população do esquema em estrela
DROP TABLE IF EXISTS d_produto;
DROP TABLE IF EXISTS d_data;

--CREATE TABLE d_produto(
--	ean                      NUMERIC(13)  NOT NULL,
--	categoria                VARCHAR(200) NOT NULL,
--	nif_fornecedor_principal NUMERIC(9)   NOT NULL,
--	PRIMARY KEY (ean)
--);

/*
CREATE TABLE d_data(
	data_id NUMERIC(8),
	dia     NUMERIC(2),
	mes     NUMERIC(2),
	ano     NUMERIC(4),
	PRIMARY KEY (data_id)
);
*/

SELECT DISTINCT ean, categoria, forn_primario
INTO d_produto
FROM produto NATURAL JOIN reposicao; --So quero os produtos que foram repostos

ALTER TABLE d_produto ADD PRIMARY KEY (ean);

SELECT DISTINCT to_number(to_char(instante, 'YYYYMMDD'), '99999999') AS data_id,
                CAST(date_part('day',   instante) AS NUMERIC(2)) AS dia,
                CAST(date_part('month', instante) AS NUMERIC(2)) AS mes,
                CAST(date_part('year',  instante) AS NUMERIC(4)) AS ano
INTO d_data 
FROM reposicao; -- podia ser evento_reposicao, mas so nos interessa se houver uma antrada em reposicao correspondente.


ALTER TABLE d_data ADD PRIMARY KEY (data_id);
