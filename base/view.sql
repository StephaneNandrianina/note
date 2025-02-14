
-- CREATE OR REPLACE VIEW V_filtreEtudiant AS
-- SELECT DISTINCT
--     etud.idetudiant,
--     etud.numetu, 
--     etud.nom, 
--     etud.prenom, 
--     etud.datedenaissance, 
--     etud.idpromotion, 
--     pro.nompromotion,
--     ce.idsemestre
-- FROM etudiant etud
-- JOIN promotion pro ON etud.idpromotion = pro.idpromotion 
-- JOIN caracteristiqueEtudiant ce ON etud.idetudiant = ce.idetudiant
-- JOIN semestre sem ON ce.idsemestre = sem.idsemestre;
CREATE OR REPLACE VIEW V_filtreEtudiant AS
SELECT DISTINCT
    etud.idetudiant,
    etud.numetu, 
    etud.nom, 
    etud.prenom, 
    etud.datedenaissance, 
    etud.idpromotion, 
    pro.nompromotion,
    ms.idsemestre
FROM etudiant etud
JOIN promotion pro ON etud.idpromotion = pro.idpromotion 
JOIN notematiere nm ON etud.idetudiant = nm.idetudiant
JOIN matiereSemestre ms ON nm.idmatiere = ms.idmatiere
JOIN semestre sem ON ms.idsemestre = sem.idsemestre;


-- CREATE or REPLACE view v_joinEtudiantChaqueMatiere AS
-- SELECT 
--     e.idetudiant,
--     e.nom,
--     mat.idmatiere,
--     mat.nomMatiere,
--     COALESCE(notmat.note, 0) AS note
-- FROM 
--     etudiant e
-- CROSS JOIN 
--     matiere mat
-- LEFT JOIN 
--     notematiere notmat 
-- ON 
--     e.idetudiant = notmat.idetudiant 
--     AND mat.idmatiere = notmat.idmatiere
-- ORDER by idetudiant,idmatiere;



-- CREATE or REPLACE view V_PlusieurNoteGetMaxInMatiere AS
-- SELECT et.idetudiant,et.nom,m.idmatiere,m.nommatiere,MAX(j_etuMat.note) as notemax, mts.identifiant,s.idsemestre,s.nomsemestre
-- FROM v_joinEtudiantChaqueMatiere j_etuMat
-- JOIN matiere m ON j_etuMat.idmatiere= m.idmatiere
-- JOIN etudiant et ON j_etuMat.idetudiant = et.idetudiant
-- JOIN matieresemestre mts ON m.idmatiere = mts.idmatiere
-- JOIN semestre s ON mts.idsemestre = s.idsemestre
-- GROUP BY 
--  et.idetudiant, et.nom, et.prenom, m.idmatiere, m.nommatiere,mts.identifiant,s.idsemestre,s.nomsemestre
--  ORDER by idetudiant,identifiant;


-- CREATE or REPLACE view V_PlusieurNoteGetMaxInMatiere AS
-- SELECT et.idetudiant,et.nom,m.idmatiere,m.nommatiere,MAX(ntm.note) as notemax, mts.identifiant,s.idsemestre,s.nomsemestre
-- FROM notematiere ntm
-- JOIN matiere m ON ntm.idmatiere= m.idmatiere
-- JOIN etudiant et ON ntm.idetudiant = et.idetudiant
-- JOIN matieresemestre mts ON m.idmatiere = mts.idmatiere
-- JOIN semestre s ON mts.idsemestre = s.idsemestre
-- GROUP BY 
--  et.idetudiant, et.nom, et.prenom, m.idmatiere, m.nommatiere,mts.identifiant,s.idsemestre,s.nomsemestre
--  ORDER by idetudiant,identifiant;



-- CREATE OR REPLACE VIEW V_noteMaxOptionnel AS
-- SELECT 
--     idetudiant,
--     nom,
--     MAX(notemax) AS note_max,
--     identifiant
-- FROM V_PlusieurNoteGetMaxInMatiere
-- GROUP BY 
--     idetudiant, 
--     nom, 
--     identifiant
-- ORDER BY 
--     idetudiant;



-- CREATE or REPLACE view V_vaovao as 
-- SELECT idmatiere, idsemestre, nommatiere, notemax , vp.idetudiant, vp.identifiant
-- FROM V_noteMaxOptionnel v
-- join V_PlusieurNoteGetMaxInMatiere vp ON v.note_max = vp.notemax 
-- AND v.identifiant = vp.identifiant 
-- AND v.idetudiant = vp.idetudiant
-- -- WHERE  idsemestre = 4
-- ;

