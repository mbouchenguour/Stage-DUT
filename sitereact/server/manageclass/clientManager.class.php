<?php

require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/tools/toolsDAO.class.php");
require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/particulier.class.php");
require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/professionnel.class.php");
require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/association.class.php");

/**
 * Permet de communiquer avec la bdd pour effectuer des actions sur les clients
 */
class ClientManager
{
    private $tDAO;

    /**
     * Constructeur
     * @param $db Instance PDO de la connexion vers la bdd
     */
    public function __construct()
    {
        $this->tDAO = new ToolsDAO();
    }


    /**
     * Retourne un particulier à partir d'un numéro client 
     * @return $particulier l'instance du particulier
     */
    public function getParticulierById($id)
    {
        $particulier = new Particulier();
        $temp = $this->tDAO->query("CALL getParticulierById(?);", array($id));
        if (!empty($temp)) {
            $data = $temp[0];
            $particulier->hydrate($data);
        }

        return $particulier;
    }

    /**
     * Retourne un professionnel à partir d'un numéro client 
     * @return $professionel l'instance du professionel
     */
    public function getProfessionnelById($id)
    {
        $professionel = new Professionnel();
        $req = $this->tDAO->query("CALL getProfessionnelById(?);", array($id));
        if (!empty($req)) {
            $data = $req[0];
            $professionel->hydrate($data);
        }
        return $professionel;
    }

    /**
     * Retourne une association à partir d'un numéro client 
     * @return $association l'instance de l'association
     */
    public function getAssociationById($id)
    {
        $association = new Association();
        $req = $this->tDAO->query("CALL getAssociationById(?);", array($id));
        if (!empty($req)) {
            $data = $req[0];
            $association->hydrate($data);
        }
        return $association;
    }

    /**
     * Retourne tous les particuliers de la base de données
     * @return $particuliers Array d'instance de Particuliers
     */
    public function getAllParticuliers()
    {
        $particuliers = array();
        $req = $this->tDAO->query("CALL getAllParticuliers();", array());
        foreach ($req as $data) {
            $tempPart = new Particulier();
            $tempPart->hydrate($data);
            array_push($particuliers, $tempPart);
        }
        return $particuliers;
    }

    /**
     * Retourne tous les professionnels de la base de données
     * @return $professionnels Array d'instance de Professionnels
     */
    public function getAllProfessionnels()
    {
        $professionnels = array();
        $req = $this->tDAO->query("CALL getAllProfessionnels();", array());
        foreach ($req as $data) {
            $tempPro = new Professionnel();
            $tempPro->hydrate($data);
            array_push($professionnels, $tempPro);
        }
        return $professionnels;
    }

    /**
     * Retourne toutes les associations de la base de données
     * @return $associations Array d'instance de Associations
     */
    public function getAllAssociations()
    {
        $associations = array();
        $req = $this->tDAO->query("CALL getAllAssociations();", array());
        foreach ($req as $data) {
            $tempAsso = new Association();
            $tempAsso->hydrate($data);
            array_push($associations, $tempAsso);
        }
        return $associations;
    }


    /**
     * Retourne un array avec tous les clients
     * @return $clients Array avec tous les clients
     */
    public function getAllClients()
    {
        $clients = array();
        $req = $this->tDAO->query("CALL getAllClients();", array());
        foreach ($req as $data) {
            switch ($data['idTypeClient']) {
                case 1:
                    $tempPart = new Particulier();
                    $tempPart->hydrate($data);
                    array_push($clients, $tempPart);
                    break;
                case 2:
                    $tempPro = new Professionnel();
                    $tempPro->hydrate($data);
                    array_push($clients, $tempPro);
                    break;
                case 3:
                    $tempAsso = new Association();
                    $tempAsso->hydrate($data);
                    array_push($clients, $tempAsso);
                    break;
            };
        }

        return $clients;
    }

    /**
     * Retourne un array avec tous les clients pour le fichier excel
     * @return $clients Array avec tous les clients
     */
    public function getAllClientsForExcel()
    {
        $clients = array();
        $req = $this->tDAO->query("CALL getAllClients();", array());
        foreach ($req as $data) {
            switch ($data['idTypeClient']) {
                case 1:
                    $tempPart = new Particulier();
                    $tempPart->hydrate($data);
                    array_push($clients, $tempPart);
                    break;
                case 2:
                    $tempPro = new Professionnel();
                    $tempPro->hydrate($data);
                    array_push($clients, $tempPro);
                    break;
                case 3:
                    $tempAsso = new Association();
                    $tempAsso->hydrate($data);
                    array_push($clients, $tempAsso);
                    break;
            };
        }

        $table = "<table>\n";
        $table .= "<thead>\n";
        $table .= "     <tr>\n";
        $table .= "         <th>Nom</th>\n";
        $table .= "         <th>Prenom</th>\n";
        $table .= "         <th>Adresse</th>\n";
        $table .= "         <th>Code postal</th>\n";
        $table .= "         <th>Ville</th>\n";
        $table .= "         <th>Pays</th>\n";
        $table .= "     </tr>\n";
        $table .= "</thead>\n";
        foreach ($clients as $value) {
            $table .= "<tr>\n";
            $table .= "     <td>" . $value->nom() . "</td>\n";
            $table .= "     <td>" . $value->prenom() . "</td>\n";
            $table .= "     <td>" . $value->adresse() . "</td>\n";
            $table .= "     <td>" . $value->cp() . "</td>\n";
            $table .= "     <td>" . $value->ville() . "</td>\n";
            $table .= "     <td>" . $value->pays() . "</td>\n";
            $table .= "</tr>\n";
        }
        $table .= "</table>\n";
        return $table;
    }

