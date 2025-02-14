INSERT INTO admin (nom,login, password) VALUES ('admin','admin@gmail.com', '0000');


-- INSERT INTO promotion (nompromotion) VALUES
-- ('P1'),
-- ('P2'),
-- ('P3'),
-- ('P4'),
-- ('P5'),
-- ('P6'),
-- ('P7'),
-- ('P8'),
-- ('P9'),
-- ('P10'),
-- ('P11'),
-- ('P12'),
-- ('P13'),
-- ('P14'),
-- ('P15');

-- INSERT into genre (nomgenre)VALUEs ('masculin'),('feminin'); 

-- INSERT INTO etudiant (numETU, nom, prenom, dateDeNaissance,idpromotion, idgenre) VALUES
-- ('ETU001', 'Dupont', 'Jean', '1995-03-15',1,1),
-- -- ('ETU002', 'Durand', 'Marie', '1998-07-22',1,2),
-- -- ('ETU003', 'Lefevre', 'Pierre', '1997-01-10',1,1),
-- ('ETU004', 'Martin', 'Sophie', '1996-11-25',3,2);
-- -- INSERT INTO etudiant (numETU, nom, prenom, dateDeNaissance, idpromotion, idgenre) VALUES
-- -- ('ETU005', 'Petit', 'Luc', '1999-02-12', 1,1),
-- -- ('ETU006', 'Moreau', 'Claire', '1995-06-30', 1, 2),
-- -- ('ETU007', 'Gauthier', 'Paul', '1998-10-20', 1, 1);
-- -- INSERT INTO etudiant (numETU, nom, prenom, dateDeNaissance, idpromotion, idgenre) VALUES
-- -- ('ETU008', 'Roux', 'Alice', '1997-04-17', 2, 1),
-- -- ('ETU009', 'Benoit', 'Julien', '1996-12-11', 2, 1),
-- -- ('ETU010', 'Thomas', 'Emma', '1999-09-09', 2, 1);
-- -- INSERT INTO etudiant (numETU, nom, prenom, dateDeNaissance, idpromotion, idgenre) VALUES
-- -- ('ETU011', 'Fournier', 'Antoine', '1998-05-24', 3, 1),
-- -- ('ETU012', 'Leclerc', 'Isabelle', '1997-11-12', 3, 2),
-- -- ('ETU013', 'Simon', 'Marie', '1996-08-30', 3, 2);


INSERT INTO semestre (nomsemestre) VALUES
('S1'),
('S2'),
('S3'),
('S4'),
('S5'),
('S6');


-- Insérer les données dans la table matiere
INSERT INTO matiere (nomMatiere, codeMatiere) VALUES
('Programmation procédurale', 'INF101'),
('HTML et Introduction au Web', 'INF104'),
('Informatique de Base', 'INF107'),
('Arithmétique et nombres', 'MTH101'),
('Analyse mathématique', 'MTH102'),
('Techniques de communication', 'ORG101');
INSERT INTO matiere (nomMatiere, codeMatiere) VALUES
('Bases de données relationnelles', 'INF102'),
('Bases de l''administration système', 'INF103'),
('Maintenance matériel et logiciel', 'INF105'),
('Compléments de programmation', 'INF106'),
('Calcul Vectoriel et Matriciel', 'MTH103'),
('Probabilité et Statistique', 'MTH105');
INSERT INTO matiere (nomMatiere, codeMatiere) VALUES
('Programmation orientée objet', 'INF201'),
('Bases de données objets', 'INF202'),
('Programmation système', 'INF203'),
('Réseaux informatiques', 'INF208'),
('Méthodes numériques', 'MTH201'),
('Bases de gestion', 'ORG201');
INSERT INTO matiere (nomMatiere, codeMatiere) VALUES
('Système d''information géographique', 'INF204'),
('Système d''information', 'INF205'),
('Interface Homme/Machine', 'INF206'),
('Eléments d''algorithmique', 'INF207'),
('Mini-projet de développement', 'INF210' ),
('Géométrie', 'MTH204'),
('Equations différentielles', 'MTH205'),
('Optimisation', 'MTH206'),
('MAO', 'MTH203');
INSERT INTO matiere (nomMatiere, codeMatiere) VALUES
('Architecture logicielle', 'INF301'),
('Développement pour mobiles', 'INF304'),
('Conception en modèle orienté objet', 'INF307'),
('Gestion d''entreprise', 'ORG301'),
('Gestion de projets', 'ORG302'),
('Anglais pour les affaires', 'ORG303');
INSERT INTO matiere (nomMatiere, codeMatiere) VALUES
('Codage', 'INF310'),
('Programmation avancée, frameworks', 'INF313'),
('Technologies d''accès aux réseaux', 'INF302'),
('Multimédia', 'INF303'),
('Projet de développement', 'INF316'),
('Communication d''entreprise', 'ORG304');


