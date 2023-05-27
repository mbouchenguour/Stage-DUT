<?php
require_once('../ManageClass/formuleManager.class.php');
require_once('../ManageClass/serviceManager.class.php');

    class VueFormule
    {

        private $_formules = array();
        private $_id;

        /**
         * @param 
         */
        public function __construct($id)
        {
            $fm = new FormuleManager();
            $fByIdClient = $fm->getFormulesByIdClient($id);
            $this->_formules = $fByIdClient;
            $this->_id = $id;
            
        }

        /**
         * Permet l'affichage sous forme d'un tableau 
         */
        public function __toString()
        {
            $table = "<table class=\"table\">\n";
            $table .= "<thead>\n";
            $table .= "     <tr>\n";
            $table .= "         <th>Nom du service</th>\n";
            $table .= "         <th>Date de souscription</th>\n";
            $table .= "         <th>Date de fin de service</th>\n";
            $table .= "         <th>Type de facturation</th>\n";
            $table .= "         <th>Prix</th>\n";
            $table .= "         <th>Action</th>\n";
            $table .= "     </tr>\n";
            $table .= "</thead>\n";
            foreach($this->_formules as $value)
            {
                $sm = new ServiceManager();
                $nom = $sm->getServiceById($value->idService())->nomService();
                $table .= "<tr>\n";
                $table .= "     <td>".$nom."</td>\n";
                $table .= "     <td>".$value->dateSouscription()."</td>\n";
                $table .= "     <td>".$value->dateFinService()."</td>\n";
                $table .= "     <td>".$value->typeFacturationToString()."</td>\n";
                $table .= "     <td>".$value->prix()."</td>\n";
                $table .= "     <td><div class=\"btn-group\">\n";
                $table .= "         <button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\">\n";
                $table .= "             <span class=\"caret\"></span>\n";
                $table .= "             <span class=\"sr-only\">Toggle Dropdown</span>\n";
                $table .= "         </button>";
                $table .= "         <ul class=\"dropdown-menu\" role=\"menu\">\n";
                $table .= "             <li><button name=\"button\" id=\"delete\" onclick='deleteFormule(".$value->idFormule().")' value=".$value->idFormule().">Supprimer</button></li>\n";
                $table .= "             <li><button name=\"button\" id=\"update\" onclick='updateFormule(".$value->idFormule().")' value=".$value->idFormule().">Renouveller</button></li>\n";
                $table .= "             <li><button name=\"button\" id=\"modify\" onclick='modifyFormule(".$value->idFormule().")' value=".$value->idFormule().">Modifier</button></li>\n";                 
                $table .= "         </ul>\n";
                $table .= "      </div></td>\n";
                $table .= "</tr>\n";
            }
            $table .= "</table>\n";
            return $table; 
        }
    }
?>