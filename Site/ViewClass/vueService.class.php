<?php
    class VueService
    {
        private $_services = array();

        /**
         * Constructeur
         * @param $clients Liste des professionnels
         */
        public function __construct($services)
        {
            $this->_services = $services;
        }

        /**
         * Permet l'affichage sous forme d'un tableau 
         */
        public function __toString()
        {
            $table = "<table class=\"table\">\n";
            $table .= "<thead>\n";
            $table .= "     <tr >\n";
            $table .= "         <th>Identifiant du service</th>\n";
            $table .= "         <th>Nom du service</th>\n";
            $table .= "         <th>Description</th>\n";
            $table .= "         <th>Origine</th>\n";
            $table .= "         <th>Taux de TVA</th>\n";
            $table .= "         <th>Prix HT annuelle</th>\n";
            $table .= "         <th>Prix HT semestrielle</th>\n";
            $table .= "         <th>Prix HT trimestrielle</th>\n";
            $table .= "         <th>Prix HT mensuelle</th>\n";
            $table .= "         <th>Prix TTC annuelle</th>\n";
            $table .= "         <th>Prix TTC semestrielle</th>\n";
            $table .= "         <th>Prix TTC trimestrielle</th>\n";
            $table .= "         <th>Prix TTC mensuelle</th>\n";
            $table .= "     </tr>\n";
            $table .= "</thead>\n";
            foreach($this->_services as $value)
            {
                $table .= "<tr>\n";
                $table .= "     <td>".$value->idService()."</td>\n";
                $table .= "     <td>".$value->nomService()."</td>\n";
                $table .= "     <td>".$value->description()."</td>\n";
                $table .= "     <td>".$value->origine()."</td>\n";
                $table .= "     <td>".$value->tauxTVA()."</td>\n";
                $table .= "     <td>".$value->prixHTA()."</td>\n";
                $table .= "     <td>".$value->prixHTS()."</td>\n";
                $table .= "     <td>".$value->prixHTT()."</td>\n";
                $table .= "     <td>".$value->prixHTM()."</td>\n";
                $table .= "     <td>".$value->prixTTA()."</td>\n";
                $table .= "     <td>".$value->prixTTS()."</td>\n";
                $table .= "     <td>".$value->prixTTT()."</td>\n";
                $table .= "     <td>".$value->prixTTM()."</td>\n";
                $table .= "     <td><div class=\"btn-group\">\n";
                
                $table .= "         <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\">\n";
                
                $table .= "             <span class=\"caret\"></span>\n";
                $table .= "             <span class=\"sr-only\">Toggle Dropdown</span>\n";
                $table .= "         </button>";
                $table .= "         <ul class=\"dropdown-menu\" role=\"menu\">\n";
                $table .= "             <li><button name=\"button\" id=\"delete\" onclick='deleteService(".$value->idService().")' value=".$value->idService().">Supprimer</button></li>\n";
                $table .= "             <li><button name=\"button\" id=\"modify\" onclick='modifyService(".$value->idService().")' value=".$value->idService().">Modifier</button></li>\n";                 
                $table .= "         </ul>\n";
                
                $table .= "      </div></td>\n";
                $table .= "     </tr>\n";
            }
                
            $table .= "</table>\n";
            return $table; 
        }
    }
?>