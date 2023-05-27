<?php


require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/tools/toolsDAO.class.php");
require_once("/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/user.class.php");

/**
 * Permet de communiquer avec la bdd pour effectuer des actions sur les utilisateurs
 */
class LoginManager
{
    private $tDAO;

    /**
     * Constructeur
     * @param $db Instance PDO de la connexion vers la bdd
     */
    public function __construct()
    {
        $this->tDAO = new ToolsDAO();
    }

    /**
     * Permet de vérifier si le login et le password sont correctes 
     * @param $login login de l'utilisateur
     * @param $password mot de passe hashé
     */
    public function connectLogin($login, $password)
    {
        $req = $this->tDAO->query("CALL userAndPass(?, ?);", array($login, $password));
        $user = 0;
        if (!empty($req)) {
            $user = new User();
            $data = $req[0];
            $user->hydrate($data);
        }
        return $user;
    }

    /**
     * Récupére les informations d'un user à partir d'un login
     * @param $login login de l'utilisateur
     */
    public function getUser($login)
    {
        $req = $this->tDAO->query("CALL getUserByLogin(?);", array($login));
        $user = 0;
        if (!empty($req)) {
            $user = new User();
            $data = $req[0];
            $user->hydrate($data);
        }
        return $user;
    }

    /**
     * Permet de modifer un utlisateur dans la bdd
     * @param User $user Instance de User à modifier
     */
    public function modifyMembre($user)
    {
        $req = $this->tDAO->call("CALL modifyMembre(?,?,?,?,?,?)", $user->toArray());
    }

    /**
     * Permet d'ajouter un utilisateur dans la bdd
     * @param User Instance de user à ajouter
     */
    public function addMembre($user)
    {
        $user->setPassword(password_hash($user->password(), PASSWORD_DEFAULT));
        $req = $this->tDAO->call("CALL addMembre(?,?,?,?,?,?)", array_slice($user->toArray(), 1, 6));
    }

    /**
     * Génére aléatoirement un login pour la création d'un compte
     * @return String login aléatoire
     */
    public function randomLogin()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $login = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $alphaLength);
            $login[] = $alphabet[$n];
        }
        return implode($login);
    }

    /**
     * Génére aléatoirement un password pour la création d'un compte
     * @return String mot de passe aléatoire
     */
    public function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%&*()_{}[]';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    /**
     * Récupère un mot de passe dans la bdd à partir de l'id d'un membre
     * @param $idMembre Id du membre que l'on souhaite récupérer
     */
    public function getPasswordById($idMembre)
    {
        $req = $this->tDAO->query("CALL getPasswordById(?);", array($idMembre));
        $password = "";
        if (!empty($req)) {
            $password = $req[0][0];
        }
        return $password;
    }

    /**
     * Modifie le mot de passe d'un utilisateur
     * @param $idMembre id du Membre
     * @param $password nouveau mot de passe hashé
     */
    public function updateMembrePassword($idMembre, $password)
    {
        $req = $this->tDAO->call("CALL updateMembrePassword(?,?)", array($idMembre, $password));
    }

    /**
     * Renvoie true si le client possède un compte
     * @param $idMembre id du Membre
     * @return $bool le booléen (true si le client possède un compte, sinon false)
     */
    public function hasAccount($idMembre)
    {
        $bool = false;
        $req = $this->tDAO->query("CALL hasAccount(?);", array($idMembre));
        if (!empty($req)) {
            $bool = true;
        }
        return $bool;
    }

    /**
     * Modifie le login d'un utilisateur
     * @param $idMembre id de l'utilisateur
     * @param $login nouveau login
     */
    public function updateMembreLogin($idMembre, $login)
    {
        $req = $this->tDAO->call("CALL updateMembreLogin(?, ?);", array($idMembre, $login));
    }
}
