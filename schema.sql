/* schema.sql: Ficheiro de criação do esquema da base de dados. */
/* schema.sql: Ficheiro de criação do esquema da base de dados. */
CREATE TABLE categoria(
	nome VARCHAR(200),
	PRIMARY KEY (nome)
);

CREATE TABLE categoria_simples(
	nome VARCHAR(200),
	PRIMARY KEY (nome),
	FOREIGN KEY (nome) REFERENCES categoria(nome)
);

CREATE TABLE super_categoria(
	nome VARCHAR(200),
	PRIMARY KEY (nome),
	FOREIGN KEY (nome) REFERENCES categoria(nome)
);

CREATE TABLE constituida(
	super_categoria VARCHAR(200),
	categoria 		VARCHAR(200),
	PRIMARY KEY (super_categoria, categoria),
	FOREIGN KEY (categoria)	      REFERENCES categoria(nome),
	FOREIGN KEY (super_categoria) REFERENCES super_categoria(nome)
);

CREATE TABLE fornecedor(
	nif  NUMERIC(9),  -- NIF tem sempre 9 digitos
	nome VARCHAR(200),
	PRIMARY KEY (nif)
);

CREATE TABLE produto(
	ean			  NUMERIC(13), -- EAN is always 13 digits
	design		  VARCHAR(200),
	categoria 	  VARCHAR(200),
	forn_primario NUMERIC(9),
	data		  DATE,
	PRIMARY KEY (ean),
	FOREIGN KEY (categoria)     REFERENCES categoria(nome),
	FOREIGN KEY (forn_primario) REFERENCES fornecedor(nif)
);

CREATE TABLE fornece_sec(
	nif	NUMERIC(9),
	ean NUMERIC(13),
	PRIMARY KEY (nif, ean),
	FOREIGN 
);
