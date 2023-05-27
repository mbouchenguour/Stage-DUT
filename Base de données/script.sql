CREATE SCHEMA IF NOT EXISTS stage2021_stage;
USE stage2021_stage;

DROP TABLE IF EXISTS Mail;
DROP TABLE IF EXISTS Membres;
DROP TABLE IF EXISTS Groupe;
DROP TABLE IF EXISTS Association;
DROP TABLE IF EXISTS Professionnel;
DROP TABLE IF EXISTS Particulier;
DROP TABLE IF EXISTS Historique;
DROP TABLE IF EXISTS Formules_clients;
DROP TABLE IF EXISTS Service;
DROP TABLE IF EXISTS Client;

DROP TABLE IF EXISTS TypeClient;
DROP TABLE IF EXISTS TypeFacturation;




CREATE TABLE IF NOT EXISTS Groupe(
  idGroupe int(11) PRIMARY KEY AUTO_INCREMENT,
  type varchar(255) 
);


CREATE TABLE IF NOT EXISTS TypeClient (
	idTypeClient INT(10) PRIMARY KEY AUTO_INCREMENT,
	nomTypeClient VARCHAR(45)
);


DROP TABLE IF EXISTS Client;
CREATE TABLE IF NOT EXISTS Client(
	id INT(10) PRIMARY KEY,
	nomCompte VARCHAR(45),
	dateCreation DATE,
	nom VARCHAR(45),
	prenom VARCHAR(45),
	adresse VARCHAR(100),
	cp VARCHAR(5),
	ville VARCHAR(45),
	pays VARCHAR(45),
	mail VARCHAR(60),
	telephone VARCHAR(10),
	idTypeClient INT(10),
	FOREIGN KEY (idTypeClient) REFERENCES TypeClient(idTypeClient) ON DELETE SET NULL ON UPDATE CASCADE
);