INSERT INTO matieresemestre (idmatiere,idsemestre,credit,identifiant)VALUES
(1 ,1 ,7 ,4),
(2 ,1 ,5 ,5),
(3 ,1 ,4 ,6),
(4 ,1 ,4 ,7),
(5 ,1 ,6 ,8),
(6 ,1 ,4 ,9);
INSERT INTO matieresemestre (idmatiere,idsemestre,credit,identifiant)VALUES
(7 ,2 ,5 ,10),
(8 ,2 ,5 ,11),
(9 ,2 ,4 ,12),
(10 ,2 ,6 ,13),
(11 ,2 ,6 ,14),
(12 ,2 ,4 ,15);
INSERT INTO matieresemestre (idmatiere,idsemestre,credit,identifiant)VALUES
(13 ,3 ,6 ,16),
(14 ,3 ,6 ,17),
(15 ,3 ,4 ,18),
(16 ,3 ,6 ,19),
(17 ,3 ,4 ,20),
(18 ,3 ,4 ,21);
INSERT INTO matieresemestre (idmatiere,idsemestre,credit,identifiant)VALUES
(19 ,4 ,6 ,1),
(20 ,4 ,6 ,1),
(21 ,4 ,6 ,1),
(22 ,4 ,6 ,22),
(23 ,4 ,10 ,23),
(24 ,4 ,4 ,2),
(25 ,4 ,4 ,2),
(26 ,4 ,4 ,2),
(27 ,4 ,4 ,24);
INSERT INTO matieresemestre (idmatiere,idsemestre,credit,identifiant)VALUES
(28 ,5 ,6 ,25),
(29 ,5 ,6 ,26),
(30 ,5 ,6 ,27),
(31 ,5 ,5 ,28),
(32 ,5 ,4 ,29),
(33 ,5 ,3 ,30);
INSERT INTO matieresemestre (idmatiere,idsemestre,credit,identifiant)VALUES
(34 ,6 ,4 ,31),
(35 ,6 ,6 ,32),
(36 ,6 ,6 ,3),
(37 ,6 ,6 ,3),
(38 ,6 ,10 ,33),
(39 ,6 ,4 ,34);

-- INSERT into caracteristiqueEtudiant(idetudiant,idsemestre) VALUES
-- (1,1),
-- (1,2),
-- (2,2);
-- (4,4),
-- (5,1),
-- (5,2);


-- INSERT INTO notematiere (idmatiere, idetudiant, note)
-- VALUES 
--     -- Étudiant 1
--     (1, 1, 5.5), (2, 1, 10.0), (3, 1, 15.0), (4, 1, 7.0), (5, 1, 12.0), (6, 1, 16.0);
    
--     -- (13, 1, 5.5), (14, 1, 9.0), (15, 1, 12.5), (16, 1, 6.0), (17, 1, 11.5), (18, 1, 13.0),
--     -- (19, 1, 7.5), (20, 1, 10.0), (21, 1, 14.5), (22, 1, 5.0), (23, 1, 9.5), (24, 1, 12.0),
--     -- (25, 1, 6.5), (26, 1, 10.0), (27, 1, 13.5), (28, 1, 7.0), (29, 1, 11.0), (30, 1, 14.0),
--     -- (31, 1, 8.5), (32, 1, 10.5), (33, 1, 15.0), (34, 1, 6.0), (35, 1, 12.0), (36, 1, 14.5),
--     -- (37, 1, 7.5), (38, 1, 11.5), (39, 1, 13.0),

