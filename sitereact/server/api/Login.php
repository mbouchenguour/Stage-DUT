<?php

include_once '../php-jwt-master/src/BeforeValidException.php';
include_once '../php-jwt-master/src/ExpiredException.php';
include_once '../php-jwt-master/src/SignatureInvalidException.php';
include_once '../php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;


require_once("../manageclass/loginManager.class.php");
require_once("../tools/toolsDAO.class.php");
require_once("../class/user.class.php");

header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

loginAPI();

/**
 * Permet de gérer les tokens pour l'utilisation du site (connection)
 * 
 * @api
 * @package API
 */
function loginAPI()
{
    $lm = new LoginManager();
    $request_method = $_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            $key = "z1kclpj7xpdgh0d25e13stjw43bw8862k023537sm5o80m82i56mn45j5xdz1";
            if (isset($_GET['login']) && isset($_GET['password'])) {
                $login = $_GET['login'];
                $password = $_GET['password'];
                $user = $lm->getUser($login);
                if ($user instanceof User) {
                    if (password_verify($password, $user->password())) {
                        $payload = array(
                            "id" => $user->id(),
                            "pseudo" => $user->pseudo(),
                            "idGroupe" => $user->idGroupe(),
                            "email" => $user->email(),
                            "idClient" => $user->idClient(),
                            "iat" => time(),
                            "exp" => time() + 3600
                        );
                        $jwt = JWT::encode($payload, $key);
                        $array = array();
                        $array["token"] = $jwt;
                        $array['idMembre'] = $user->id();
                        $array["idClient"] = $user->idClient();
                        $array["pseudo"] = $user->pseudo();
                        $array["email"] = $user->email();
                        $array["idGroupe"] = $user->idGroupe();
                        echo json_encode($array, JSON_PRETTY_PRINT);
                    } else {
                        echo json_encode("Mot de passe incorrect", JSON_PRETTY_PRINT);
                    };
                } else
                    echo json_encode("Utilisateur inconnue", JSON_PRETTY_PRINT);
            } else
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                try {
                    $decoded = JWT::decode($token, $key, array('HS256'));
                    echo json_encode($decoded, JSON_PRETTY_PRINT);
                } catch (Exception $e) {
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
