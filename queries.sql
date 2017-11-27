/* queries.sql: Ficheiro com as consultas SQL. */

-- a) Qual o nome do fornecedor que forneceu o maior número de categorias?
--    Note que pode ser mais do que um fornecedor.

-- uso de left join em vez de natural join necessario para o caso em que o maximo = 0.
--SELECT nif, nome FROM tabela
--WHERE prims + secs = (SELECT MAX(prims + secs) FROM tabela)
SELECT nif, nome
FROM
	(
		(SELECT nif, nome COUNT(nif) AS prims 
		FROM fornecedor LEFT JOIN produto ON fornecedor.nif=produto.forn_primario
		GROUP BY nif, nome) AS primarios
		NATURAL JOIN
		(SELECT nif, nome COUNT(nif) AS secs
		FROM (fornece_sec LEFT JOIN produto
			ON fornece_sec.ean=produto.ean) NATURAL JOIN fornecedor
		GROUP BY nif, nome) AS secundarios
	)
WHERE prims + secs =
	(
		SELECT MAX(prims+secs)
		FROM
			(
				(SELECT nif, COUNT(nif) AS prims 
				FROM fornecedor LEFT JOIN produto ON fornecedor.nif=produto.forn_primario
				GROUP BY nif) AS primarios
				NATURAL JOIN
				(SELECT nif, COUNT(nif) AS secs
				FROM fornece_sec LEFT JOIN produto ON fornece_sec.ean=produto.ean
      			GROUP BY nif) AS secundarios
			)
	)

-- b) Quais os fornecedores primarios (nome e nif) que forneceram produtos de
--    todas as categorias simples?


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
