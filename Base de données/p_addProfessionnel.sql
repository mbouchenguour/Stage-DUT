DELIMITER |
CREATE PROCEDURE addProfessionnel(IN id INT(10), IN nomCompte VARCHAR(45), IN dateCreation DATE, IN nom VARCHAR(45), IN prenom VARCHAR(45), IN adresse VARCHAR(100), IN cp VARCHAR(5), IN ville VARCHAR(45), IN pays VARCHAR(45), IN mail VARCHAR(100), IN telephone VARCHAR(10), IN nomSociete VARCHAR(45), IN siret VARCHAR(14), IN codeApe VARCHAR(5), IN numeroTVA VARCHAR(13))

BEGIN
    INSERT INTO Client VALUES(id,nomCompte,dateCreation,nom,prenom,prenom,adresse,cp,ville,pays,mail,telephone);
    INSERT INTO Professionnel VALUES(id,nomSociete,siret,codeApe,numeroTVA);
END |
DELIMITER ;