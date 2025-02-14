

create or replace view V_liste_etape AS
SELECT 
     c.idcoureur,
     c.nomCoureur,
     cou.nomcourse,
     e.nometape,
     e.nbrCoureur,
     e.longueurKm,
     e.rang,
     e.depart 
FROM etapeCoureur etpc
JOIN coureur c ON etpc.idCoureur = c.idcoureur
JOIN etape e ON etpc.idetape = e.idetape
JOIN course cou ON e.idcourse = cou.idcourse
;


CREATE OR REPLACE FUNCTION reinitialisation() 
    RETURNS VOID 
    LANGUAGE PLPGSQL
AS $$
DECLARE
    table_name TEXT;
BEGIN 
    FOR table_name IN 
        SELECT tablename 
        FROM pg_catalog.pg_tables 
        WHERE schemaname = 'public' 
    LOOP
        EXECUTE 'ALTER TABLE '|| table_name ||' DISABLE TRIGGER ALL';  

        IF table_name='admin' THEN 
            EXECUTE 'DELETE FROM ' || table_name || ' WHERE idadmin != 1'; 
        ELSIF table_name='course' THEN -- Ajout d'une nouvelle condition avec ELSIF
            EXECUTE 'DELETE FROM ' || table_name || ' WHERE idcourse != 1';     
        ELSE
            EXECUTE 'DELETE FROM ' || table_name; 
        END IF;

        EXECUTE 'ALTER TABLE '|| table_name ||' ENABLE TRIGGER ALL';    
    END LOOP;
END;
$$;
