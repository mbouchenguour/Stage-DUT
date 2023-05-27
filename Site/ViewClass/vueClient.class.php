<?php
    require_once('../ViewClass/vueFormule.class.php');      
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
            if(count(array($clients)) != 1){
                usort($clients,'comparator');
            }
            $this->_clients = $clients;
                
        }

        /**
         * Permet l'affichage sous forme d'un tableau 
         */
        public function __toString()
        {
            $table = "<table class=\"table\">\n";
            $table .= "<thead>\n";
            $table .= "     <tr>\n";
            $table .= "         <th>Identifiant</th>\n";
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
            $table .= "         <th>Type de client</th>\n";
            $table .= "         <th>Action</th>\n";
            $table .= "     </tr>\n";
            $table .= "</thead>\n";
            foreach($this->_clients as $value)
            {
                $table .= "<tr>\n";
                $table .= "     <td>".$value->id()."</td>\n";
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
                $table .= "     <td>".$value->idTypeClientToString()."</td>\n";
                $table .= "     <td><button name=\"button\" id=\"showMore\" onclick='showMore(".$value->id().")' value=".$value->id().">Show more</button></td>\n";
                if($value instanceof Particulier)
                {
                    $table .= "     <td><div class=\"btn-group\">\n";
                    $table .= "         <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\">\n";
                    $table .= "             <span class=\"caret\"></span>\n";
                    $table .= "             <span class=\"sr-only\">Toggle Dropdown</span>\n";
                    $table .= "         </button>";
                    $table .= "         <ul class=\"dropdown-menu\" role=\"menu\">\n";
                    $table .= "             <li><button name=\"button\" id=\"delete\" onclick='deleteClient(".$value->id().")' value=".$value->id().">Supprimer</button></li>\n";
                    $table .= "             <li><button name=\"button\" id=\"modify\" onclick='modifyParticulier(".$value->id().")' value=".$value->id().">Modifier</button></li>\n";                 
                    $table .= "         </ul>\n";
                    $table .= "      </div></td>\n";
                } 
                if($value instanceof Professionnel)
                {
                    $table .= "     <td><div class=\"btn-group\">\n";
                    $table .= "         <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\">\n";
                    $table .= "             <span class=\"caret\"></span>\n";
                    $table .= "             <span class=\"sr-only\">Toggle Dropdown</span>\n";
                    $table .= "         </button>";
                    $table .= "         <ul class=\"dropdown-menu\" role=\"menu\">\n";
                    $table .= "             <li><button name=\"button\" id=\"delete\" onclick='deleteClient(".$value->id().")' value=".$value->id().">Supprimer</button></li>\n";
                    $table .= "             <li><button name=\"button\" id=\"modify\" onclick='modifyProfessionnel(".$value->id().")' value=".$value->id().">Modifier</button></li>\n";                 
                    $table .= "         </ul>\n";
                    $table .= "      </div></td>\n";
                } 
                if($value instanceof Association)
                {
                    $table .= "     <td><div class=\"btn-group\">\n";
                    $table .= "         <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\">\n";
                    $table .= "             <span class=\"caret\"></span>\n";
                    $table .= "             <span class=\"sr-only\">Toggle Dropdown</span>\n";
                    $table .= "         </button>";
                    $table .= "         <ul class=\"dropdown-menu\" role=\"menu\">\n";
                    $table .= "             <li><button name=\"button\" id=\"delete\" onclick='deleteClient(".$value->id().")' value=".$value->id().">Supprimer</button></li>\n";
                    $table .= "             <li><button name=\"button\" id=\"modify\" onclick='modifyAssociation(".$value->id().")' value=".$value->id().">Modifier</button></li>\n";                 
                    $table .= "         </ul>\n";
                    $table .= "      </div></td>\n";
                }
                $table .= "</tr>\n";
            }
            $table .= "</table>\n";
            return $table; 
        }

        
        /**
         * Permet l'affichage sous forme d'un tableau pour excel
         */
        public function __toStringForExcel()
        {
            $table = "<table>\n";
            $table .= "<thead>\n";
            $table .= "     <tr>\n";
            $table .= "         <th>Nom</th>\n";
            $table .= "         <th>Prenom</th>\n";
            $table .= "         <th>Adresse</th>\n";
            $table .= "         <th>Code postal</th>\n";
            $table .= "         <th>Ville</th>\n";
            $table .= "         <th>Pays</th>\n";
            $table .= "     </tr>\n";
            $table .= "</thead>\n";
            foreach($this->_clients as $value)
            {
                $table .= "<tr>\n";
                $table .= "     <td>".$value->nom()."</td>\n";
                $table .= "     <td>".$value->prenom()."</td>\n";
                $table .= "     <td>".$value->adresse()."</td>\n";
                $table .= "     <td>".$value->cp()."</td>\n";
                $table .= "     <td>".$value->ville()."</td>\n";
                $table .= "     <td>".$value->pays()."</td>\n";
                $table .= "</tr>\n";
            }
            $table .= "</table>\n";
            return $table; 
        }

        /**
         * Permet l'affichage sous forme d'un tableau 
         */
        public function __toStringAll()
        {
            $table = "<table class=\"table\">\n";
            $table .= "<thead>\n";
            $table .= "     <tr>\n";
            $table .= "         <th>Identifiant</th>\n";
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
            foreach($this->_clients as $value)
            {
                if($value instanceof Particulier)
                {
                    $table .= "         <th>Date de naissance</th>\n";
                    $table .= "         <th>Ville de naissance</th>\n";
                    $table .= "         <th>Pays de naissance</th>\n";
                    $table .= "     </tr>\n";
                    $table .= "</thead>\n";
                }
                if($value instanceof Professionnel)
                {
                    $table .= "         <th>Nom de la société</th>\n";
                    $table .= "         <th>Siret</th>\n";
                    $table .= "         <th>Code APE</th>\n";
                    $table .= "         <th>Numéro TVA intracommunautaire</th>\n";
                    $table .= "     </tr>\n";
                    $table .= "</thead>\n";
                }
                if($value instanceof Association)
                {
                    $table .= "         <th>Nom de l'association</th>\n";
                    $table .= "         <th>Date de déclaration</th>\n";
                    $table .= "         <th>Date de publication au JO</th>\n";
                    $table .= "         <th>Numéro d'annonce</th>\n";
                    $table .= "     </tr>\n";
                    $table .= "</thead>\n";
                }

                $table .= "<tr>\n";
                $table .= "     <td>".$value->id()."</td>\n";
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
                if($value instanceof Particulier)
                {
                    $table .= "     <td>".$value->dateNaissance()."</td>\n";
                    $table .= "     <td>".$value->villeNaissance()."</td>\n";
                    $table .= "     <td>".$value->paysNaissance()."</td>\n";
                    $table .= "     <td><div class=\"btn-group\">\n";
                    $table .= "         <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\">\n";
                    $table .= "             <span class=\"caret\"></span>\n";
                    $table .= "             <span class=\"sr-only\">Toggle Dropdown</span>\n";
                    $table .= "         </button>";
                    $table .= "         <ul class=\"dropdown-menu\" role=\"menu\">\n";
                    $table .= "             <li><button name=\"button\" id=\"delete\" onclick='deleteClient(".$value->id().")' value=".$value->id().">Supprimer</button></li>\n";
                    $table .= "             <li><button name=\"button\" id=\"modify\" onclick='modifyParticulier(".$value->id().")' value=".$value->id().">Modifier</button></li>\n";                 
                    $table .= "         </ul>\n";
                    $table .= "      </div></td>\n";
                } 
                if($value instanceof Professionnel)
                {
                    $table .= "     <td>".$value->nomSociete()."</td>\n";
                    $table .= "     <td>".$value->siret()."</td>\n";
                    $table .= "     <td>".$value->codeApe()."</td>\n";
                    $table .= "     <td>".$value->numeroTVA()."</td>\n";
                    $table .= "     <td><div class=\"btn-group\">\n";
                    $table .= "         <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\">\n";
                    $table .= "             <span class=\"caret\"></span>\n";
                    $table .= "             <span class=\"sr-only\">Toggle Dropdown</span>\n";
                    $table .= "         </button>";
                    $table .= "         <ul class=\"dropdown-menu\" role=\"menu\">\n";
                    $table .= "             <li><button name=\"button\" id=\"delete\" onclick='deleteClient(".$value->id().")' value=".$value->id().">Supprimer</button></li>\n";
                    $table .= "             <li><button name=\"button\" id=\"modify\" onclick='modifyProfessionnel(".$value->id().")' value=".$value->id().">Modifier</button></li>\n";                 
                    $table .= "         </ul>\n";
                    $table .= "      </div></td>\n";
                } 
                if($value instanceof Association)
                {
                    $table .= "     <td>".$value->nomAssociation()."</td>\n";
                    $table .= "     <td>".$value->dateDeclaration()."</td>\n";
                    $table .= "     <td>".$value->datePublication()."</td>\n";
                    $table .= "     <td>".$value->numeroAnnonce()."</td>\n";
                    $table .= "     <td><div class=\"btn-group\">\n";
                    $table .= "         <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\">\n";
                    $table .= "             <span class=\"caret\"></span>\n";
                    $table .= "             <span class=\"sr-only\">Toggle Dropdown</span>\n";
                    $table .= "         </button>";
                    $table .= "         <ul class=\"dropdown-menu\" role=\"menu\">\n";
                    $table .= "             <li><button name=\"button\" id=\"delete\" onclick='deleteClient(".$value->id().")' value=".$value->id().">Supprimer</button></li>\n";
                    $table .= "             <li><button name=\"button\" id=\"modify\" onclick='modifyAssociation(".$value->id().")' value=".$value->id().">Modifier</button></li>\n";                 
                    $table .= "         </ul>\n";
                    $table .= "      </div></td>\n";
                }
                $table .= "</tr>\n";
            }
            $table .= "</table>\n";
            return $table; 
        }
    }
?>