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
INSERT INTO fornecedor VALUES (321232343, 'Quinta do Manel');
INSERT INTO fornecedor VALUES (131242353, 'Whiskas');
INSERT INTO fornecedor VALUES (423456789, 'A outra cadeia de supermercados');
INSERT INTO fornecedor VALUES (123456788, 'fornecedor01');
INSERT INTO fornecedor VALUES (146456786, 'fornecedor02');
INSERT INTO fornecedor VALUES (323556789, 'fornecedor03');
INSERT INTO fornecedor VALUES (123365789, 'fornecedor04');
INSERT INTO fornecedor VALUES (423453686, 'fornecedor05');
INSERT INTO fornecedor VALUES (123451689, 'fornecedor06');
INSERT INTO fornecedor VALUES (323150669, 'fornecedor07');
INSERT INTO fornecedor VALUES (224456789, 'fornecedor08');
INSERT INTO fornecedor VALUES (423835788, 'fornecedor09');
INSERT INTO fornecedor VALUES (123000759, 'fornecedor10');

INSERT INTO produto VALUES (1234567890123, 'Delta Q SuperExpress', 			'Maquinas de cafe',		 	323556789, '2017-11-11');
INSERT INTO produto VALUES (2345678901231, 'Whiskas saquetas',     			'Comida de gato',  		 	131242353, '2017-11-12');
INSERT INTO produto VALUES (3456789012312, 'Leite meio gordo Mimosa',     	'Lacticineos',     		 	111222333, '2017-10-11');
INSERT INTO produto VALUES (3456789032312, 'Iogurte aromas Agros',    		'Lacticineos',    		  	423453686, '2017-10-11');
INSERT INTO produto VALUES (3456785062712, 'Queijo da Serra da Estrela',    'Lacticineos',     		 	321232343, '2017-10-11');
INSERT INTO produto VALUES (3356485562712, 'Siemens SuperClothesCleaner',	'Maquinas de lavar roupa',	010010010, '2017-10-11');
INSERT INTO produto VALUES (3496785072712, 'Maquina roupa X530-ABB',		'Maquinas de lavar roupa',	224456789, '2017-10-11');
INSERT INTO produto VALUES (3456485662912, 'Maca Royal Gala',				'Fruta',					321232343, '2017-10-11');
INSERT INTO produto VALUES (3456785056712, 'Pera Rocha',					'Fruta',					321232343, '2017-10-11');
INSERT INTO produto VALUES (2456385062612, 'Clementina XPTO',				'Fruta',					321232343, '2017-10-11');
INSERT INTO produto VALUES (6456785069611, 'Laranja do Algarve',			'Fruta',					321232343, '2017-10-11');

INSERT INTO fornece_sec VALUES (123365789, 3456789032312); --fornecedor04 Iogurte aromas Agros
INSERT INTO fornece_sec VALUES (123365789, 3496785072712); --fornecedor04 Maquina roupa X530-ABB
INSERT INTO fornece_sec VALUES (123365789, 2345678901231); --fornecedor04 Whiskas saquetas
INSERT INTO fornece_sec VALUES (123365789, 3456485662912); --fornecedor04
INSERT INTO fornece_sec VALUES (423835788, 3456485662912); --fornecedor09 Maca Royal Gala
INSERT INTO fornece_sec VALUES (323150669, 3456485662912); --fornecedor07 Maca Royal Gala
INSERT INTO fornece_sec VALUES (423453686, 3456485662912); --fornecedor05 Maca Royal Gala
INSERT INTO fornece_sec VALUES (146456786, 3456485662912); --fornecedor02 Maca Royal Gala
INSERT INTO fornece_sec VALUES (423456789, 6456785069611); --fornecedor01 Laranja do Algarve
INSERT INTO fornece_sec VALUES (123456788, 6456785069611); --fornecedor02 Laranja do Algarve
INSERT INTO fornece_sec VALUES (146456786, 6456785069611); --fornecedor03 Laranja do Algarve
INSERT INTO fornece_sec VALUES (323556789, 6456785069611); --fornecedor04 Laranja do Algarve
INSERT INTO fornece_sec VALUES (123365789, 6456785069611); --fornecedor05 Laranja do Algarve
INSERT INTO fornece_sec VALUES (423453686, 6456785069611); --fornecedor05 Laranja do Algarve
INSERT INTO fornece_sec VALUES (123451689, 6456785069611); --fornecedor06 Laranja do Algarve
INSERT INTO fornece_sec VALUES (323150669, 6456785069611); --fornecedor07 Laranja do Algarve
INSERT INTO fornece_sec VALUES (224456789, 6456785069611); --fornecedor08 Laranja do Algarve
INSERT INTO fornece_sec VALUES (423835788, 6456785069611); --fornecedor09 Laranja do Algarve
INSERT INTO fornece_sec VALUES (123000759, 6456785069611); --fornecedor10 Laranja do Algarve

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

