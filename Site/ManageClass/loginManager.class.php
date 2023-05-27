<?php
    require_once('/home/stage2021/domains/stage.hofmann.fr/public_html/Site/Class/user.class.php');
    require_once('/home/stage2021/domains/stage.hofmann.fr/public_html/Site/Tools/toolsDAO.class.php');

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

        public function connectLogin($login, $password)
        {
            $req = $this->tDAO->query("CALL userAndPass(?, ?);", array($login, $password));
            $user = 0;
            if(!empty($req)){
                $user = new User();
                $data = $req[0];
                $user->hydrate($data);
            }
            return $user;
        }

        public function getUser($login)
        {
            $req = $this->tDAO->query("CALL getUserByLogin(?);", array($login));
            $user = 0;
            if(!empty($req)){
                $user = new User();
                $data = $req[0];
                $user->hydrate($data);
            }
            return $user;
        }

        public function updateMembre($user)
        {
            $req = $this->tDAO->call("CALL updateMembre(?,?,?,?,?,?)", $user->toArray());
        }
       

    }
?>