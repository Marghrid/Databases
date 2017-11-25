/* populate.sql: Ficheiro com instruções para popular as tabelas com dados de teste.  */

INSERT INTO categoria VALUES ('Lacticineos');
INSERT INTO categoria VALUES ('Produtos Higienicos');
INSERT INTO categoria VALUES ('Fruta');
INSERT INTO categoria VALUES ('Eletrodomesticos');
INSERT INTO categoria VALUES ('Maquinas de cafe');
INSERT INTO categoria VALUES ('Maquinas de lavar roupa');
INSERT INTO categoria VALUES ('Animais de estimacao');
INSERT INTO categoria VALUES ('Comida de gato');
INSERT INTO categoria VALUES ('Comida de cao');

INSERT INTO super_categoria VALUES ('Animais de estimacao');
INSERT INTO super_categoria VALUES ('Eletrodomesticos');

INSERT INTO constituida VALUES ('Animais de estimacao','Comida de cao');
INSERT INTO constituida VALUES ('Animais de estimacao','Comida de gato');
INSERT INTO constituida VALUES ('Eletrodomesticos','Maquinas de cafe');
INSERT INTO constituida VALUES ('Eletrodomesticos','Maquinas de lavar roupa');

INSERT INTO fornecedor VALUES (010010010, 'Siemens');
INSERT INTO fornecedor VALUES (111222333, 'Mimosa');
INSERT INTO fornecedor VALUES (121232343, 'Quinta do Manel');
INSERT INTO fornecedor VALUES (131242353, 'Whiskas');
INSERT INTO fornecedor VALUES (123456789, 'A outra cadeia de supermercados');

INSERT INTO produto VALUES (1234567890123, 'Delta Q SuperExpress', 			'Maquinas de cafe',		 	123456789, '2017-11-11');
INSERT INTO produto VALUES (2345678901231, 'Whiskas saquetas',     			'Comida de gato',  		 	131242353, '2017-11-12');
INSERT INTO produto VALUES (3456789012312, 'Leite meio gordo Mimosa',     	'Lacticineos',     		 	111222333, '2017-10-11');
INSERT INTO produto VALUES (3456789032312, 'Iogurte aromas Agros',    		'Lacticineos',    		  	123456789, '2017-10-11');
INSERT INTO produto VALUES (3456785062712, 'Queijo da Serra da Estrela',    'Lacticineos',     		 	121232343, '2017-10-11');
INSERT INTO produto VALUES (3356485562712, 'Siemens SuperClothesCleaner',	'Maquinas de lavar roupa',	010010010, '2017-10-11');
INSERT INTO produto VALUES (3496785072712, 'Maquina roupa X530-ABB',		'Maquinas de lavar roupa',	010010010, '2017-10-11');
INSERT INTO produto VALUES (3456485662912, 'Maca Royal Gala',				'Fruta',					121232343, '2017-10-11');
INSERT INTO produto VALUES (3456785056712, 'Pera Rocha',					'Fruta',					121232343, '2017-10-11');
INSERT INTO produto VALUES (2456385062612, 'Clementina XPTO',				'Fruta',					121232343, '2017-10-11');

INSERT INTO corredor VALUES (1, 200);
INSERT INTO corredor VALUES (2, 190);
INSERT INTO corredor VALUES (3, 180);
INSERT INTO corredor VALUES (4, 170);
INSERT INTO corredor VALUES (5, 160);
INSERT INTO corredor VALUES (6, 170);

INSERT INTO prateleira VALUES (1, 'direito',  'chao');
INSERT INTO prateleira VALUES (1, 'direito',  'medio');
INSERT INTO prateleira VALUES (1, 'direito',  'superior');
INSERT INTO prateleira VALUES (1, 'esquerdo', 'chao');
INSERT INTO prateleira VALUES (1, 'esquerdo', 'medio');
INSERT INTO prateleira VALUES (1, 'esquerdo', 'superior');
INSERT INTO prateleira VALUES (2, 'direito',  'chao');
INSERT INTO prateleira VALUES (2, 'direito',  'medio');
INSERT INTO prateleira VALUES (2, 'direito',  'superior');
INSERT INTO prateleira VALUES (2, 'esquerdo', 'chao');
INSERT INTO prateleira VALUES (2, 'esquerdo', 'medio');
INSERT INTO prateleira VALUES (2, 'esquerdo', 'superior');
INSERT INTO prateleira VALUES (3, 'direito',  'chao');
INSERT INTO prateleira VALUES (3, 'direito',  'medio');
INSERT INTO prateleira VALUES (3, 'direito',  'superior');
INSERT INTO prateleira VALUES (3, 'esquerdo', 'chao');
INSERT INTO prateleira VALUES (3, 'esquerdo', 'medio');
INSERT INTO prateleira VALUES (3, 'esquerdo', 'superior');
