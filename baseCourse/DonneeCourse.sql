INSERT INTO admin (nom, email, password) VALUES ('Admin Test', 'admin@test.com', '$2y$12$0IQIqZqZ8nBKP.IF0qFz7e8HUIhYCOtcTAld5WflaOL28lCRCLxla'); -- password

INSERT INTO equipe (nomEquipe, email, password) VALUES
('D', 'D', '$2y$12$MCEIMiiW6T14Bs4FIKpuo.MpdHhmYvfituGPdVr.ateB2Rs6NH/yS'); -- D


INSERT into course(nomCourse)VALUES('ultimate team race');

insert into etape(idcourse,nomEtape,nbrCoureur,longueurKm,rang,depart)VALUES(1,' Betsizaraina',3, 30.00 ,1,'2004-06-15 06:00:00');
 insert into etape(idcourse,nomEtape,nbrCoureur,longueurKm,rang,depart)VALUES(1,' Ampasimbe',3, 50.34 ,2,'2004-06-15 06:00:00');
 insert into etape(idcourse,nomEtape,nbrCoureur,longueurKm,rang,depart)VALUES(1,' Bealalana',3, 35.01 ,3,'2004-06-15 06:00:00');
 



INSERT INTO genre(nomGenre)VALUES('homme');
INSERT INTO genre(nomGenre)VALUES('femme');


INSERT into coureur(nomCoureur,idEquipe,numDossard,idGenre,dateDeNaissance)VALUES
('Lova', 1 , 34 , 1 , '2004-06-15'),
('Sabrina', 1 , 10 , 2 , '1999-10-15'),
('Justin', 2 , 143 , 1 , '2006-01-09'),
('Vero', 2 , 89 , 2 , '2010-11-23'),
('John', 3 , 44 , 1 , '1998-06-15'),
('Jill', 3 , 56 , 1 , '2004-09-18');

insert into categorie(noCategorie)VALUES('junior'),('senior');

INSERT INTO coureurcategorie(idCoureur,idCategorie)VALUES(1,2),(2,1),(3,2),(4,2),(5,1),(6,1);

INSERT INTO etapeCoureur (idEtape,idCoureur) VALUES
-- Etape 1 de Betsizaraina
(6, 7),
(7, 8),
(8, 9),
(6, 10),
(7, 11),
(8, 12);

