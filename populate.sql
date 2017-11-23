/* populate.sql: Ficheiro com instruções para popular as tabelas com dados de teste.  */

INSERT INTO categoria VALUES ('lacticineos');
INSERT INTO categoria VALUES ('produtos higienicos');
INSERT INTO categoria VALUES ('fruta');
INSERT INTO categoria VALUES ('eletrodomesticos');
INSERT INTO categoria VALUES ('maquinas de cafe');
INSERT INTO categoria VALUES ('maquinas de lavar roupa');
INSERT INTO categoria VALUES ('animais de estimacao');
INSERT INTO categoria VALUES ('comida de gato');
INSERT INTO categoria VALUES ('comida de cao');

INSERT INTO super_categoria VALUES ('animais de estimacao');
INSERT INTO super_categoria VALUES ('eletrodomesticos');

INSERT INTO constituida VALUES ('animais de estimacao','comida de cao');
INSERT INTO constituida VALUES ('animais de estimacao','comida de gato');
INSERT INTO constituida VALUES ('eletrodomesticos','maquinas de cafe');
INSERT INTO constituida VALUES ('eletrodomesticos','maquinas de lavar roupa');

INSERT INTO fornecedor VALUES (010010010, 'Siemens');
INSERT INTO fornecedor VALUES (111222333, 'Mimosa');
INSERT INTO fornecedor VALUES (121232343, 'Quinta do Manel');
INSERT INTO fornecedor VALUES (131242353, 'Whiskas');
INSERT INTO fornecedor VALUES (123456789, 'A outra cadeia de supermercados');

INSERT INTO produto VALUES (1234567890123, 'Delta Q superexpress', 'maquinas de cafe', 123456789, '2017-11-11');
INSERT INTO produto VALUES (2345678901231, 'Whiskas saquetas',     'comida de gato',   131242353, '2017-11-12');
INSERT INTO produto VALUES (3456789012312, 'Leite meio gordo',     'lacticineos',      111222333, '2017-10-11');
