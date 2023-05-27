<?php


require_once("../manageclass/formuleManager.class.php");
require_once("../class/formule.class.php");

header('Access-Control-Allow-Methods: GET, PUT, ,DELETE, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');
modificationsAPI();

/**
 * Permet de récupérer, ajouter, modifier et supprimer une modification.
 * 
 * @api
 * @package API
 */
function modificationsAPI()
{

    $fm = new FormuleManager();

    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            $formules = $fm->getAllModification();
            echo json_encode($formules, JSON_PRETTY_PRINT);
            break;

        case 'PUT':
            $formule = new Formule();
            if (!empty($_GET))
                $formule->hydrate($_GET);
            else {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $formule->hydrate($_POST['data']);
            }
            $formule->setSupprime(0);
            $fm->updateFormule($formule);
            echo json_encode("Modification modifiée", JSON_PRETTY_PRINT);
            break;

        case 'POST':
            $formule = new Formule();
            if (!empty($_GET))
                $formule->hydrate($_GET);
            else {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $formule->hydrate($_POST['data']);
            }
            $fm->addModification($formule);
            echo json_encode("Modification ajouté", JSON_PRETTY_PRINT);
            break;

        case 'DELETE':
            if (isset($_GET['idFormule'])) {
                $idFormule = $_GET['idFormule'];
                $fm->deleteModification($idFormule);
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
