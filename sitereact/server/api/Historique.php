<?php


require_once("../manageclass/formuleManager.class.php");
require_once("../class/formule.class.php");

header('Access-Control-Allow-Methods: GET, PUT, ,DELETE, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');
historiqueAPI();

/**
 * Permet de récupérer, modifier et supprimer les données de l'historique.
 * 
 * @api
 * @package API
 */
function historiqueAPI()
{

    $fm = new FormuleManager();

    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            $res = array();
            $historiques = $fm->getAllHistorique();
            foreach ($historiques as $value)
                array_push($res, $value->toArrayJSON());
            echo json_encode($res, JSON_PRETTY_PRINT);
            break;

        case 'PUT':
            $formule = new Formule();
            if (!empty($_GET))
                $formule->hydrate($_GET);
            else {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $formule->hydrate($_POST['data']);
            }
            $fm->modifyHistorique($formule);
            break;

        case 'DELETE':
            if (isset($_GET['idFormule'])) {
                $idFormule = $_GET['idFormule'];
                $fm->deleteHistorique($idFormule);
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
