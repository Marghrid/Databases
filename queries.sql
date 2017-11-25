/* queries.sql: Ficheiro com as consultas SQL. */

-- a) Qual o nome do fornecedor que forneceu o maior número de categorias?
--    Note que pode ser mais do que um fornecedor.


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
