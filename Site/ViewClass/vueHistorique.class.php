<?php
require_once('../ManageClass/formuleManager.class.php');
require_once('../ManageClass/serviceManager.class.php');
require_once('../Class/formule.class.php');

    class VueHistorique
    {

        private $_formules = array();

        /**
         * @param 
         */
        public function __construct()
        {
            $fm = new FormuleManager();
            $historique = $fm->getAllHistorique();
            $this->_formules = $historique;
            
        }

        /**
         * Permet l'affichage sous forme d'un tableau 
         */
        public function __toString()
        {
            $table = "<table class=\"table\">\n";
            $table .= "<thead>\n";
            $table .= "     <tr>\n";
            $table .= "         <th>Id du formule</th>\n";
            $table .= "         <th>Id du client</th>\n";
            $table .= "         <th>Nom du Service</th>\n";
            $table .= "         <th>Date de souscription</th>\n";
            $table .= "         <th>Date de fin de service</th>\n";
            $table .= "         <th>Type de facturation</th>\n";
            $table .= "         <th>Prix</th>\n";
            $table .= "         <th>Supprimé</th>\n";
            $table .= "         <th>Action</th>\n";
            $table .= "     </tr>\n";
            $table .= "</thead>\n";
            foreach($this->_formules as $value)
            {
                $sm = new ServiceManager();
                $nom = $sm->getServiceById($value->idService())->nomService();
                $table .= "<tr>\n";
                $table .= "     <td>".$value->idFormule()."</td>\n";
                $table .= "     <td>".$value->idClient()."</td>\n";
                $table .= "     <td>".$nom."</td>\n";
                $table .= "     <td>".$value->dateSouscription()."</td>\n";
                $table .= "     <td>".$value->dateFinService()."</td>\n";
                $table .= "     <td>".$value->typeFacturationToString()."</td>\n";
                $table .= "     <td>".$value->prix()."</td>\n";
                $table .= "     <td>".$value->supprimeToString()."</td>\n";
                $table .= "     <td><div class=\"btn-group\">\n";
                $table .= "         <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\">\n";
                $table .= "             <span class=\"caret\"></span>\n";
                $table .= "             <span class=\"sr-only\">Toggle Dropdown</span>\n";
                $table .= "         </button>";
                $table .= "         <ul class=\"dropdown-menu\" role=\"menu\">\n";
                $table .= "             <li><button name=\"button\" id=\"delete\" onclick='deleteHistorique(".$value->idFormule().")' value=".$value->idFormule().">Supprimer</button></li>\n";
                $table .= "             <li><button name=\"button\" id=\"modify\" onclick='modifyHistorique(".$value->idFormule().")' value=".$value->idFormule().">Modifier</button></li>\n";
                $table .= "         </ul>\n";
                $table .= "      </div></td>\n";
                $table .= "</tr>\n";
            }
            $table .= "</table>\n";
            return $table; 
        }
    }
?>