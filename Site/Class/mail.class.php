<?php
    
    include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/siteBase/ManageClass/clientManager.class.php');
    include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/siteBase/ManageClass/serviceManager.class.php');

    class Mail
    {

        private $client;
        private $formule;
        private $jour;
        private $sujet;
        private $body;

        public function __construct($form,$j)
        {
            $cm = new ClientManager();
            $this->formule = $form;
            $this->client = $cm->getClientById($form->idClient());
            $this->jour = $j;
            $this->setBody();
            $this->setSujet();
            $this->sendMail();
        }

        public function jour()
        {
            return $this->jour;
        }

        public function body(){
            return $this->body;
        }

        public function sujet(){
            return $this->sujet;
        }

        public function setBody()
        {
            $sm = new ServiceManager();
            $nom = $sm->getServiceById($this->formule->idService())->nomService();
            $this->body = "Notification, ".$this->client->nom()." il vous reste ".$this->jour." jours avant expiration de votre abonnement pour le service :".$nom." ! ";
        }

        public function setSujet()
        {
            $this->sujet = "Alerte date souscription : ".$this->jour." jours";
        }

        public function sendMail()
        {
            $adrMail = $this->client->mail();
            mail($adrMail,$this->sujet,$this->body);
        }


    }
?>