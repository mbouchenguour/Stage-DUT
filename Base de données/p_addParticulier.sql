DELIMITER |
CREATE PROCEDURE addParticulier(IN id INT(10), IN nomCompte VARCHAR(45), IN dateCreation DATE, IN nom VARCHAR(45), IN prenom VARCHAR(45), IN adresse VARCHAR(100), IN cp VARCHAR(5), IN ville VARCHAR(45), IN pays VARCHAR(45), IN mail VARCHAR(100), IN telephone VARCHAR(10), IN dateNaissance DATE, IN villeNaissance VARCHAR(45), IN paysNaissance VARCHAR(45))

BEGIN
    INSERT INTO Client VALUES(id,nomCompte,dateCreation,nom,prenom,prenom,adresse,cp,ville,pays,mail,telephone);
    INSERT INTO Particulier VALUES(id,dateNaissance,villeNaissance,paysNaissance);
END |
DELIMITER ;