    /**
     * Récupère un client à partir d'un id
     * @return $client l'instance du client (professionnel, particulier ou association)
     */
    public function getClientById($id)
    {
        $req = $this->tDAO->query("CALL getClientById(?);", array($id));
        foreach ($req as $data) {
            switch ($data['idTypeClient']) {
                case 1:
                    $tempPart = new Particulier();
                    $tempPart->hydrate($data);
                    $client = $tempPart;
                    break;
                case 2:
                    $tempPro = new Professionnel();
                    $tempPro->hydrate($data);
                    $client = $tempPro;
                    break;
                case 3:
                    $tempAsso = new Association();
                    $tempAsso->hydrate($data);
                    $client = $tempAsso;
                    break;
            };
        }
        return $client;
    }

    /**
     * Nombre de nouveau particulier pour une année précis
     * @param $annee Année voulu
     * @return $evolution array avec Evolution par mois des particuliers
     */
    public function getEvolutionParticulierByYear($annee)
    {
        $evolution = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $req = $this->tDAO->query("CALL getEvolutionParticulierByYear(?);", array($annee));
        foreach ($req as $key => $data) {
            $temp = array($data[1] - 1 => $data[0]);
            $evolution = array_replace($evolution, $temp);
        }
        return $evolution;
    }

    /**
     * Nombre de nouveau professionnel pour une année précis
     * @param $annee Annee voulu
     * @return $evolution array avec Evolution par mois des professionnels
     */
    public function getEvolutionProfessionnelByYear($annee)
    {
        $evolution = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $req = $this->tDAO->query("CALL getEvolutionProfessionnelByYear(?);", array($annee));
        foreach ($req as $key => $data) {
            $temp = array($data[1] - 1 => $data[0]);
            $evolution = array_replace($evolution, $temp);
        }
        return $evolution;
    }

    /**
     * Nombre de nouvelle association pour une année précis
     * @param $annee Annee voulu
     * @return $evolution array avec Evolution par mois des associations
     */
    public function getEvolutionAssociationByYear($annee)
    {
        $evolution = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $req = $this->tDAO->query("CALL getEvolutionAssociationByYear(?);", array($annee));
        foreach ($req as $key => $data) {
            $temp = array($data[1] - 1 => $data[0]);
            $evolution = array_replace($evolution, $temp);
        }
        return $evolution;
    }

    /**
     * Permet d'avoir le nombre de clients de chaque type (professionnel, particulier, association)
     * @return $clients nombre de clients pour chaque type
     */
    public function getNombreClients()
    {
        $clients = $this->tDAO->query("CALL getNombreClients();", array());
        return $clients;
    }

    /**
     * Ajoute un Particulier à la base de données
     * @param $particulier Instance de Particulier à ajouter
     */
    public function addParticulier(Particulier $particulier)
    {
        $req = $this->tDAO->call("CALL addParticulier(?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $particulier->toArray());
    }


    /**
     * Ajoute un Professionnel à la base de données
     * @param $professionnel Instance de Professionnel à ajouter
     */
    public function addProfessionnel(Professionnel $professionnel)
    {
        $req = $this->tDAO->call("CALL addProfessionnel(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $professionnel->toArray());
    }

    /**
     * Ajoute une Association à la base de données
     * @param $association Instance de Association à ajouter
     */
    public function addAssociation(Association $association)
    {
        $req = $this->tDAO->call("CALL addAssociation(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $association->toArray());
    }



    /**
     * Modifie un Particulier de la base de données
     * @param $particulier Instance de Particulier à modifier
     */
    public function updateParticulier(Particulier $particulier)
    {
        $req = $this->tDAO->call("CALL updateParticulier(?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $particulier->toArray());
    }


    /**
     * Modifie un Professionnel de la base de données
     * @param $professionnel Instance de Professionnel à modifier
     */
    public function updateProfessionnel(Professionnel $professionnel)
    {
        $req = $this->tDAO->call("CALL updateProfessionnel(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $professionnel->toArray());
    }

    /**
     * Modifie une Association de la base de données
     * @param $association Instance de Association à modifier
     */
    public function updateAssociation(Association $association)
    {
        $req = $this->tDAO->call("CALL updateAssociation(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $association->toArray());
    }


    /**
     * Supprime un Client de la base de données
     * @param $id id du Client à supprimer
     */
    public function deleteClient($id)
    {
        $req = $this->tDAO->call("CALL deleteClient(?)", array($id));
    }

    /**
     * Supprime les Clients de la base de données ayant l'année égal au param
     * @param $year année à supprimer
     */
    public function deleteAllClientByYear($year)
    {
        $req = $this->tDAO->call("CALL deleteAllClientByYear(?)", array($year));
    }
}
