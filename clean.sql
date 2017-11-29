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