--     -- Étudiant 4
--     -- (1, 4, 8.5), (2, 4, 11.5), (3, 4, 15.0), (4, 4, 7.5), (5, 4, 13.5), (6, 4, 15.5),
--     -- (7, 4, 10.0), (8, 4, 12.0), (9, 4, 14.0), (10, 4, 7.0), (11, 4, 11.0), (12, 4, 15.0),
--     INSERT INTO notematiere (idmatiere, idetudiant, note)
-- VALUES 

--     (7, 2, 5.0), (8, 2, 9.0), (9, 2, 13.0), (10, 2, 6.5), (11, 2, 11.0), (12, 2, 13.5),
--     (13, 2, 7.5),(14, 2, 7.5),(15, 2, 14);
--     -- Étudiant 5
-- --     INSERT INTO notematiere (idmatiere, idetudiant, note)
-- -- VALUES 

-- --     (1, 5, 5.0), (2, 5, 10.0), (3, 5, 15.0), (4, 5, 8.0), (5, 5, 12.0), (6, 5, 16.0),
-- --     (7, 5, 9.0), (8, 5, 11.0), (9, 5, 13.0), (10, 5, 7.0), (11, 5, 10.5), (12, 5, 14.0);
--     -- (13, 5, 5.5), (14, 5, 9.0), (15, 5, 12.5), (16, 5, 6.0), (17, 5, 11.5), (18, 5, 13.0),
--     -- (19, 5, 7.5), (20, 5, 10.0), (21, 5, 14.5), (22, 5, 5.0), (23, 5, 9.5), (24, 5, 12.0),
--     -- (25, 5, 6.5), (26, 5, 10.0), (27, 5, 13.5), (28, 5, 7.0), (29, 5, 11.0), (30, 5, 14.0),
--     -- (31, 5, 8.5), (32, 5, 10.5), (33, 5, 15.0), (34, 5, 6.0), (35, 5, 12.0), (36, 5, 14.5),
--     -- (37, 5, 7.5), (38, 5, 11.5), (39, 5, 13.0),

    

-- --   INSERT INTO resultat (min,max,moyennemin,moyennemax,nom)VALUES
-- --   (10, 12, 0, 20,'P'),
-- --   (12, 15, 0, 20,'AB'),
-- --   (0, 10, 0, 10,'AJ'),
-- --   (6 ,10 ,10, 20, 'C');


-- insert into configurationnote(code,config,valeur)VALUES
-- ('CONF1','Limite note ajournée',6),
-- ('CONF2','Nb de matière max compensé',2),
-- ('CONF3','type de calcul note matiere',1);



-- Donnee de test entrainement
-- INSERT INTO promotion (nompromotion) VALUES
-- ('P1');
-- INSERT INTO etudiant (numETU, nom, prenom, dateDeNaissance,idpromotion) VALUES
-- ('ETU001', 'Dupont', 'Jean', '1995-03-15',1),
-- ('ETU002', 'Durand', 'Marie', '1998-07-22',1),
-- ('ETU003', 'Lefevre', 'Pierre', '1997-01-10',1);

-- INSERT INTO semestre (nomsemestre) VALUES
-- ('S1');
-- INSERT INTO semestre (nomsemestre) VALUES
-- ('S4');


