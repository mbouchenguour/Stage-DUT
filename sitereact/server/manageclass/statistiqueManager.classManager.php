<?php

require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/tools/toolsDAO.class.php");

/**
 * Permet de communiquer avec la bdd pour effectuer des actions sur les statistiques
 */
class StatistiqueManager
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
     * Permet de récupérer le nombre de clients
     */
    public function getNombreClients()
    {
        $res = $this->tDAO->query("CALL getNombreClients()", array());
        return $res;
    }

    /**
     * Permet de récupérer le nombre de client par service
     */
    public function getNombreClientParService()
    {
        $res = $this->tDAO->query("CALL getNombreClientParService()", array());
        return $res;
    }

    /**
     * Permet de récuperer le nombre de formule par service
     */
    public function getNombreFormuleEnService()
    {
        $res = $this->tDAO->query("CALL getNombreFormuleEnService()", array());
        return $res;
    }

    /**
     * Nombre de nouveau particulier pour une année précis
     * @param $annee Annee voulu
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
}
