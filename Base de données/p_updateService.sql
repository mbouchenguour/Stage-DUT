DELIMITER |
CREATE PROCEDURE updateService(IN idService INT(10), IN nomService VARCHAR(45), IN description TEXT, IN origine VARCHAR(45), IN tauxTVA DECIMAL(4,2), IN prixHTA DECIMAL(7,2), IN prixHTS DECIMAL(7,2), IN prixHTT DECIMAL(7,2), IN prixHTM DECIMAL(7,2))

BEGIN
	UPDATE Service SET
    nomService = nomService,
    description = description,
    origine = origine,
    tauxTVA = tauxTVA,
    prixHTA = prixHTA,
    prixHTS = prixHTS,
    prixHTT = prixHTT,
    prixHTM = prixHTM
    WHERE
    idService = idService;
    
END |
DELIMITER ;