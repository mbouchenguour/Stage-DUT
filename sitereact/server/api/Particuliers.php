<?php


    require_once("../manageclass/clientManager.class.php");
    require_once("../tools/toolsDAO.class.php");
    require_once("../class/particulier.class.php");

    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json');
    particuliersAPI();
    
    /**
     * Permet de récupérer et modifier les particuliers
     * 
     * @api
     * @package API
     */
    function particuliersAPI() {
        $cm = new ClientManager();
        $request_method = $_SERVER["REQUEST_METHOD"];
        switch($request_method)
        {
            case 'GET':
                $particulier = array();
                $particuliers = $cm->getAllParticuliers();
                foreach($particuliers as $value)
                    array_push($particulier, $value->toArrayJSON());
                echo json_encode($particulier, JSON_PRETTY_PRINT);
                break;

            
            case 'POST':
                $particulier = new Particulier();
                if(!empty($_GET))
                    $particulier->hydrate($_GET);
                else{
                    $_POST = json_decode(file_get_contents("php://input"),true);
                    $particulier->hydrate($_POST['data']);
                }
                $cm->addParticulier($particulier);
                echo json_encode("Particulier ajouté", JSON_PRETTY_PRINT);
                break;


            case 'OPTIONS':
                header("HTTP/1.1 200 OK");
                break;

            default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }
    }    
?> 