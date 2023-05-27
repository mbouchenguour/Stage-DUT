DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `addAssociation`(IN `id` INT(10), IN `nomCompte` VARCHAR(45), IN `dateCreation` DATE, IN `nom` VARCHAR(45), IN `prenom` VARCHAR(45), IN `adresse` VARCHAR(100), IN `cp` VARCHAR(5), IN `ville` VARCHAR(45), IN `pays` VARCHAR(45), IN `mail` VARCHAR(100), IN `telephone` VARCHAR(10), IN `nomAssociation` VARCHAR(45), IN `dateDeclaration` DATE, IN `datePublication` DATE, IN `numeroAnnonce` VARCHAR(10))
BEGIN
    INSERT INTO Client VALUES(id,nomCompte,dateCreation,nom,prenom,adresse,cp,ville,pays,mail,telephone,3);
    INSERT INTO Association VALUES(id,nomAssociation,dateDeclaration,datePublication, numeroAnnonce);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `addFormuleClient`(IN `idFormule` INT(10), IN `idClient` INT(10), IN `idService` INT(10), IN `dateSouscription` DATE, IN `dateFinService` DATE, IN `typeFacturation` INT(10), IN `prix` FLOAT(7,2))
BEGIN

    INSERT INTO Formules_clients(idClient,idService,dateSouscription,dateFinService,typeFacturation,prix)
VALUES(idClient,idService,dateSouscription,dateFinService,typeFacturation,prix);

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `addMail`(IN `idClient` INT, IN `sujet` VARCHAR(200), IN `body` TEXT)
INSERT INTO Mail(idClient, sujet, body) VALUES (idClient, sujet, body)$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `addMembre`(IN `pseudo` VARCHAR(255), IN `password` VARCHAR(255), IN `email` VARCHAR(255), IN `dateInscription` DATE, IN `idGroupe` INT(10), IN `idClient` INT(10))
INSERT INTO Membres(pseudo, password, email,dateInscription,idGroupe,idClient) VALUES (pseudo, password, email, dateInscription, idGroupe, idClient)$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `addParticulier`(IN `id` INT(10), IN `nomCompte` VARCHAR(45), IN `dateCreation` DATE, IN `nom` VARCHAR(45), IN `prenom` VARCHAR(45), IN `adresse` VARCHAR(100), IN `cp` VARCHAR(5), IN `ville` VARCHAR(45), IN `pays` VARCHAR(45), IN `mail` VARCHAR(100), IN `telephone` VARCHAR(10), IN `dateNaissance` DATE, IN `villeNaissance` VARCHAR(45), IN `paysNaissance` VARCHAR(45))
BEGIN
    INSERT INTO Client VALUES(id,nomCompte,dateCreation,nom,prenom,adresse,cp,ville,pays,mail,telephone,1);
    INSERT INTO Particulier VALUES(id,dateNaissance,villeNaissance,paysNaissance);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `addProfessionnel`(IN `id` INT(10), IN `nomCompte` VARCHAR(45), IN `dateCreation` DATE, IN `nom` VARCHAR(45), IN `prenom` VARCHAR(45), IN `adresse` VARCHAR(100), IN `cp` VARCHAR(5), IN `ville` VARCHAR(45), IN `pays` VARCHAR(45), IN `mail` VARCHAR(100), IN `telephone` VARCHAR(10), IN `nomSociete` VARCHAR(45), IN `siret` VARCHAR(14), IN `codeApe` VARCHAR(5), IN `numeroTVA` VARCHAR(13))
BEGIN
    INSERT INTO Client VALUES(id,nomCompte,dateCreation,nom,prenom,adresse,cp,ville,pays,mail,telephone,2);
    INSERT INTO Professionnel VALUES(id,nomSociete,siret,codeApe,numeroTVA);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `addService`(IN `idService` INT, IN `nomService` VARCHAR(45), IN `description` TEXT, IN `origine` VARCHAR(45), IN `tauxTVA` DECIMAL(4,2), IN `prixHTA` DECIMAL(7,2), IN `prixHTS` DECIMAL(7,2), IN `prixHTT` DECIMAL(7,2), IN `prixHTM` DECIMAL(7,2))
BEGIN
    INSERT INTO Service(nomService,description,origine,tauxTVA,prixHTA,prixHTS,prixHTT,prixHTM) VALUES(nomService,description,origine,tauxTVA,prixHTA,prixHTS,prixHTT,prixHTM);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `deleteAllClientByYear`(IN `date` YEAR)