INSERT INTO planograma VALUES (1234567890123, 1, 'esquerdo', 'superior', 2,  10,  21);
INSERT INTO planograma VALUES (2345678901231, 1, 'direito',  'medio',    8,  80,  13);
INSERT INTO planograma VALUES (3456789012312, 1, 'esquerdo', 'superior', 12, 120, 32);
INSERT INTO planograma VALUES (3456789032312, 1, 'esquerdo', 'chao',     26, 200, 76);
INSERT INTO planograma VALUES (3456785062712, 1, 'direito',  'superior', 8,  60,  47);
INSERT INTO planograma VALUES (3356485562712, 2, 'esquerdo', 'medio',    1,  3,   17);
INSERT INTO planograma VALUES (3496785072712, 2, 'direito',  'chao',     1,  3,   65);
INSERT INTO planograma VALUES (3456485662912, 3, 'esquerdo', 'superior', 50, 200, 97);
INSERT INTO planograma VALUES (3456785056712, 3, 'direito',  'chao',     50, 200, 12);
INSERT INTO planograma VALUES (2456385062612, 3, 'direito',  'superior', 50, 200,  2);

INSERT INTO evento_reposicao VALUES (123456789, timestamp '2016-09-28 13:02:32');
INSERT INTO evento_reposicao VALUES (346864234, timestamp '2016-11-02 14:32:09');
INSERT INTO evento_reposicao VALUES (534366789, timestamp '2016-09-28 18:50:04');
INSERT INTO evento_reposicao VALUES (925763799, timestamp '2016-09-28 08:24:14');
INSERT INTO evento_reposicao VALUES (323435979, timestamp '2016-09-28 10:14:52');
INSERT INTO evento_reposicao VALUES (223559789, timestamp '2016-09-28 19:40:12');
INSERT INTO evento_reposicao VALUES (319344476, timestamp '2016-09-28 11:14:05');

INSERT INTO reposicao VALUES (1234567890123, 1, 'esquerdo', 'superior', 123456789, timestamp '2016-09-28 13:02:32', 123);
INSERT INTO reposicao VALUES (2345678901231, 1, 'direito',  'medio',    123456789, timestamp '2016-09-28 13:02:32', 654);
INSERT INTO reposicao VALUES (3456785062712, 1, 'direito',  'superior', 123456789, timestamp '2016-09-28 13:02:32', 345);
INSERT INTO reposicao VALUES (3496785072712, 2, 'direito',  'chao',     123456789, timestamp '2016-09-28 13:02:32', 8765);
INSERT INTO reposicao VALUES (2345678901231, 1, 'direito',  'medio',    346864234, timestamp '2016-11-02 14:32:09', 3456786);
INSERT INTO reposicao VALUES (3456789012312, 1, 'esquerdo', 'superior', 534366789, timestamp '2016-09-28 18:50:04', 4567);
INSERT INTO reposicao VALUES (3456789032312, 1, 'esquerdo', 'chao',     925763799, timestamp '2016-09-28 08:24:14', 56787);
INSERT INTO reposicao VALUES (3456785062712, 1, 'direito',  'superior', 323435979, timestamp '2016-09-28 10:14:52', 34);
INSERT INTO reposicao VALUES (3356485562712, 2, 'esquerdo', 'medio',    223559789, timestamp '2016-09-28 19:40:12', 347);
INSERT INTO reposicao VALUES (3496785072712, 2, 'direito',  'chao',     319344476, timestamp '2016-09-28 11:14:05', 876);
INSERT INTO reposicao VALUES (3456485662912, 3, 'esquerdo', 'superior', 534366789, timestamp '2016-09-28 18:50:04', 5678);
INSERT INTO reposicao VALUES (3456785056712, 3, 'direito',  'chao',     223559789, timestamp '2016-09-28 19:40:12', 8654);
INSERT INTO reposicao VALUES (2456385062612, 3, 'direito',  'superior', 346864234, timestamp '2016-11-02 14:32:09', 2346);