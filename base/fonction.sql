
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

        -- Ne pas supprimer les données des tables admin et user
        IF table_name NOT IN ('admin', 'matiere','matieresemestre','resultat','semestre','resultat','annee') THEN 
            EXECUTE 'DELETE FROM ' || table_name; 
        END IF;

        EXECUTE 'ALTER TABLE '|| table_name ||' ENABLE TRIGGER ALL';    
    END LOOP;
END;
$$;

SELECT reinitialisation();






