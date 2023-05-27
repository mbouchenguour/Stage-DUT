DELIMITER |
CREATE PROCEDURE addAssociation(IN id INT(10), IN nomCompte VARCHAR(45), IN dateCreation DATE, IN nom VARCHAR(45), IN prenom VARCHAR(45), IN adresse VARCHAR(100), IN cp VARCHAR(5), IN ville VARCHAR(45), IN pays VARCHAR(45), IN mail VARCHAR(100), IN telephone VARCHAR(10), IN nomAssociation VARCHAR(45), IN dateDeclaration DATE, IN datePublication DATE, IN numeroAnnonce VARCHAR(10))

BEGIN
    INSERT INTO Client VALUES(id,nomCompte,dateCreation,nom,prenom,prenom,adresse,cp,ville,pays,mail,telephone);
    INSERT INTO Association VALUES(id,nomAssociation,dateDeclaration,datePublication, numeroAnnonce);
END |
DELIMITER ;