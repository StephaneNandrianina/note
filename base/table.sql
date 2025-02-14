create database gestionnote;
SELECT pg_encoding_to_char(encoding) FROM pg_database WHERE datname = 'gestionnote';

\c gestionnote

CREATE table admin (
    idadmin serial PRIMARY KEY,
    nom VARCHAR(100),
    login VARCHAR(200),
    password VARCHAR(200)
);

CREATE TABLE promotion(
    idpromotion serial PRIMARY KEY,
    nompromotion VARCHAR(100)
);

CREATE TABLE genre(
    idgenre serial PRIMARY KEY,
    nomgenre VARCHAR(100)
);

CREATE table etudiant(
    idetudiant serial PRIMARY KEY,
    numETU VARCHAR(100),
    nom VARCHAR(100),
    prenom VARCHAR(100),
    dateDeNaissance DATE,
    idpromotion int,
    idgenre int,
    FOREIGN KEY(idpromotion) REFERENCES promotion(idpromotion),
    FOREIGN KEY(idgenre) REFERENCES genre (idgenre)
);


CREATE TABLE semestre(
    idsemestre serial PRIMARY KEY,
    nomsemestre VARCHAR(100)
    
);


-- CREATE TABLE caracteristiqueEtudiant(
--     idcaracteristiqueEtudiant serial PRIMARY KEY,
--     idetudiant int,
--     idsemestre int,
--     FOREIGN KEY(idetudiant) REFERENCES etudiant (idetudiant),
--     FOREIGN KEY (idsemestre) REFERENCES  semestre (idsemestre)
-- );

create TABLE matiere(
    idmatiere serial PRIMARY key,
    nomMatiere VARCHAR(200),
    codeMatiere VARCHAR(100)
);

create TABLE matiereSemestre(
    idmatiereSemestre serial PRIMARY KEY,
    idmatiere int,
    idsemestre int,
    credit INTEGER,
    identifiant INTEGER,
    FOREIGN KEY(idsemestre) REFERENCES semestre (idsemestre),
    FOREIGN KEY (idmatiere) REFERENCES  matiere (idmatiere)
);

CREATE TABLE  notematiere(
    idnotematiere serial PRIMARY KEY,
    idmatiere int,
    idetudiant int,
    note DECIMAL(10,2),
    codmatiere VARCHAR(100),
    FOREIGN KEY(idetudiant) REFERENCES etudiant (idetudiant),
    FOREIGN KEY (idmatiere) REFERENCES  matiere (idmatiere)
);

CREATE table configurationnote(
    idconfigurationnote serial PRIMARY KEY,
    code VARCHAR(100),
    config VARCHAR(200),
    valeur INTEGER
);

-- TABLE IMPORT
CREATE table configurationnoteimport(
    idconfigurationnoteimport serial PRIMARY KEY,
    code VARCHAR(100),
    config VARCHAR(200),
    valeur INTEGER
);

create TABLE noteimport(
    idnoteimport serial PRIMARY KEY,
    numetu VARCHAR(100),
    nom VARCHAR(100),
    prenom VARCHAR(100),
    genre VARCHAR(50),
    datedenaissance DATE,
    promotion VARCHAR(50) ,
    codematiere VARCHAR(50),
    semestre VARCHAR(50),
    note DECIMAL(10,2)
);