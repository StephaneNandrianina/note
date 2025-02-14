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

        IF table_name='etudiant' THEN 
            EXECUTE 'DELETE FROM ' || table_name || ' WHERE profil != 1'; 
        ELSE
            EXECUTE 'DELETE FROM ' || table_name; 
        END IF;

        EXECUTE 'ALTER TABLE '|| table_name ||' ENABLE TRIGGER ALL';    
    END LOOP;
END;
$$;


SELECT reinitialisation();

ALTER TABLE users DROP COLUMN password;
SELECT SUM(montantconstruction) FROM v_demandepaiement;
