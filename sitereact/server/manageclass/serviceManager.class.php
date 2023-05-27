<?php

require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/tools/toolsDAO.class.php");
require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/service.class.php");
/**
 * Permet de communiquer avec la bdd pour effectuer des actions sur les services
 */
class ServiceManager
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
     * Retourne un service à partir d'un numéro de service 
     * @return $service l'instance du service
     */
    public function getServiceById($idService)
    {
        $service = new Service();
        $temp = $this->tDAO->query("CALL getServiceById(?);", array($idService));
        if (!empty($temp)) {
            $data = $temp[0];
            $service->hydrate($data);
        }

        return $service;
    }

    /**
     * Retourne tous les services de la base de données
     * @return $particuliers Array d'instance de Particuliers
     */
    public function getAllServices()
    {
        $services = array();
        $req = $this->tDAO->query("CALL getAllServices();", array());
        foreach ($req as $data) {
            $tempService = new Service();
            $tempService->hydrate($data);
            array_push($services, $tempService);
        }
        return $services;
    }

    /**
     * Ajoute un Services à la base de données
     * @param $service Instance de Service à ajouter
     */
    public function addService(Service $service)
    {
        $req = $this->tDAO->call("CALL addService(?,?,?,?,?,?,?,?,?)", $service->toArray());
    }

    /**
     * Modifie un Service de la base de données
     * @param $service Instance de Service à modifier
     */
    public function updateService(Service $service)
    {
        $req = $this->tDAO->call("CALL updateService(?,?,?,?,?,?,?,?,?)", $service->toArray());
    }

    /**
     * Supprime un Service de la base de données
     * @param $service id du Service à supprimer
     */
    public function deleteService($idService)
    {
        $req = $this->tDAO->call("CALL deleteService(?)", array($idService));
    }
}
