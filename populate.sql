/* populate.sql: Ficheiro com instruções para popular as tabelas com dados de teste.  */

INSERT INTO categoria VALUES 
('Lacticinio'),
('Produto Higienico'),
('Fruta'),
('Eletrodomestico'),
('Maquina de cafe'),
('Maquina de lavar roupa'),
('Animais de estimacao'),
('Comida de gato'),
('Comida de cao'),
('Pastelaria'),
('Pao'),
('Bolo'),
('Bolo de anos'),
('Pao de trigo'),
('Pao de centeio'),
('Pao de forma'),
('Leite'),
('Iogurte'),
('Queijo');

INSERT INTO super_categoria VALUES
('Lacticinio'),
('Eletrodomestico'),
('Animais de estimacao'),
('Pastelaria'),
('Pao'),
('Bolo');

INSERT INTO categoria_simples VALUES
('Produto Higienico'),
('Fruta'),
('Maquina de cafe'),
('Maquina de lavar roupa'),
('Comida de gato'),
('Comida de cao'),
('Pao de trigo'),
('Pao de centeio'),
('Pao de forma'),
('Bolo de anos'),
('Leite'),
('Iogurte'),
('Queijo');

INSERT INTO constituida VALUES
('Animais de estimacao', 'Comida de cao'),
('Animais de estimacao', 'Comida de gato'),
('Eletrodomestico', 'Maquina de cafe'),
('Eletrodomestico', 'Maquina de lavar roupa'),
('Pastelaria', 'Pao'),
('Pastelaria', 'Bolo'),
('Pao', 'Pao de trigo'),
('Pao', 'Pao de centeio'),
('Pao', 'Pao de forma'),
('Bolo', 'Bolo de anos'),
('Lacticinio', 'Leite'),
('Lacticinio', 'Iogurte'),
('Lacticinio', 'Queijo');

INSERT INTO fornecedor VALUES
(010010010, 'Siemens'),
(111222333, 'Mimosa'),
(321232343, 'Quinta do Manel'),
(131242353, 'Whiskas'),
(423456789, 'A outra cadeia de supermercados'),
(123456788, 'fornecedor01'),
(146456786, 'fornecedor02'),
(323556789, 'fornecedor03'),
(123365789, 'fornecedor04'),
(423453686, 'fornecedor05'),
(123451689, 'fornecedor06'),
(323150669, 'fornecedor07'),
(224456789, 'fornecedor08'),
(423835788, 'fornecedor09'),
(123000759, 'fornecedor10');

INSERT INTO produto VALUES
(1234567890123, 'Delta Q SuperExpress', 		'Maquina de cafe',		 	323556789, '2017-01-11'),
(2345678901231, 'Whiskas saquetas',     		'Comida de gato',  		 	131242353, '2016-08-29'),
(2934875401231, 'Hills Saco 30kg',       		'Comida de cao',  		 	131242353, '2016-08-12'),
(3456789012312, 'Leite meio gordo Mimosa',     	'Leite',     			 	111222333, '2017-06-22'),
(3456789032312, 'Iogurte aromas Agros',    		'Iogurte',    			  	423453686, '2016-03-11'),
(3456785062712, 'Queijo da Serra da Estrela',   'Queijo',     			 	321232343, '2017-09-13'),
(3356485562712, 'Siemens SuperClothesCleaner',	'Maquina de lavar roupa',	010010010, '2015-04-11'),
(3496785072712, 'Maquina roupa X530-ABB',		'Maquina de lavar roupa',	224456789, '2015-10-23'),
(3456485662912, 'Maca Royal Gala',				'Fruta',					321232343, '2016-02-06'),
(3456785056712, 'Pera Rocha',					'Fruta',					321232343, '2015-07-11'),
(2456385062612, 'Clementina XPTO',				'Fruta',					321232343, '2015-05-15'),
(6456785069611, 'Laranja do Algarve',			'Fruta',					321232343, '2017-01-01'),
(6987654429611, 'Escova dos dentes BShiny',		'Produto Higienico',		123365789, '2016-12-29'),
(6087645785321, 'Bolinhas de agua 6 un.',		'Pao de trigo',     		423835788, '2017-12-01'),
(9876543247611, 'Pao de centeio XL',			'Pao de centeio',   		423835788, '2015-11-30'),
(7534579969611, 'Bimbo superfofo sem codea',	'Pao de forma',				423835788, '2017-06-23'),
(6324797652346, 'Bolo de anos Frozen',			'Bolo de anos',				123451689, '2016-02-10');

