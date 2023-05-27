DELIMITER |
CREATE PROCEDURE updateParticulier(IN id INT(10), IN nomCompte VARCHAR(45), IN dateCreation DATE, IN nom VARCHAR(45), IN prenom VARCHAR(45), IN adresse VARCHAR(100), IN cp VARCHAR(5), IN ville VARCHAR(45), IN pays VARCHAR(45), IN mail VARCHAR(100), IN telephone VARCHAR(10), IN dateNaissance DATE, IN villeNaissance VARCHAR(45), IN paysNaissance VARCHAR(45))

BEGIN
	UPDATE Client SET
    nomCompte = nomCompte,
    dateCreation = dateCreation,
    nom = nom,
    prenom = prenom,
    adresse = adresse,
    cp = cp,
    ville = ville,
    pays = pays,
    mail = mail,
    telephone = telephone
    WHERE
    id = id;
    
    UPDATE Particulier SET
    dateNaissance = dateNaissance,
    villeNaissance = villeNaissance,
    paysNaissance = paysNaissance
    WHERE
    id = id;
    
END |
DELIMITER ;