DELETE FROM Client WHERE YEAR(Client.dateCreation) = date$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `deleteClient`(IN `id` INT)
    NO SQL
BEGIN
UPDATE Formules_clients SET supprime = 1 WHERE Formules_clients.idClient = id;
DELETE FROM Client WHERE Client.id = id;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `deleteFormule`(IN `idFormule` INT(10))
BEGIN
    UPDATE Formules_clients SET
    Formules_clients.supprime = 1
    WHERE Formules_clients.idFormule = idFormule;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `deleteHistorique`(IN `idFormule` INT)
Delete FROM Formules_clients WHERE Formules_clients.idFormule = idFormule$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `deleteMail`(IN `id` INT)
BEGIN
	DELETE FROM Mail WHERE Mail.idMail = id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `deleteService`(IN `id` INT)
    NO SQL
BEGIN
UPDATE Formules_clients SET supprime=1 where Formules_clients.idService = id;
	DELETE FROM Service WHERE Service.idService = id;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getAllAssociations`()
    NO SQL
SELECT Client.id,
nomCompte,
dateCreation,
nom,
prenom,
adresse,
cp,
ville,
pays,
mail,
telephone,
nomAssociation,
dateDeclaration,
datePublication,
numeroAnnonce
FROM Client
JOIN Association ON Association.id = Client.id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getAllClients`()
    NO SQL
BEGIN
    SELECT 
    Client.id,
    nomCompte,
    dateCreation,
    nom,
    prenom,
    adresse,
    cp,
    ville,
    pays,
    mail,
    dateNaissance,
    villeNaissance,
    paysNaissance,
    telephone,
    idTypeClient,
    nomSociete,
    siret,
    codeApe,
    numeroTVA,
    nomAssociation,
    dateDeclaration,
    datePublication,
    numeroAnnonce
	FROM Client
	LEFT JOIN Particulier ON Client.id = Particulier.id
    LEFT JOIN Professionnel ON Client.id = Professionnel.id
    LEFT JOIN Association ON Client.id = Association.id;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getAllFormules`()
SELECT * FROM Formules_clients WHERE Formules_clients.supprime = 0$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getAllHistorique`()
SELECT * FROM Formules_clients$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getAllParticuliers`()
    NO SQL
SELECT Client.id,
nomCompte,
dateCreation,
nom,
prenom,
adresse,
cp,
ville,
pays,
mail,
telephone,
dateNaissance,
villeNaissance,
paysNaissance
FROM Client
JOIN Particulier ON Particulier.id = Client.id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getAllProfessionnels`()
    NO SQL
SELECT Client.id,
nomCompte,
dateCreation,
nom,
prenom,
adresse,
cp,
ville,
pays,
mail,
telephone,
nomSociete,
siret,
codeApe,
numeroTVA
FROM Client
JOIN Professionnel ON Professionnel.id = Client.id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getAllServices`()
    NO SQL
SELECT * FROM Service$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getAssociationById`(IN `id` INT)
    NO SQL
SELECT id,
nomCompte,
dateCreation,
nom,
prenom,
adresse,
cp,
ville,
pays,
mail,
telephone,
nomAssociation,
dateDeclaration,
datePublication,
numeroAnnonce
FROM Client
JOIN Association ON Association.id = Client.id
WHERE Client.id = id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getByDefaultMail`()
BEGIN
	SELECT * FROM Mail
    WHERE Mail.idMail = 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getClientById`(IN `id` INT)
BEGIN
    SELECT 
    Client.id,
    nomCompte,
    dateCreation,
    nom,
    prenom,
    adresse,
    cp,
    ville,
    pays,
    mail,
    dateNaissance,
    villeNaissance,
    paysNaissance,
    telephone,
    idTypeClient,
    nomSociete,
    siret,
    codeApe,
    numeroTVA,
    nomAssociation,
    dateDeclaration,
    datePublication,
    numeroAnnonce
	FROM Client
	LEFT JOIN Particulier ON Client.id = Particulier.id
    LEFT JOIN Professionnel ON Client.id = Professionnel.id
    LEFT JOIN Association ON Client.id = Association.id
    WHERE Client.id = id;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getClientsByService`(IN `idService` INT)
BEGIN
    SELECT 
    Client.id,
    nomCompte,
    dateCreation,
    nom,
    prenom,
    adresse,
    cp,
    ville,
    pays,
    mail,
    dateNaissance,
    villeNaissance,
    paysNaissance
    telephone,
    idTypeClient,
    nomSociete,
    siret,
    codeApe,
    numeroTVA,
    nomAssociation,
    dateDeclaration,
    datePublication,
    numeroAnnonce
	FROM Client
	LEFT JOIN Particulier ON Client.id = Particulier.id
    LEFT JOIN Professionnel ON Client.id = Professionnel.id
    LEFT JOIN Association ON Client.id = Association.id
    LEFT JOIN Formules_clients ON Formules_clients.idClient = Client.id
    Where Formules_clients.idService = idService AND Formules_clients.supprime = 0;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getEvolutionAssociationByYear`(IN `year` INT)