INSERT INTO fornece_sec VALUES
(123365789, 3456789032312), --fornecedor04 Iogurte aromas Agros
(123365789, 3496785072712), --fornecedor04 Maquina roupa X530-ABB
(123365789, 2345678901231), --fornecedor04 Whiskas saquetas
(123365789, 3456485662912), --fornecedor04 Maca Royal Gala
(423835788, 3456485662912), --fornecedor09 Maca Royal Gala
(323150669, 3456485662912), --fornecedor07 Maca Royal Gala
(423453686, 3456485662912), --fornecedor05 Maca Royal Gala
(146456786, 3456485662912), --fornecedor02 Maca Royal Gala
(123456788, 6456785069611), --fornecedor01 Laranja do Algarve
(146456786, 6456785069611), --fornecedor02 Laranja do Algarve
(323556789, 6456785069611), --fornecedor03 Laranja do Algarve
(123365789, 6456785069611), --fornecedor04 Laranja do Algarve
(423453686, 6456785069611), --fornecedor05 Laranja do Algarve
(123451689, 6456785069611), --fornecedor06 Laranja do Algarve
(323150669, 6456785069611), --fornecedor07 Laranja do Algarve
(224456789, 6456785069611), --fornecedor08 Laranja do Algarve
(423835788, 6456785069611), --fornecedor09 Laranja do Algarve
(123000759, 6456785069611), --fornecedor10 Laranja do Algarve
(111222333, 6456785069611), --Mimosa       Laranja do Algarve
(123451689, 1234567890123), --fornecedor06 Delta Q SuperExpress
(123451689, 2345678901231), --fornecedor06 Whiskas saquetas  
(123451689, 2934875401231), --fornecedor06 Hills Sago 30kg 
(123451689, 3456789012312), --fornecedor06 Leite meio gordo Mimosa
(123451689, 3456789032312), --fornecedor06 Iogurte aromas Agros
(123451689, 3456785062712), --fornecedor06 Queijo da Serra da Estrela
(123451689, 3356485562712), --fornecedor06 Siemens SuperClothesCleaner
(123451689, 3496785072712), --fornecedor06 Maquina roupa X530-ABB
(123451689, 3456485662912), --fornecedor06 Maca Royal Gala
(123451689, 3456785056712), --fornecedor06 Pera Rocha
(123451689, 2456385062612), --fornecedor06 Clementina XPTO
(123451689, 6987654429611), --fornecedor06 Escova dos dentes BShiny
(123451689, 6087645785321), --fornecedor06 Bolinhas de agua 6 un.
(123451689, 9876543247611), --fornecedor06 Pao de centeio XL
(123451689, 7534579969611), --fornecedor06 Bimbo superfofo sem codea
(123451689, 6324797652346); --fornecedor06 Bolo de anos Frozen
-- fornecedor06 fornece todas as categorias simples
-- Laranja do Algarve tem mais de 10 fornecedores secundários

INSERT INTO corredor VALUES
(1, 200),
(2, 190),
(3, 180),
(4, 170),
(5, 160),
(6, 170);

INSERT INTO prateleira VALUES
(1, 'direito',  'chao'),
(1, 'direito',  'medio'),
(1, 'direito',  'superior'),
(1, 'esquerdo', 'chao'),
(1, 'esquerdo', 'medio'),
(1, 'esquerdo', 'superior'),
(2, 'direito',  'chao'),
(2, 'direito',  'medio'),
(2, 'direito',  'superior'),
(2, 'esquerdo', 'chao'),
(2, 'esquerdo', 'medio'),
(2, 'esquerdo', 'superior'),
(3, 'direito',  'chao'),
(3, 'direito',  'medio'),
(3, 'direito',  'superior'),
(3, 'esquerdo', 'chao'),
(3, 'esquerdo', 'medio'),
(3, 'esquerdo', 'superior');

INSERT INTO planograma VALUES
(1234567890123, 1, 'esquerdo', 'superior', 2,  10,  21),
(2345678901231, 1, 'direito',  'medio',    8,  80,  13),
(3456789012312, 1, 'esquerdo', 'superior', 12, 120, 32),
(3456789032312, 1, 'esquerdo', 'chao',     26, 200, 76),
(3456785062712, 1, 'direito',  'superior', 8,  60,  47),
(3356485562712, 2, 'esquerdo', 'medio',    1,  3,   17),
(3496785072712, 2, 'direito',  'chao',     1,  3,   65),
(3456485662912, 3, 'esquerdo', 'superior', 50, 200, 97),
(3456785056712, 3, 'direito',  'chao',     50, 200, 12),
(2456385062612, 3, 'direito',  'superior', 50, 200,  2);

INSERT INTO evento_reposicao VALUES
(123456789, timestamp '2016-09-28 13:02:32'),
(346864234, timestamp '2016-11-02 14:32:09'),
(534366789, timestamp '2016-09-28 18:50:04'),
(925763799, timestamp '2016-09-28 08:24:14'),
(323435979, timestamp '2016-09-28 10:14:52'),
(223559789, timestamp '2016-09-28 19:40:12'),
(319344476, timestamp '2016-09-28 11:14:05');

INSERT INTO reposicao VALUES
(1234567890123, 1, 'esquerdo', 'superior', 123456789, timestamp '2016-09-28 13:02:32', 123),
(2345678901231, 1, 'direito',  'medio',    123456789, timestamp '2016-09-28 13:02:32', 654),
(3456785062712, 1, 'direito',  'superior', 123456789, timestamp '2016-09-28 13:02:32', 345),
(3496785072712, 2, 'direito',  'chao',     123456789, timestamp '2016-09-28 13:02:32', 8765),
(2345678901231, 1, 'direito',  'medio',    346864234, timestamp '2016-11-02 14:32:09', 3456786),
(3456789012312, 1, 'esquerdo', 'superior', 534366789, timestamp '2016-09-28 18:50:04', 4567),
(3456789032312, 1, 'esquerdo', 'chao',     925763799, timestamp '2016-09-28 08:24:14', 56787),
(3456785062712, 1, 'direito',  'superior', 323435979, timestamp '2016-09-28 10:14:52', 34),
(3356485562712, 2, 'esquerdo', 'medio',    223559789, timestamp '2016-09-28 19:40:12', 347),
(3496785072712, 2, 'direito',  'chao',     319344476, timestamp '2016-09-28 11:14:05', 876),
(3456485662912, 3, 'esquerdo', 'superior', 534366789, timestamp '2016-09-28 18:50:04', 5678),
(3456785056712, 3, 'direito',  'chao',     223559789, timestamp '2016-09-28 19:40:12', 8654),
(2456385062612, 3, 'direito',  'superior', 346864234, timestamp '2016-11-02 14:32:09', 2346);