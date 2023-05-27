<?php

include_once '../php-jwt-master/src/BeforeValidException.php';
include_once '../php-jwt-master/src/ExpiredException.php';
include_once '../php-jwt-master/src/SignatureInvalidException.php';
include_once '../php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;


require_once("../manageclass/loginManager.class.php");
require_once("../tools/toolsDAO.class.php");
require_once("../class/user.class.php");

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

usersAPI();

/**
 * Permet de récupérer, ajouter, modifier un utilisateur.
 * 
 * @api
 * @package API
 */
function usersAPI()
{
    $lm = new LoginManager();
    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if (isset($_GET['password']) && isset($_GET['idMembre'])) {
                $password = $lm->getPasswordById($_GET['idMembre']);
                if (password_verify($_GET['password'], $password)) {
                    echo json_encode(array("True"), JSON_PRETTY_PRINT);
                } else
                    echo json_encode(array("False"), JSON_PRETTY_PRINT);
            } else if (isset($_GET['hasAccount'])) {
                $res = $lm->hasAccount($_GET['hasAccount']);
                echo json_encode($res, JSON_PRETTY_PRINT);
            }
            break;

        case 'POST':
            if (isset($_GET['email']) && isset($_GET['idClient'])) {
                $user = new User();
                $user->setPseudo($lm->randomLogin());
                $user->setPassword($lm->randomPassword());
                $user->setEmail($_GET['email']);
                $user->setDateInscription(date("Y-m-d"));
                $user->setIdGroupe(2);
                $user->setIdClient($_GET['idClient']);
                echo json_encode($user->toArray(), JSON_PRETTY_PRINT);
                mail($user->email(), 'Compte AlpesHosting', 'Bonjour, les cooordonnées de votre compte sont : login : ' . $user->pseudo() . ' et password : ' . $user->password());
                $lm->addMembre($user);
            } else {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $_POST = $_POST['data'];
                if (isset($_POST['email']) && isset($_POST['idClient'])) {
                    $user = new User();
                    $user->setPseudo($lm->randomLogin());
                    $user->setPassword($lm->randomPassword());
                    $user->setEmail($_POST['email']);
                    $user->setDateInscription(date("Y-m-d"));
                    $user->setIdGroupe(2);
                    $user->setIdClient($_POST['idClient']);
                    mail($user->email(), 'Compte AlpesHosting', 'Bonjour, les cooordonnées de votre compte sont : login : ' . $user->pseudo() . ' et password : ' . $user->password());
                    $lm->addMembre($user);
                }
            }
            break;

        case 'PUT':
            if (!empty($_GET)) {
                if (isset($_GET['idMembre']) && isset($_GET['password'])) {
                    $lm->updateMembrePassword($_GET['idMembre'], password_hash($_GET['password'], PASSWORD_DEFAULT));
                }
            } else {
                $_POST = json_decode(file_get_contents("php://input"), true);
                $_POST = $_POST['data'];
                if (isset($_POST['password']) && isset($_POST['idMembre'])) {
                    $lm->updateMembrePassword($_POST['idMembre'], password_hash($_POST['password'], PASSWORD_DEFAULT));
                } else if (isset($_POST['login']) && isset($_POST['idMembre'])) {
                    $lm->updateMembreLogin($_POST['idMembre'], isset($_POST['login']));
                }
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
