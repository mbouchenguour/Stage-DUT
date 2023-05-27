<?php

require_once("../manageclass/serviceManager.class.php");
require_once("../tools/toolsDAO.class.php");
require_once("../class/service.class.php");

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');
servicesAPI();

/**
 * Permet de récupérer, ajouter, modifier et supprimer un service.
 * 
 * @api
 * @package API
 */
function servicesAPI()
{
    $sm = new ServiceManager();
    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if (isset($_GET['idService'])) {
                $idService = $_GET['idService'];
                $service = $sm->getServiceById($idService)->toArrayJSON();
            } else {
                $service = array();
                $services = $sm->getAllServices();
                foreach ($services as $value)
                    array_push($service, $value->toArrayJSON());
            }
            echo json_encode($service, JSON_PRETTY_PRINT);
            break;

        case 'PUT':
            $service = new Service();
            if (!empty($_GET))
                $service->hydrate($_GET);
            else {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $service->hydrate($_POST['data']);
            }
            print_r($service);
            $sm->updateService($service);
            echo json_encode("Service modifier", JSON_PRETTY_PRINT);
            break;

        case 'POST':
            $service = new service();
            if (!empty($_GET))
                $service->hydrate($_GET);
            else {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $service->hydrate($_POST['data']);
            }
            $sm->addService($service);
            echo json_encode("service ajouté", JSON_PRETTY_PRINT);
            break;

        case 'DELETE':

            if (isset($_GET["idService"])) {
                $id = $_GET["idService"];
                $sm->deleteService($id);
                echo json_encode("service supprimé", JSON_PRETTY_PRINT);
            }
            break;

        case 'OPTIONS':
            header("HTTP/1.1 200 OK");
            break;

        default:
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
}