DROP TABLE IF EXISTS Particulier;
CREATE TABLE IF NOT EXISTS Particulier (
id INT(10) PRIMARY KEY,
dateNaissance DATE,
villeNaissance VARCHAR(45),
paysNaissance VARCHAR(45),
FOREIGN KEY (id) REFERENCES Client(id) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS Professionnel;
CREATE TABLE IF NOT EXISTS Professionnel (
id INT(10) PRIMARY KEY,
nomSociete VARCHAR(45),
siret VARCHAR(14),
codeApe VARCHAR(5),
numeroTVA VARCHAR(13),
FOREIGN KEY (id) REFERENCES Client(id) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS Association;
CREATE TABLE IF NOT EXISTS Association (
id INT(10) PRIMARY KEY,
nomAssociation VARCHAR(45),
dateDeclaration DATE,
datePublication DATE,
numeroAnnonce VARCHAR(10),
FOREIGN KEY (id) REFERENCES Client(id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS Membres (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  pseudo varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  dateInscription date NOT NULL,
  idGroupe int(11) NOT NULL,
  idClient int(11) DEFAULT NULL,
  FOREIGN KEY (idGroupe) REFERENCES Groupe(idGroupe),
  FOREIGN KEY (idClient) REFERENCES Client(id)
);

DROP TABLE IF EXISTS Service;
CREATE TABLE IF NOT EXISTS Service (
idService INT(10) PRIMARY KEY AUTO_INCREMENT,
nomService VARCHAR(45),
description TEXT,
origine VARCHAR(45),
tauxTVA FLOAT(4,2),
prixHTA FLOAT(7,2),
prixHTS FLOAT(7,2),
prixHTT FLOAT(7,2),
prixHTM FLOAT(7,2)
);

DROP TABLE IF EXISTS TypeFacturation;
CREATE TABLE IF NOT EXISTS TypeFacturation (
idType INT(10) PRIMARY KEY AUTO_INCREMENT,
type VARCHAR(45)
);

INSERT INTO TypeFacturation VALUES(1, "Annuelle");
INSERT INTO TypeFacturation VALUES(2, "Semestrielle");
INSERT INTO TypeFacturation VALUES(3, "Trimestrielle");
INSERT INTO TypeFacturation VALUES(4, "Mensuelle");

DROP TABLE IF EXISTS Formules_clients;
CREATE TABLE IF NOT EXISTS Formules_clients (
idFormule INT(10) PRIMARY KEY AUTO_INCREMENT,
idClient INT(10),
idService INT(10),
dateSouscription DATE,
dateFinService DATE,
typeFacturation INT(10),
prix FLOAT(7,2),
supprime INT(1) DEFAULT 0,
FOREIGN KEY (typeFacturation) REFERENCES TypeFacturation(idType)ON UPDATE CASCADE ON DELETE NO ACTION
);

DROP TABLE IF EXISTS Mail;
CREATE TABLE IF NOT EXISTS Mail  (
  idMail INT(10) PRIMARY KEY AUTO_INCREMENT,
  idClient INT(10),
  sujet VARCHAR(200),
  body TEXT,
  FOREIGN KEY (idClient) REFERENCES Client(id) ON UPDATE CASCADE ON DELETE NO ACTION
);



INSERT INTO `Groupe` (`type`) VALUES
('Admin'),
('Client');


INSERT INTO `TypeClient` (`nomTypeClient`) VALUES
('Particulier'),
('Professionnel'),
('Association');

INSERT INTO `Client` (`id`, `nomCompte`, `dateCreation`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `pays`, `mail`, `telephone`, `idTypeClient`) VALUES
(1, 'Hamadi', '2021-03-29', 'Daghar', 'Hamadi', '9 bis chemin du carimai', '06110', 'Le cannet', 'France', 'hamadi.daghar@gmail.com', '0750418145', 1),
(2, 'Mohamed', '2021-04-29', 'Bouchenguour', 'Mohamed', '451 rue de macon', '71000', 'Macon', 'France', 'mohamed@gmail.com', '0741215684', 1),
(3, 'Timothé', '2021-01-28', 'Hofmann', 'Timothé', '3 rue des ouches Jacob', '21230', 'Voudenay', 'France', 'timothe@alpeshosting.com', '0645129745', 1),
(4, 'ACF', '2021-04-29', 'Muriel', 'Robin', 'Rue 254, Quartier Hippodrome', '25620', 'Hambre', 'Espagne', 'fall@ml.dfspaing.org', '0012846034', 3),
(5, 'Apple', '2021-02-02', 'Steve', 'Jobs', '300 Post St', '94108', 'San Francisco', 'Etats-Unis', 'steve@joobs.job', '4514862895', 2),
(6, 'RDC', '2021-02-17', 'Colucci', 'Michel', '50 Boulevard Jean-Baptiste Vérany', '06300', 'Nice', 'France', 'coluche@coluche.fr', '0644122235', 3),
(7, 'Asso secours populaire', '2021-04-01', 'Marco', 'Filipo', '13 Rue Marco del Ponte', '06150', 'Cannes', 'France', 'secours.populaire@gmail.com', '0422103876', 3),
(8, 'Microsoft Corporation', '2021-01-29', 'Gates', 'Bill', 'One Microsoft Way', '98052', 'Washington', 'Etats-Unis', 'bill@gates.gat', '1214535945', 2);




INSERT INTO `Particulier` (`id`, `dateNaissance`, `villeNaissance`, `paysNaissance`) VALUES
(1, '1997-05-23', 'Cannes', 'France'),
(2, '2002-04-21', 'Macon', 'France'),
(3, '2002-09-08', 'Dijon', 'France');

INSERT INTO `Association` (`id`, `nomAssociation`, `dateDeclaration`, `datePublication`, `numeroAnnonce`) VALUES
(4, 'ACF', '2020-09-15', '2020-07-15', 'TGY8S'),
(6, 'RDC', '2012-06-23', '2003-12-08', '12453'),
(7, 'Asso secours populaire', '2012-06-23', '2003-12-08', '12453');



INSERT INTO `Professionnel` (`id`, `nomSociete`, `siret`, `codeApe`, `numeroTVA`) VALUES
(5, 'Apple', '45784562301849', '451PE', '14945'),
(8, 'Microsoft', '44889963625126', '4512F', '23645');

INSERT INTO `Service` (`idService`, `nomService`, `description`, `origine`, `tauxTVA`, `prixHTA`, `prixHTS`, `prixHTT`, `prixHTM`) VALUES
(1, 'Avast', 'Protège des virus', 'Espagne', 20.00, 2000.00, 1400.00, 1000.00, 700.00),
(2, 'OVH', 'Hébergeur site internet', 'France', 20.00, 1256.00, 841.00, 641.00, 300.00),
(3, 'Gestion de parc informatique', 'Entretien, développement et optimisation des ressources informatiques', 'France', 20.00, 800.00, 490.00, 320.00, 150.00);


INSERT INTO `Membres` (`id`, `pseudo`, `password`, `email`, `dateInscription`, `idGroupe`) VALUES
(1, 'hamadi', '$2y$10$O2tktcM88w52mOBuzRV37esMCQstHlO0ec.dR763Wss1Ir7Jq8.3m', 'hamadi@hamadi.hamadi', '2021-04-12', 1);

INSERT INTO `Mail` (`idMail`, `idClient`, `sujet`, `body`) VALUES
(1, NULL, 'Alerte : $jour jours avant fin du service $service', 'Mail automatique.\r\nBonjour $nom,\r\nvotre abonnement au service $service prend fin dans $jour jours.\r\nCordialement');

INSERT INTO `Formules_clients` (`idFormule`, `idClient`, `idService`, `dateSouscription`, `dateFinService`, `typeFacturation`, `prix`, `supprime`) VALUES
(6, 1, 1, '2021-04-29', '2022-04-29', 4, 410.00, 0),
(7, 1, 3, '2021-04-29', '2021-07-29', 3, 500.00, 0);