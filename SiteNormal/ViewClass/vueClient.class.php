<?php 
    class VueClient
    {
        private $_clients = array();

        /**
         * Constructeur
         * @param $clients Liste des associations
         */
        public function __construct($clients)
        {
            function comparator($object1, $object2) {
                return $object1->id() > $object2->id();
            }
            usort($clients,'comparator');
            $this->_clients = $clients;     
        }

        /**
         * Permet l'affichage sous forme d'un tableau 
         */
        public function __toString()
        {
            $table = "<table>\n";
            $table .= " <thead>\n";
            $table .= "     <tr>\n";
            $table .= "         <th>Identifiant</th>\n";
            $table .= "         <th>Type de client</th>\n";
            $table .= "         <th>Nom du compte</th>\n";
            $table .= "         <th>Date de création</th>\n";
            $table .= "         <th>Nom</th>\n";
            $table .= "         <th>Prenom</th>\n";
            $table .= "         <th>Adresse</th>\n";
            $table .= "         <th>Code postal</th>\n";
            $table .= "         <th>Ville</th>\n";
            $table .= "         <th>Pays</th>\n";
            $table .= "         <th>E-mail</th>\n";
            $table .= "         <th>Téléphone</th>\n";
            $table .= "         <th></th>\n";
            $table .= "         <th></th>\n";
            $table .= "     </tr>\n";
            $table .= " </thead>\n";
            foreach($this->_clients as $value)
            {
                if($value instanceof Particulier)
                    $table .= " <tr class=\"particulier\">\n";
                if($value instanceof Professionnel)
                    $table .= " <tr class=\"professionnel\">\n";
                if($value instanceof Association)
                    $table .= " <tr class=\"association\">\n";
                $table .= "     <td>".$value->id()."</td>\n";
                $table .= "     <td>".$value->idTypeClientToString()."</td>\n";
                $table .= "     <td>".$value->nomCompte()."</td>\n";
                $table .= "     <td>".$value->dateCreation()."</td>\n";
                $table .= "     <td>".$value->nom()."</td>\n";
                $table .= "     <td>".$value->prenom()."</td>\n";
                $table .= "     <td>".$value->adresse()."</td>\n";
                $table .= "     <td>".$value->cp()."</td>\n";
                $table .= "     <td>".$value->ville()."</td>\n";
                $table .= "     <td>".$value->pays()."</td>\n";
                $table .= "     <td>".$value->mail()."</td>\n";
                $table .= "     <td>".$value->telephone()."</td>\n";
                $table .= "     <td><i class=\"far fa-user editButton\"></i></td>\n";
                $table .= "     <td><i class=\"far fa-edit editButton\"></i></td>\n";
                $table .= " </tr>\n";
            }
            $table .= "</table>\n";
            return $table; 
        }

    }
?>