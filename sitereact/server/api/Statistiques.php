<?php



require_once("../manageclass/statistiqueManager.classManager.php");

header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');


statistiquesAPI();

/**
 * Permet de récupérer les statistiques
 * 
 * @api
 * @package API
 */
function statistiquesAPI()
{
    $sm = new StatistiqueManager();
    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if (isset($_GET['year'])) {
                $year = $_GET['year'];
                $res = array();
                array_push($res, $sm->getEvolutionParticulierByYear($year), $sm->getEvolutionProfessionnelByYear($year), $sm->getEvolutionAssociationByYear($year));
            } else if (isset($_GET['getNombreClients'])) {
                $res = $sm->getNombreClients();
            } else if (isset($_GET['getNombreFormuleEnService'])) {
                $res = $sm->getNombreFormuleEnService();
            } else if (isset($_GET['getNombreClientParService'])) {
                $res = $sm->getNombreClientParService();
            }
            echo json_encode($res, JSON_PRETTY_PRINT);
            break;

        case 'OPTIONS':
            header("HTTP/1.1 200 OK");
            break;

        default:
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
}