-- INSERT INTO matiere (nomMatiere, codeMatiere) VALUES
-- ('Programmation procédurale', 'INF101'),
-- ('HTML et Introduction au Web', 'INF104'),
-- ('Informatique de Base', 'INF107'),
-- ('Arithmétique et nombres', 'MTH101'),
-- ('Analyse mathématique', 'MTH102'),
-- ('Techniques de communication', 'ORG101');
-- INSERT INTO matiere (nomMatiere, codeMatiere) VALUES
-- ('Système d''information géographique', 'INF204'),
-- ('Système d''information', 'INF205'),
-- ('Interface Homme/Machine', 'INF206'),
-- ('Eléments d''algorithmique', 'INF207'),
-- ('Mini-projet de développement', 'INF210' ),
-- ('Géométrie', 'MTH204'),
-- ('Equations différentielles', 'MTH205'),
-- ('Optimisation', 'MTH206'),
-- ('MAO', 'MTH203');


-- INSERT INTO matieresemestre (idmatiere,idsemestre,credit,identifiant)VALUES
-- (1 ,1 ,7 ,4),
-- (2 ,1 ,5 ,5),
-- (3 ,1 ,4 ,6),
-- (4 ,1 ,4 ,7),
-- (5 ,1 ,6 ,8),
-- (6 ,1 ,4 ,9);

-- INSERT INTO matieresemestre (idmatiere,idsemestre,credit,identifiant)VALUES
-- (7 ,2 ,6 ,1),
-- (8 ,2 ,6 ,1),
-- (9 ,2 ,6 ,1),
-- (10 ,2 ,6 ,22),
-- (11 ,2 ,10 ,23),
-- (12 ,2 ,4 ,2),
-- (13 ,2 ,4 ,2),
-- (14 ,2 ,4 ,2),
-- (15 ,2 ,4 ,24);

-- INSERT into caracteristiqueEtudiant(idetudiant,idsemestre) VALUES
-- (1,1),
-- (1,2),
-- (4,3),
-- (4,4),
-- (5,1),
-- (5,2);



-- /////////////////////////////////////////////////NAJAINA
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF101', 'Programmation procédurale', 7, 1);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF104', 'HTML et Introduction au Web', 5, 1);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF107', 'Informatique de Base', 4, 1);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('MTH101', 'Arithmétique et nombres', 4, 1);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('MTH102', 'Analyse mathématique', 6, 1);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('ORG101', 'Techniques de communication', 4, 1);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF102', 'Bases de données relationnelles', 5, 2);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF103', 'Bases de l administration système', 5, 2);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF105', 'Maintenance matériel et logiciel', 4, 2);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF106', 'Compléments de programmation', 6, 2);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('MTH103', 'Calcul Vectoriel et Matriciel', 6, 2);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('MTH105', 'Probabilité et Statistique', 4, 2);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF201', 'Programmation orientée objet', 6, 3);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF202', 'Bases de données objets', 6, 3);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF203', 'Programmation système', 4, 3);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF208', 'Réseaux informatiques', 6, 3);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('MTH201', 'Méthodes numériques', 4, 3);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('ORG201', 'Bases de gestion', 4, 3);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF204', 'Système d information géographique', 6, 4);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF205', 'Système d information', 6, 4);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF206', 'Interface Homme/Machine', 6, 4);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF207', 'Eléments d algorithmique', 6, 4);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF210', 'Mini-projet de développement', 10, 4);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('MTH204', 'Géométrie', 4, 4);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('MTH205', 'Equations différentielles', 4, 4);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('MTH206', 'Optimisation', 4, 4);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('MTH203', 'MAO', 4, 4);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF301', 'Architecture logicielle', 6, 5);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF304', 'Développement pour mobiles', 6, 5);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF307', 'Conception en modèle orienté objet', 6, 5);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('ORG301', 'Gestion d entreprise', 5, 5);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('ORG302', 'Gestion de projets', 4, 5);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('ORG303', 'Anglais pour les affaires', 3, 5);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF310', 'Codage', 4, 6);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF313', 'Programmation avancée, frameworks', 6, 6);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF302', 'Technologies d accès aux réseaux', 6, 6);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF303', 'Multimédia', 6, 6);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('INF316', 'Projet de développement', 10, 6);
-- INSERT INTO matiere (code_matiere, nom, credit, id_semestre) VALUES ('ORG304', 'Communication d entreprise', 4, 6);





