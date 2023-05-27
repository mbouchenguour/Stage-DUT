<?php


require_once("../manageclass/formuleManager.class.php");
require_once("../class/formule.class.php");

header('Access-Control-Allow-Methods: GET, PUT, ,DELETE, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');
formulesAPI();

/**
 * Permet de récupérer, ajouter, modifier et supprimer une formule.
 * 
 * @api
 * @package API
 */
function formulesAPI()
{

    $fm = new FormuleManager();

    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if (isset($_GET['idFormule'])) {

                $idFormule = $_GET['idFormule'];
                $res = $fm->getFormuleByIdFormule($idFormule)->toArrayJSON();
            } else if (isset($_GET['idClient'])) {
                $idClient = $_GET['idClient'];
                $res = array();
                $formules = $fm->getFormulesByIdClient($idClient);
                foreach ($formules as $value)
                    array_push($res, $value->toArrayJSON());
            } else if (isset($_GET['typeFacturation'])) {
                $res = $fm->getTypesFacturation();
            } else if (isset($_GET['getFormulesEspaceClient'])) {
                $res = $fm->getFormulesEspaceClient($_GET['getFormulesEspaceClient']);
            } else {
                $res = array();
                $formules = $fm->getAllFormules();
                foreach ($formules as $value)
                    array_push($res, $value->toArrayJSON());
            }
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
            $fm->updateFormule($formule);
            echo json_encode("Formule modifier", JSON_PRETTY_PRINT);
            break;

        case 'POST':
            $formule = new Formule();
            if (!empty($_GET))
                $formule->hydrate($_GET);
            else {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $formule->hydrate($_POST['data']);
            }
            $formule->setIdFormule(0);
            $fm->addFormuleClient($formule);
            echo json_encode("Formule ajouté", JSON_PRETTY_PRINT);
            break;

        case 'DELETE':
            if (isset($_GET['idFormule'])) {
                $idFormule = $_GET['idFormule'];
                $fm->deleteFormule($idFormule);
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
