<?php


    require_once("../manageclass/clientManager.class.php");
    require_once("../class/professionnel.class.php");

    header('Access-Control-Allow-Methods: GET, PUT, POST, OPTIONS');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json');

    professionnelsAPI();
    
    /**
     * Permet de récupérer et modifier les professionnels
     * 
     * @api
     * @package API
     */
    function professionnelsAPI() {
        $cm = new ClientManager();
        $request_method = $_SERVER["REQUEST_METHOD"];
        switch($request_method)
        {
            case 'GET':
                $professionnel = array();
                $professionnels = $cm->getAllProfessionnels();
                foreach($professionnels as $value)
                    array_push($professionnel, $value->toArrayJSON());
                echo json_encode($professionnel, JSON_PRETTY_PRINT);
                break;
            
            case 'POST':
                $professionnel = new professionnel();
                if(!empty($_GET))
                    $professionnel->hydrate($_GET);
                else{
                    $_POST = json_decode(file_get_contents("php://input"),true);
                    $professionnel->hydrate($_POST['data']);
                }
                $cm->addProfessionnel($professionnel);
                echo json_encode("Professionnel ajouté", JSON_PRETTY_PRINT);
                break;

            case 'OPTIONS':
                header("HTTP/1.1 200 OK");
                break;

            default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }
    }
