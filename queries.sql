/* queries.sql: Ficheiro com as consultas SQL. */

-- a) Qual o nome do fornecedor que forneceu o maior número de categorias?
--    Note que pode ser mais do que um fornecedor.

--SELECT nome FROM tabela
--WHERE count = (SELECT MAX(count) FROM tabela)

SELECT nome
FROM
(
	SELECT nif, COUNT(DISTINCT categoria)
	FROM
	(
		SELECT categoria, forn_primario AS nif
		FROM produto
		UNION ALL
		SELECT categoria, nif
		FROM produto NATURAL JOIN fornece_sec
  	) AS catnif
	GROUP BY nif
) AS catcount NATURAL JOIN fornecedor
WHERE count =
(
	SELECT MAX(count)
	FROM
	(
		SELECT nif, COUNT(DISTINCT categoria)
		FROM
		(
			SELECT categoria, forn_primario AS nif
			FROM produto
			UNION ALL
			SELECT categoria, nif
			FROM produto NATURAL JOIN fornece_sec
		) AS catnif
		GROUP BY nif
	) AS catcount
);

-- b) Quais os fornecedores primarios (nome e nif) que forneceram produtos de
--    todas as categorias simples?
SELECT DISTINCT nif, nome
FROM (
	SELECT nif, nome
	FROM fornecedor INNER JOIN produto ON fornecedor.nif = produto.forn_primario
) AS fp 
WHERE NOT EXISTS (
	SELECT nome 
	FROM categoria_simples c
	WHERE NOT EXISTS(
		SELECT categoria
		FROM fornece_sec NATURAL JOIN produto
		WHERE (produto.forn_primario=fp.nif
			AND produto.categoria = c.nome)
		OR (fornece_sec.nif=fp.nif
			AND produto.categoria = c.nome)
	)
);

-- c) Quais os produtos (ean) que nunca foram repostos?
SELECT ean
FROM produto
WHERE ean NOT IN (
	SELECT ean
	FROM reposicao
);

-- d) Quais os produtos (ean) com um número de fornecedores secundários
--    superior a 10?
SELECT ean
FROM fornece_sec
GROUP BY ean
HAVING COUNT(nif) > 10;

-- e) Quais os produtos (ean) que foram repostos sempre pelo mesmo operador?
SELECT ean
FROM reposicao
GROUP BY ean
HAVING COUNT(DISTINCT operador) = 1;
