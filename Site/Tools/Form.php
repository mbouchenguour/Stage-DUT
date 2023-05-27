<?php
require_once("Champ.php");

class Form {

    /**
     * Liste des champs du formulaire (liste des <input>)
     * (de type array())
     */
    private $champs;

    /**
     * Script à exécuter lors de la validation du formulaire
     */
    private $action;

    /**
     * Constructeur de la classe form.
     */
    public function __construct($action) {
        $this->champs = array();
        $this->action = $action;
    }

    /**
     * Retourne formulaire sous forme HTML.
     */
    public function __toString() {
        $s = "";
        $s .= "<form action=\"".$this->action."\" method=\"POST\">\n";
        foreach ($this->champs as $valeur) {
            $s .= "<div class=\"form-group\">\n";
            $s .= $valeur->__toString();
            $s .= "</div>";
        }
        $s .= "</form>\n";
        return $s;
    }

    /**
     * Ajoute input à la liste des champs du formulaire.
     */
    public function add(Champ $champs) {
        $this->champs[] = $champs;
    }
}


?>
