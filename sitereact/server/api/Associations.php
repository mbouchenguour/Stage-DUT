<?php
require_once("../manageclass/clientManager.class.php");
require_once("../class/association.class.php");

header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');
associationsAPI();

/**
 * Permet de récupérer et ajouter une association.
 * 
 * @api
 * @package API
 */
function associationsAPI()
{
    $cm = new ClientManager();
    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            $association = array();
            $associations = $cm->getAllAssociations();
            foreach ($associations as $value)
                array_push($association, $value->toArrayJSON());
            echo json_encode($association, JSON_PRETTY_PRINT);
            break;

        case 'POST':
            print_r($_GET);
            $association = new association();
            if (!empty($_GET))
                $association->hydrate($_GET);
            else {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $association->hydrate($_POST['data']);
            }
            $cm->addAssociation($association);
            echo json_encode("association ajouté", JSON_PRETTY_PRINT);
            break;

        case 'OPTIONS':
            header("HTTP/1.1 200 OK");
            break;

        default:
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
}
