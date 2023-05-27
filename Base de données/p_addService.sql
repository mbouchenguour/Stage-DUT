DELIMITER |
CREATE PROCEDURE addService(IN idService INT(10), IN nomService VARCHAR(45), IN description TEXT, IN origine VARCHAR(45), IN tauxTVA DECIMAL(4,2), IN prixHTA DECIMAL(7,2), IN prixHTS DECIMAL(7,2), IN prixHTT DECIMAL(7,2), IN prixHTM DECIMAL(7,2))

BEGIN
    INSERT INTO Service VALUES(idService,nomService,description,origine,tauxTVA,prixHTA,prixHTS,prixHTT,prixHTM);
END |
DELIMITER ;