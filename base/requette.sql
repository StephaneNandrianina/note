


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
        ELSE
            EXECUTE 'DELETE FROM ' || table_name; 
        END IF;

        EXECUTE 'ALTER TABLE '|| table_name ||' ENABLE TRIGGER ALL';    
    END LOOP;
END;
$$;




-- CREATE OR REPLACE FUNCTION insert_location_monthly_summary()
-- RETURNS void AS $$
-- BEGIN
--     WITH month_series AS (
--         SELECT
--             location.id_location,
--             location.id_biens,
--             location.loyer,
--             location.id_client,
--             location.commission,
--             location.date_debut,
--             location.duree,
--             generate_series(
--                 date_trunc('month', location.date_debut),
--                 date_trunc('month', location.date_debut) + interval '1 month' * (location.duree - 1),
--                 interval '1 month'
--             ) AS month_start
--         FROM location
--     ),
--     ranked_series AS (
--         SELECT
--             ms.id_location,
--             biens.id_proprietaire,
--             ms.loyer,
--             ms.id_biens,
--             biens.nom,
--             ms.id_client,
--             ms.commission,
--             ms.month_start::date AS date_debut,
--             (date_trunc('month', ms.month_start) + interval '1 month - 1 day') AS fin_du_mois,
--             ROW_NUMBER() OVER (PARTITION BY ms.id_location ORDER BY ms.month_start) AS month_rank
--         FROM month_series ms
--         JOIN biens ON biens.id_biens = ms.id_biens
--     ),
--     computed_series AS (
--         SELECT
--             rs.id_location,
--             rs.id_proprietaire,
--             rs.id_biens,
--             rs.nom,
--             rs.id_client,
--             rs.date_debut,
--             rs.fin_du_mois,
--             CASE
--                 WHEN rs.month_rank = 1 THEN (100)
--                 ELSE rs.commission
--             END AS pourcentage_commission,
--             CASE
--                 WHEN rs.month_rank = 1 THEN (rs.loyer + (rs.loyer * 100 / 100))
--                 ELSE rs.loyer
--             END AS loyer,
--             CASE
--                 WHEN rs.month_rank = 1 THEN (rs.loyer)
--                 ELSE (rs.loyer * rs.commission / 100)
--             END AS commission,
--             rs.month_rank
--         FROM ranked_series rs
--     )
--     INSERT INTO location_monthly_summary ( 
--         id_location, id_proprietaire ,loyer, id_biens, nom, id_client, commission, commission_pourcentage, date_debut, fin_du_mois, montant_proprietaire, month_rank
--     )
--     SELECT
--         cs.id_location,
--         cs.id_proprietaire,
--         cs.loyer,
--         cs.id_biens,
--         cs.nom,
--         cs.id_client,
--         cs.commission,
--         cs.pourcentage_commission,
--         cs.date_debut,
--         cs.fin_du_mois,
--         (cs.loyer - cs.commission) AS montant_proprietaire,
--         cs.month_rank
--     FROM computed_series cs;
-- END;
-- $$ LANGUAGE plpgsql;



CREATE OR REPLACE FUNCTION insert_location_monthly_summary()
RETURNs void AS $$
BEGIN 
    WITH month_series AS(
        SELECT
            location.idlocation,
            bien.idproprietaire,
            location.idclient,
            location.idbien,
            bien.loyer,
            location.duree,
            location.datedebut,
            location.commission,
            GENERATE_SERIES(
                date_trunc('month',location.datedebut),
                date_trunc('month',location.datedebut) + interval '1 month' * (location.duree - 1),
                interval '1 month'
            )AS month_start
        FROM location  
        JOIN bien ON location.idbien = bien.idbien  
    ),

    ranked_series AS (
        SELECT
            ms.idlocation,
            bien.idproprietaire,
            ms.loyer,
            ms.idbien,
            bien.nombien,
            ms.idclient,
            ms.commission,
            ms.month_start::date AS datedebut,
            (date_trunc('month', ms.month_start) + interval '1 month - 1 day') AS fin_du_mois,
            ROW_NUMBER() OVER (PARTITION BY ms.idlocation ORDER BY ms.month_start) AS month_rank
         FROM month_series ms 
         JOIN bien ON bien.idbien = ms.idbien   
    ),
    computed_series AS(
        SELECT
            rs.idlocation,
            rs.idproprietaire,
            rs.idbien,
            rs.nombien,
            rs.idclient,
            rs.datedebut,
            rs.fin_du_mois,
            CASE 
                WHEN rs.month_rank = 1 THEN (100)
                ELSE rs.commission
            END AS pourcentage_commission,
            CASE 
                WHEN rs.month_rank = 1 THEN (rs.loyer + (rs.loyer * 100 / 100))
                ELSE rs.loyer
            END AS loyer,
            CASE
                WHEN rs.month_rank = 1 THEN (rs.loyer) 
                ELSE (rs.loyer * rs.commission / 100)
            END AS commission,
             rs.month_rank             
        FROM ranked_series rs
    )
    -- INSERT INTO location_monthly_summary (
    --     idlocation,idproprietaire,loyer,idbien,nombien,idclient,commission,pourcentage_commission ,datedebut,fin_du_mois,montant_proprietaire,month_rank
    -- )

    SELECT 
        cs.idlocation,
        cs.idproprietaire,
        cs.loyer,
        cs.idbien,
        cs.nombien,
        cs.idclient,
        cs.commission,
        cs.pourcentage_commission,
        cs.datedebut,
        cs.fin_du_mois,
        (cs.loyer - cs.commission) AS montant_proprietaire,
        cs.month_rank
    FROM computed_series cs;    
END;
$$ LANGUAGE plpgsql;  