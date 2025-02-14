CREATE DATABASE import;

\c import
 
CREATE TABLE error(
    ligne INTEGER,
    date TIMESTAMP,
    log TEXT   
);


CREATE TABLE produit(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50),
    prix DOUBLE PRECISION
);


CREATE TABLE vente(
    id SERIAL PRIMARY KEY,
    date DATE,
    produit INTEGER,
    nombre DOUBLE PRECISION,
    FOREIGN KEY(produit) REFERENCES produit(id)
);

CREATE TABLE venteImport(
    date DATE,
    produit VARCHAR(50),
    nombre DOUBLE PRECISION
);
ALTER TABLE venteImport
ADD id SERIAL PRIMARY KEY;
