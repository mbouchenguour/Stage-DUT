<?php
require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/manageclass/clientManager.class.php");

header('Access-Control-Allow-Methods: GET, OPTIONS');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=clients.xls");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');


excelAPI();

/**
 * Permet de télécharger les données des clients dans un fichier excel
 * 
 * @api
 * @package API
 */
function excelAPI()
{
    $cm = new ClientManager();
    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            $allClient = $cm->getAllClientsForExcel();
            echo $allClient;
            break;

        case 'OPTIONS':
            header("HTTP/1.1 200 OK");
            break;

        default:
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
}
