<?php
    require_once('/home/stage2021/domains/stage.hofmann.fr/public_html/Site/Class/professionnel.class.php');
    require_once('/home/stage2021/domains/stage.hofmann.fr/public_html/Site/Class/association.class.php');
    require_once('/home/stage2021/domains/stage.hofmann.fr/public_html/Site/Class/particulier.class.php');
    require_once('/home/stage2021/domains/stage.hofmann.fr/public_html/Site/Class/service.class.php');
    require_once('/home/stage2021/domains/stage.hofmann.fr/public_html/Site/Class/formule.class.php');
    require_once('/home/stage2021/domains/stage.hofmann.fr/public_html/Site/Tools/toolsDAO.class.php');


    class FormuleManager
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
         * Retourne un formule à partir de son id 
         * @return $formule Instance de formule
         */
        public function getFormuleByIdFormule($idFormule)
        {
            $formule = new Formule();
            $req = $this->tDAO->query("CALL getFormuleByIdFormule(?);",array($idFormule));
            if(!empty($req)){
                $data = $req[0];
                $formule->hydrate($data);
            }
            return $formule;
        }


        /**
         * Retourne les formules à partir d'un numéro client 
         * @return $formules Array des formules
         */
        public function getFormulesByIdClient($idClient)
        {
            $formules = array();
            $req = $this->tDAO->query("CALL getFormulesByIdClient(?);",array($idClient));
            foreach ($req as $data) {
                $tempFrom = new Formule();
                $tempFrom->hydrate($data);
                array_push($formules, $tempFrom);
            }
            
            return $formules;
        }

        /**
         * Retourne les formules à partir de l'id d'un service 
         * @return $formules Array des formules
         */
        public function getFormulesByIdService($idService)
        {
            $formules = array();
            $req = $this->tDAO->query("CALL getFormulesByIdService(?);",array($idService));
            foreach ($req as $data) {
                $tempFrom = new Formule();
                $tempFrom->hydrate($data);
                array_push($formules, $tempFrom);
            }
            
            return $formules;
        }

        /**
         * Retourne les clients utilisant un service
         * @return $clients Array des clients utilisant un service
         * @param @idService id du service utilisé par les clients
         */
        public function getClientsByService($idService)
        {
            $clients = array();
            $req = $this->tDAO->query("CALL getClientsByService(?);",array($idService));
            foreach ($req as $data) {
                switch($data['idTypeClient']){
                    case 1:
                        $tempPart = new Particulier();
                        $tempPart->hydrate($data);
                        array_push($clients,$tempPart);
                        break;
                    case 2:
                        $tempPro = new Professionnel();
                        $tempPro->hydrate($data);
                        array_push($clients, $tempPro);
                        break;
                    case 3:
                        $tempAsso = new Association();
                        $tempAsso->hydrate($data);
                        array_push($clients, $tempAsso);
                        break;    
                };
            }
            
            return $clients;
        }


        /**
         * Retourne les types de facturation
         * @return $types Array avec les types de facturation
         */
        public function getTypesFacturation()
        {
            $req = $this->tDAO->query("CALL getTypesFacturation();",array());
            return $req;
        }

        

        /**
         * Ajoute une formule à la base de données
         * @param $formule Instance Formule à ajouter
         */
        public function addFormuleClient($formule)
        {
            $req = $this->tDAO->call("CALL addFormuleClient(?,?,?,?,?,?,?);", $formule->toArray());
        }

        /**
         * Supprimer une formule de la base de données
         * @param $idClient id du client 
         * @param $idService id du service 
         */
        public function deleteFormule($idFormule)
        {
            $req = $this->tDAO->call("CALL deleteFormule(?);", array($idFormule));
        }

        /**
         * Supprimer un historique de la base de données
         * @param $idFormule id du formule 
         */
        public function deleteHistorique($idFormule)
        {
            $req = $this->tDAO->call("CALL deleteHistorique(?);", array($idFormule));
        }

        /**
         * Retourne le nombre de formule toujours en service
         * @param $idClient id du client 
         * @param $idService id du service 
         */
        public function getNombreFormuleEnService()
        {
            $req = $this->tDAO->query("CALL getNombreFormuleEnService();", array());
            return $req;
        }

        /**
         * Renouvelle une formule
         * @param $formule Instance de Formule à renouveller
         */
        public function updateFormule($formule)
        {
            $req = $this->tDAO->call("CALL updateFormule(?,?,?,?,?,?,?);", $formule->toArray());
        }

        /**
         * Modifie une formule
         * @param $formule Instance de Formule à modifier
         */
        public function modifyFormule($formule)
        {
            $req = $this->tDAO->call("CALL modifyFormule(?,?,?,?,?,?,?);", $formule->toArray());
        }

        /**
         * Modifie une formule
         * @param $formule Instance de Formule à modifier
         */
        public function modifyHistorique($formule)
        {
            $req = $this->tDAO->call("CALL modifyHistorique(?,?,?,?,?,?,?,?);", $formule->toArrayHistorique());
        }

        /**
         * Récupere le nombre de clients par service
         */
        public function getNombreClientParService()
        {
            $req = $this->tDAO->query("CALL getNombreClientParService();", array());
            return $req;
        }

        /**
         * Récupere toutes les formules
         */
        public function getAllFormules()
        {
            $req = $this->tDAO->query("CALL getAllFormules();", array());
            return $req;
        }

         /**
         * Récupere toutes les formules
         */
        public function getAllHistorique()
        {
            $formules = array();
            $req = $this->tDAO->query("CALL getAllHistorique();", array());
            foreach ($req as $data) {
                $tempFrom = new Formule();
                $tempFrom->hydrate($data);
                array_push($formules, $tempFrom);
            }
            return $formules;
        }
    }
?>