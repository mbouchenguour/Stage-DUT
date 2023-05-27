DELIMITER |
CREATE PROCEDURE updateProfessionnel(IN id INT(10), IN nomCompte VARCHAR(45), IN dateCreation DATE, IN nom VARCHAR(45), IN prenom VARCHAR(45), IN adresse VARCHAR(100), IN cp VARCHAR(5), IN ville VARCHAR(45), IN pays VARCHAR(45), IN mail VARCHAR(100), IN telephone VARCHAR(10), IN nomSociete VARCHAR(45), IN siret VARCHAR(14), IN codeApe VARCHAR(5), IN numeroTVA VARCHAR(13))

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
    
    UPDATE Professionnel SET
    nomSociete = nomSociete,
    siret = siret,
    codeApe = codeApe,
    numeroTVA = numeroTVA
    WHERE
    id = id;
    
END |
DELIMITER ;