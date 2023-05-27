<?php
require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/manageclass/mailManager.class.php");

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

mailsAPI();

/**
 * Permet de récupérer et modifier les mails
 * 
 * @api
 * @package API
 */
function mailsAPI()
{
    $mailManager = new MailManager();
    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if (isset($_GET['idClient']))
                $mail = $mailManager->getMailByIdClient($_GET['idClient']);
            else
                $mail = $mailManager->getByDefaultMail();
            echo json_encode($mail->toArrayForDefault(), JSON_PRETTY_PRINT);
            break;

        case 'PUT':
            $_POST = json_decode(file_get_contents("php://input"), true);
            $_POST = $_POST['data'];
            if (isset($_POST['sujet']) && isset($_POST['body'])) {
                $mailManager->updateDefaultMail($_POST['sujet'], $_POST['body']);
            }
            echo json_encode("Mail modifie", JSON_PRETTY_PRINT);
            break;

        case 'POST':
            $_POST = json_decode(file_get_contents("php://input"), true);
            $_POST = $_POST['data'];
            if (isset($_POST['idClient']) && isset($_POST['sujet']) && isset($_POST['body'])) {
                print_r($_POST);
                $mailManager->updateMail($_POST['idClient'], $_POST['sujet'], $_POST['body']);
            }
            break;

        case 'DELETE':
            if (isset($_GET['idClient'])) {
                $mailManager->deleteMailByIdClient($_GET['idClient']);
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