BEGIN
	SELECT COUNT(Client.id) as nombre, MONTH(Client.dateCreation) as month FROM Client where Client.idTypeClient = 3 AND YEAR(Client.dateCreation) = year GROUP BY MONTH(Client.dateCreation); 
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getEvolutionParticulierByYear`(IN `year` INT(10))
    NO SQL
BEGIN
	SELECT COUNT(Client.id) as nombre, MONTH(Client.dateCreation) as month FROM Client where Client.idTypeClient = 1 AND YEAR(Client.dateCreation) = year GROUP BY MONTH(Client.dateCreation); 
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getEvolutionProfessionnelByYear`(IN `year` INT)
BEGIN
	SELECT COUNT(Client.id) as nombre, MONTH(Client.dateCreation) as month FROM Client where Client.idTypeClient = 2 AND YEAR(Client.dateCreation) = year GROUP BY MONTH(Client.dateCreation); 
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getFormuleByIdFormule`(IN `idFormule` INT(10))
BEGIN
	Select * FROM Formules_clients WHERE Formules_clients.idFormule = idFormule;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getFormulesByIdClient`(IN `id` INT)
BEGIN
    SELECT * 
    FROM Formules_clients
    where Formules_clients.idClient = id AND Formules_clients.supprime = 0;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getFormulesByIdService`(IN `idService` INT)
BEGIN
    SELECT * 
    FROM Formules_clients
    where Formules_clients.idService = idService AND Formules_clients.supprime = 0;  
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getMailByIdClient`(IN `id` INT)
SELECT * FROM Mail
WHERE Mail.idClient = id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getNombreClientParService`()
BEGIN
    SELECT 
    Service.idService, Service.nomService, COUNT(T1.idService) AS nbClient 
    FROM 
    (
        SELECT 
        * 
        FROM Formules_clients 
        where 
        Formules_clients.dateSouscription <= date(NOW()) 
        AND 
        Formules_clients.dateFinService >= date(NOW())
        AND 
        Formules_clients.supprime = 0
    ) T1
    
    RIGHT JOIN Service ON T1.idService = Service.idService
    
    GROUP BY Service.idService;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getNombreClients`()
    NO SQL
SELECT COUNT(*) as nombre, TypeClient.nomTypeClient
FROM Client 
INNER JOIN TypeClient ON TypeClient.idTypeClient = Client.idTypeClient 
GROUP BY Client.idTypeClient$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getNombreFormuleEnService`()
BEGIN
    Select 
    COUNT(*) 
    from Formules_clients 
    WHERE Formules_clients.dateFinService >= DATE(NOW()) 
    AND 
    Formules_clients.dateSouscription <= DATE(NOW())
    AND
    Formules_clients.supprime = 0;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getParticulierById`(IN `id` INT)
    NO SQL
SELECT id,
nomCompte,
dateCreation,
nom,
prenom,
adresse,
cp,
ville,
pays,
mail,
telephone,
dateNaissance,
villeNaissance,
paysNaissance
FROM Client
JOIN Particulier ON Particulier.id = Client.id
WHERE Client.id = id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getProfessionnelById`(IN `id` INT)
    NO SQL
SELECT Client.id,
nomCompte,
dateCreation,
nom,
prenom,
adresse,
cp,
ville,
pays,
mail,
telephone,
nomSociete,
siret,
codeApe,
numeroTVA
FROM Client
JOIN Professionnel ON Professionnel.id = Client.id
WHERE Client.id = id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getServiceById`(IN `id` INT)
    NO SQL
