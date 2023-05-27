<?php
    class Formule
    {
        private $idFormule;
        private $idClient;
        private $idService;
        private $dateSouscription;
        private $dateFinService;
        private $typeFacturation;
        private $prix;
        private $supprime;

        /**
         * Getter/Setter
         */
        public function idFormule(){
            return $this->idFormule;
        }
        public function idClient(){
            return $this->idClient;
        }
        public function idService(){
            return $this->idService;
        }
        public function dateSouscription(){
            return $this->dateSouscription;
        }
        public function dateFinService(){
            return $this->dateFinService;
        }
        public function typeFacturation(){
            return $this->typeFacturation;
        }
        public function prix(){
            return $this->prix;
        }
        public function supprime(){
            return $this->supprime;
        }

        public function supprimeToString(){
            $s = "";
            if($this->supprime == 0)
                $s = "Non";          
            else
                $s = "Oui";    
            return $s;
        }

        public function setIdFormule($idFormule){
            $this->idFormule = $idFormule;
        }
        public function setIdClient($idClient){
            $this->idClient = $idClient;
        }
        public function setIdService($idService){
            $this->idService = $idService;
        }
        public function setDateSouscription($dateSouscription){
            $this->dateSouscription = $dateSouscription;
        }
        public function setDateFinService($dateFinService){
            $this->dateFinService = $dateFinService;
        }
        

        public function typeFacturationToString(){
            $string = "";
            switch($this->typeFacturation){
                case 1: 
                    $string = "Annuelle";
                    break;
                case 2:
                    $string = "Semestrielle";
                    break;
                case 3:
                    $string = "Trimestrielle";
                    break;
                case 4:
                    $string = "Mensuelle";
                    break;
            }
            return $string;
        }

        public function setTypeFacturation($typeFacturation){
            $this->typeFacturation = $typeFacturation;
        }


        public function setTypeFacturationRenouvellement($formuleTemp){
            echo "lol";
            echo $formuleTemp->typeFacturation();
            echo $this->typeFacturation;
            if($formuleTemp->typeFacturation() != $this->typeFacturation){
                $this->idFormule = 0;
                $this->dateSouscription = $formuleTemp->dateFinService();
            }
        }

        public function setPrix($prix){
            $this->prix = $prix;
        }

        public function setSupprime($supprime){
            $this->supprime = $supprime;
        }

        /**
         * Permet l'initialisation
         * @param $donnees Array des données de la Formule
         */
        public function hydrate(array $donnees)
        {
            foreach ($donnees as $key => $value)
            {
                $method = 'set'.ucfirst($key);

                if(method_exists($this,$method))
                {
                    $this->$method($value);
                }
            }
        }  
        
        /**
         * Renvoie l'instance sous forme d'un tableau
         * @return $array l'array avec les informartions de la formule
         */
        public function toArray(){
            $array = array();
            foreach($this as $key => $value) {
                array_push($array, $value);
            }
            $array = array_slice($array, 0, 7); 
            return $array;
        }

        public function toArrayHistorique(){
            $array = array();
            foreach($this as $key => $value) {
                array_push($array, $value);
            }
            return $array;
        }
    }
?>