-- CREATE or replace VIEW V_moyenneetudiantsemestre AS
-- SELECT AVG(notemax) AS moyenneParSemestre
-- from v_vaovao
-- ;



-- CREATE or replace view V_listeSemestreEtudiant AS
-- SELECT c.idetudiant, s.idsemestre,s.nomsemestre
-- FROM caracteristiqueEtudiant c
-- JOIN semestre s ON c.idsemestre = s.idsemestre;

CREATE OR REPLACE VIEW V_listeSemestreEtudiant AS
SELECT DISTINCT
    nm.idetudiant,
    sem.idsemestre,
    sem.nomsemestre
FROM notematiere nm
JOIN matiereSemestre ms ON nm.idmatiere = ms.idmatiere
JOIN semestre sem ON ms.idsemestre = sem.idsemestre;


-- CREATE or replace VIEW details_et_moyenne_generale AS
-- SELECT m.codematiere,
--        v.nommatiere,
--        mts.credit,
--        v.notemax,
--        v.idetudiant,
--        v.idsemestre,
--        (SELECT AVG(v2.notemax)
--         FROM v_vaovao v2
--         WHERE v2.idsemestre = v.idsemestre
--           AND v2.idetudiant = v.idetudiant) AS moyennenote_generale 
-- FROM v_vaovao v
-- JOIN matiere m ON v.idmatiere = m.idmatiere
-- JOIN matieresemestre mts ON m.idmatiere = mts.idmatiere
-- -- WHERE v.idsemestre = 3
-- --   AND v.idetudiant = 4
-- GROUP BY m.codematiere, v.nommatiere,mts.credit, v.notemax, v.idetudiant, v.idsemestre
-- ORDER by idetudiant,idsemestre;




-- CREATE or REPLACE view v_releve AS
-- SELECT det.codematiere,
--        det.nommatiere,
--        CASE
--          WHEN res.nom = 'AJ' THEN 0
--          ELSE det.credit
--        END AS credit,
--        det.notemax,
--        det.idetudiant,
--        det.idsemestre,
--        det.moyennenote_generale,
--        res.nom AS resultat
-- FROM details_et_moyenne_generale det
-- JOIN resultat res
--   ON det.notemax BETWEEN res.min AND res.max
--   AND det.moyennenote_generale BETWEEN res.moyennemin AND res.moyennemax
-- --   WHERE det.idsemestre = 3
-- --    AND det.idetudiant = 4
--   ;

-- CREATE or REPLACE VIEW configuration_settings AS
-- SELECT
--   MAX(CASE WHEN code = 'CONF1' THEN valeur END) AS note_min_compense,
--   MAX(CASE WHEN code = 'CONF2' THEN valeur END) AS matiere_max_compense
-- FROM configurationnote;  

-- CREATE OR REPLACE VIEW compensable_matiere_counts AS
-- SELECT e.idetudiant,
--        s.idsemestre,
--        COUNT(*) AS nb_compensees
-- FROM etudiant e
-- CROSS JOIN semestre s
-- LEFT JOIN matiere m ON max_note.idmatiere = m.idmatiere
-- LEFT JOIN matieresemestre mts ON m.idmatiere = mts.idmatiere AND s.idsemestre = mts.idsemestre
-- LEFT JOIN notematiere max_note ON e.idetudiant = max_note.idetudiant AND s.idsemestre = mts.idsemestre
-- LEFT JOIN details_et_moyenne_generale det ON e.idetudiant = det.idetudiant
-- LEFT JOIN configuration_settings conf ON TRUE
-- WHERE max_note.note >= conf.note_min_compense AND max_note.note < 10
--   AND det.moyennenote_generale >= 10
-- GROUP BY e.idetudiant, s.idsemestre;



-- CREATE or REPLACE view v_releve AS
-- SELECT det.codematiere,
--        det.nommatiere,
--        CASE
--          WHEN res.nom = 'AJ' THEN 0
--          ELSE det.credit
--        END AS credit,
--        det.notemax,
--        det.idetudiant,
--        det.idsemestre,
--        det.moyennenote_generale,
--        CASE 
--         WHEN det.notemax >= conf.note_min_compense AND det.notemax < 10 THEN
--         CASE
--           WHEN det.moyennenote_generale >= 10 AND 
--           ELSE 'AJ'
--          END 
--        res.nom AS resultat
-- FROM details_et_moyenne_generale det
-- JOIN configuration_settings conf
-- JOIN resultat res
--   ON det.notemax BETWEEN res.min AND res.max
--   AND det.moyennenote_generale BETWEEN res.moyennemin AND res.moyennemax
-- --   WHERE det.idsemestre = 3
-- --    AND det.idetudiant = 4
--   ;


















