Select * FROM Service
WHERE Service.idService = id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getTypesFacturation`()
    NO SQL
Select * FROM TypeFacturation$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `getUserByLogin`(IN `login` VARCHAR(255))
    NO SQL
SELECT * FROM Membres 
WHERE Membres.pseudo = login$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `modifyFormule`(IN `idFormule` INT, IN `idClient` INT, IN `idService` INT, IN `dateSouscription` DATE, IN `dateFinService` DATE, IN `typeFacturation` INT, IN `prix` FLOAT(7,2))
BEGIN
    
    UPDATE Formules_clients SET
    Formules_clients.idClient = idClient,
    Formules_clients.idService = idService,
    Formules_clients.dateSouscription = dateSouscription,
    Formules_clients.dateFinService = dateFinService,
    Formules_clients.typeFacturation = typeFacturation,
    Formules_clients.prix = prix
    WHERE
    Formules_clients.idFormule = idFormule;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `modifyHistorique`(IN `idFormule` INT(10), IN `idClient` INT(10), IN `idService` INT(10), IN `dateSouscription` DATE, IN `dateFinService` DATE, IN `typeFacturation` INT(10), IN `prix` FLOAT(7,2), IN `supprime` INT(1))
UPDATE Formules_clients SET
Formules_clients.idClient = idClient,
Formules_clients.idService = idService,
Formules_clients.dateSouscription = dateSouscription,
Formules_clients.dateFinService = dateFinService,
Formules_clients.typeFacturation = TypeFacturation,
Formules_clients.prix = prix,
Formules_clients.supprime = supprime
WHERE
Formules_clients.idFormule = idFormule$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `modifyMembre`(IN `id` INT(10), IN `password` VARCHAR(100), IN `login` VARCHAR(60), IN `email` VARCHAR(60), IN `dateInscription` DATE, IN `idGroupe` INT(10), IN `idClient` INT(10))
UPDATE Membres 
SET
Membres.login = login,
Membres.password = password,
Membres.email = email
WHERE
Membres.id = id$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `updateAssociation`(IN `id` INT(10), IN `nomCompte` VARCHAR(45), IN `dateCreation` DATE, IN `nom` VARCHAR(45), IN `prenom` VARCHAR(45), IN `adresse` VARCHAR(100), IN `cp` VARCHAR(5), IN `ville` VARCHAR(45), IN `pays` VARCHAR(45), IN `mail` VARCHAR(100), IN `telephone` VARCHAR(10), IN `nomAssociation` VARCHAR(45), IN `dateDeclaration` DATE, IN `datePublication` DATE, IN `numeroAnnonce` VARCHAR(10))
BEGIN
	UPDATE Client SET
    Client.nomCompte = nomCompte,
    Client.dateCreation = dateCreation,
    Client.nom = nom,
    Client.prenom = prenom,
    Client.adresse = adresse,
    Client.cp = cp,
    Client.ville = ville,
    Client.pays = pays,
    Client.mail = mail,
    Client.telephone = telephone
    WHERE
    Client.id = id;
    
    UPDATE Association SET
    Association.nomAssociation = nomAssociation,
    Association.dateDeclaration = dateDeclaration,
    Association.datePublication = datePublication,
    Association.numeroAnnonce = numeroAnnonce
    WHERE
    Association.id = id;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `updateDefaultMail`(IN `sujet` VARCHAR(255), IN `body` TEXT)
UPDATE Mail
SET Mail.sujet = sujet, Mail.body = body
WHERE Mail.idMail = 1$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `updateFormule`(IN `idFormule` INT(10), IN `idClient` INT(10), IN `idService` INT(10), IN `dateSouscription` DATE, IN `dateFinService` DATE, IN `typeFacturation` INT(10), IN `prix` FLOAT(7,2))
BEGIN
    IF(idFormule = 0) THEN
    	CALL addFormuleClient(idFormule, idClient,idService,dateSouscription,dateFinService, typeFacturation,prix);
    ELSE
    
    UPDATE Formules_clients SET
    Formules_clients.idClient = idClient,
    Formules_clients.idService = idService,
    Formules_clients.dateSouscription = dateSouscription,
    Formules_clients.dateFinService = dateFinService,
    Formules_clients.prix = prix,
    Formules_clients.typeFacturation = typeFacturation
    WHERE
    Formules_clients.idFormule = idFormule;
    
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `updateMail`(IN `idClient` INT(10), IN `sujet` VARCHAR(200), IN `body` TEXT)
BEGIN
DECLARE temp INT(10);
SELECT * FROM Mail WHERE Mail.idClient = idClient;
SELECT FOUND_ROWS() INTO temp;
SELECT temp;
IF (temp > 0) THEN
    UPDATE Mail
    SET 
    Mail.sujet = sujet,
    Mail.body = body
    WHERE Mail.idClient = idClient;
ELSE
	CALL addMail(idClient, sujet, body);
END IF;
   
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `updateMembre`(IN `id` INT, IN `login` VARCHAR(255), IN `password` VARCHAR(255), IN `email` VARCHAR(255), IN `dateInscription` DATE, IN `idGroupe` INT)
UPDATE Membres 
SET Membres.password = password
WHERE Membres.pseudo = login$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `updateParticulier`(IN `id` INT(10), IN `nomCompte` VARCHAR(45), IN `dateCreation` DATE, IN `nom` VARCHAR(45), IN `prenom` VARCHAR(45), IN `adresse` VARCHAR(100), IN `cp` VARCHAR(5), IN `ville` VARCHAR(45), IN `pays` VARCHAR(45), IN `mail` VARCHAR(100), IN `telephone` VARCHAR(10), IN `dateNaissance` DATE, IN `villeNaissance` VARCHAR(45), IN `paysNaissance` VARCHAR(45))
BEGIN
	UPDATE Client SET
    Client.nomCompte = nomCompte,
    Client.dateCreation = dateCreation,
    Client.nom = nom,
    Client.prenom = prenom,
    Client.adresse = adresse,
    Client.cp = cp,
    Client.ville = ville,
    Client.pays = pays,
    Client.mail = mail,
    Client.telephone = telephone
    WHERE
    Client.id = id;
    
    UPDATE Particulier SET
    Particulier.dateNaissance = dateNaissance,
    Particulier.villeNaissance = villeNaissance,
    Particulier.paysNaissance = paysNaissance
    WHERE
    Particulier.id = id;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `updateProfessionnel`(IN `id` INT(10), IN `nomCompte` VARCHAR(45), IN `dateCreation` DATE, IN `nom` VARCHAR(45), IN `prenom` VARCHAR(45), IN `adresse` VARCHAR(100), IN `cp` VARCHAR(5), IN `ville` VARCHAR(45), IN `pays` VARCHAR(45), IN `mail` VARCHAR(100), IN `telephone` VARCHAR(10), IN `nomSociete` VARCHAR(45), IN `siret` VARCHAR(14), IN `codeApe` VARCHAR(5), IN `numeroTVA` VARCHAR(13))
BEGIN
	UPDATE Client SET
    Client.nomCompte = nomCompte,
    Client.dateCreation = dateCreation,
    Client.nom = nom,
    Client.prenom = prenom,
    Client.adresse = adresse,
    Client.cp = cp,
    Client.ville = ville,
    Client.pays = pays,
    Client.mail = mail,
    Client.telephone = telephone
    WHERE
    Client.id = id;
    
    UPDATE Professionnel SET
    Professionnel.nomSociete = nomSociete,
    Professionnel.siret = siret,
    Professionnel.codeApe = codeApe,
    Professionnel.numeroTVA = numeroTVA
    WHERE
    Professionnel.id = id;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `updateService`(IN `idService` INT(10), IN `nomService` VARCHAR(45), IN `description` TEXT, IN `origine` VARCHAR(45), IN `tauxTVA` DECIMAL(4,2), IN `prixHTA` DECIMAL(7,2), IN `prixHTS` DECIMAL(7,2), IN `prixHTT` DECIMAL(7,2), IN `prixHTM` DECIMAL(7,2))
BEGIN
	UPDATE Service SET
    Service.nomService = nomService,
    Service.description = description,
    Service.origine = origine,
    Service.tauxTVA = tauxTVA,
    Service.prixHTA = prixHTA,
    Service.prixHTS = prixHTS,
    Service.prixHTT = prixHTT,
    Service.prixHTM = prixHTM
    WHERE
    Service.idService = idService;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`stage2021`@`localhost` PROCEDURE `userAndPass`(IN `login` VARCHAR(255), IN `pass` VARCHAR(255))
BEGIN
    SELECT * 
    FROM Membres
    where Membres.pseudo = login AND Membres.password = pass;  
END$$
DELIMITER ;
