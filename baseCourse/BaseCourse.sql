create database course;
\c course

CREATE TABLE admin (
    idAdmin SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255)
);

create TABLE course(
    idCourse serial PRIMARY key,
    nomCourse VARCHAR(100)
    
);

CREATE TABLE etape (
    idEtape serial PRIMARY KEY,
    idCourse int DEFAULT 1,
    nomEtape VARCHAR(100),
    nbrCoureur INTEGER,
    longueurKm DOUBLE PRECISION,
    rang INTEGER,
    depart TIMESTAMP,
    FOREIGN KEY(idCourse) REFERENCES course(idcourse)
 );
 


CREATE TABLE equipe (
    idEquipe SERIAL PRIMARY KEY,
    nomEquipe VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255)
);

CREATE table genre(
    idGenre serial PRIMARY key,
    nomGenre VARCHAR(50)
);

CREATE TABLE coureur(
    idCoureur serial PRIMARY KEY,
    nomCoureur VARCHAR(100),
    idEquipe int,
    numDossard INTEGER,
    idGenre int,
    dateDeNaissance DATE,
    FOREIGN KEY(idEquipe)REFERENCES equipe(idequipe),
    FOREIGN key (idGenre) REFERENCES genre(idGenre)
);

CREATE TABLE categorie(
    idCategorie serial PRIMARY key,
    noCategorie VARCHAR(50)
);


CREATE TABLE coureurCategorie(
    idCoureur int,
    idCategorie int,
    FOREIGN KEY (idCoureur) REFERENCES coureur(idCoureur),
    FOREIGN KEY (idCategorie) REFERENCES categorie(idCategorie)
);


CREATE TABLE etapeCoureur(
    idEtapeCoureur serial PRIMARY KEY,
    idEtape int,
    idCoureur int,
    FOREIGN KEY(idEtape) REFERENCES etape (idEtape),
    FOREIGN KEY(idCoureur) REFERENCES coureur (idCoureur)
);
CREATE TABLE classement(
    idClassent serial PRIMARY KEY,
    idCoureur int,
    idEquipe int,
    rang INTEGER,
    FOREIGN KEY(idcoureur)REFERENCES coureur(idcoureur),
    FOREIGN KEY(idEquipe) REFERENCES equipe(idEquipe
);

CREATE TABLE point(
    classement INTEGER,
    point INTEGER
);


CREATE TABLE etapeImport(
    idEtapeImport serial PRIMARY KEY,
    etape VARCHAR(100),
    longueur DOUBLE PRECISION,
    nbCoureur INTEGER,
    rang INTEGER,
    dateDepart DATE,
    heureDepart TIME
);
CREATE TABLE resultatImport(
    idResultatImport serial PRIMARY KEY,
    etapeRang INTEGER,
    numeroDossar INTEGER,
    nomCoureur VARCHAR(100),
    genre VARCHAR(10),
    dateNaissance DATE,
    equipe VARCHAR(10),
    arrivee TIMESTAMP
);

CREATE TABLE pointImport(
    idPointImport serial PRIMARY KEY,
    classement INTEGER,
    points INTEGER
);

CREATE TABLE etapeCoureurImport(
    idetapeCoureurImport serial PRIMARY key,
    idetape INTEGER,
    idcoureur INTEGER
);



