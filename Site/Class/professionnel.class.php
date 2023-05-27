<?php
    class Professionnel
    {
        private $id;
        private $nomCompte;
        private $dateCreation;
        private $nom;
        private $prenom;
        private $adresse;
        private $cp;
        private $ville;
        private $pays;
        private $mail;
        private $telephone;
        private $nomSociete;
        private $siret;
        private $codeApe;
        private $numeroTVA;
        private $idTypeClient;

        /**
         * Getter/Setter
         */
        public function id(){
            return $this->id;
        }
        public function nomCompte(){
            return $this->nomCompte;
        }
        public function dateCreation(){
            return $this->dateCreation;
        }
        public function nom(){
            return $this->nom;
        }
        public function prenom(){
            return $this->prenom;
        }
        public function adresse(){
            return $this->adresse;
        }
        public function cp(){
            return $this->cp;
        }
        public function ville(){
            return $this->ville;
        }
        public function pays(){
            return $this->pays;
        }
        public function mail(){
            return $this->mail;
        }
        public function telephone(){
            return $this->telephone;
        }
        public function nomSociete(){
            return $this->nomSociete;
        }
        public function siret(){
            return $this->siret;
        }
        public function codeApe(){
            return $this->codeApe;
        }
        public function numeroTVA(){
            return $this->numeroTVA;
        }
        public function idTypeClient(){
            return $this->idTypeClient;
        }

        public function idTypeClientToString(){
            return "Professionnel";
        }

        public function setId($id){
            $this->id = $id;
        }
        public function setNomCompte($nomCompte){
            $this->nomCompte = $nomCompte;
        }
        public function setDateCreation($dateCreation){
            $this->dateCreation = $dateCreation;
        }
        public function setNom($nom){
            $this->nom = $nom;
        }
        public function setPrenom($prenom){
            $this->prenom = $prenom;
        }
        public function setAdresse($adresse){
            $this->adresse = $adresse;
        }
        public function setCp($cp){
            $this->cp = $cp;
        }
        public function setVille($ville){
            $this->ville = $ville;
        }
        public function setPays($pays){
            $this->pays = $pays;
        }
        public function setMail($mail){
            $this->mail = $mail;
        }
        public function setTelephone($telephone){
            $this->telephone = $telephone;
        }
        public function setNomSociete($nomSociete){
            $this->nomSociete = $nomSociete;
        }
        public function setSiret($siret){
            $this->siret = $siret;
        }
        public function setCodeApe($codeApe){
            $this->codeApe = $codeApe;
        }
        public function setNumeroTVA($numeroTVA){
            $this->numeroTVA = $numeroTVA;
        }
        public function setIdTypeClient($idTypeClient){
            $this->idTypeClient = $idTypeClient;
        }

        /**
         * Permet l'initialisation
         * @param $donnees Array des données du professionnels
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
         * @return $array l'array avec les informartions du professionnel
         */
        public function toArray(){
            $array = array();
            foreach($this as $key => $value) {
                array_push($array, $value);
            }
            $array = array_slice($array, 0, 15);
            return $array;
        }
    }
?>
