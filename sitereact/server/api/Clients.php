<?php
require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/manageclass/clientManager.class.php");

header('Access-Control-Allow-Methods: GET, DELETE, PUT, OPTIONS');
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');


clientsAPI();

/**
 * Permet de récupérer, modifié et supprimer un client.
 * 
 * @api
 * @package API
 */
function clientsAPI()
{
    $cm = new ClientManager();
    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $res = $cm->getClientById($id);
                if ($res != null)
                    $res = $res->toArrayJSON();
            } else {
                $res = array();
                $clients = $cm->getAllClients();
                foreach ($clients as $value)
                    array_push($res, $value->toArrayJSON());
            }
            echo json_encode($res, JSON_PRETTY_PRINT);

            break;

        case 'PUT':
            if (!empty($_GET)) {
                switch ($_GET['idTypeClient']) {
                    case 1:
                        $res = new Particulier();
                        $res->hydrate($_GET);
                        break;
                    case 2:
                        $res = new Professionnel();
                        $res->hydrate($_GET);
                        break;
                    case 3:
                        $res = new Association();
                        $res->hydrate($_GET);
                        break;
                }
            } else {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $_POST = $_POST['data'];
                switch ($_POST['idTypeClient']) {
                    case 1:
                        $res = new Particulier();
                        $res->hydrate($_POST);
                        $cm->updateParticulier($res);
                        break;
                    case 2:
                        $res = new Professionnel();
                        $res->hydrate($_POST);
                        $cm->updateProfessionnel($res);
                        break;
                    case 3:
                        $res = new Association();
                        $res->hydrate($_POST);
                        $cm->updateAssociation($res);
                }
            }
            echo json_encode("Client modifie", JSON_PRETTY_PRINT);
            break;

        case 'DELETE':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $cm->deleteClient($id);
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
