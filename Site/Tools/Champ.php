<?php

/**
 * Représente un champ de type input (HTML) :
*/
class Champ {

    private $name;
    private $type;
    private $label;
    private $value;
    private $select;


    public function __construct($label, $name, $type, $value) {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
        $this->select = null;
    }

    /**
     * Retourne l'objet Champ (et son label) au format HTML.
     */
    public function __toString() {
        $s = "";
        $s .= "<label for=\"".$this->name."\">".$this->label."</label>\n";
        if($this->type == "number"){ //vérifie si type number pour limiter au nombre positif
            $s .= "<input type=\"".$this->type."\" name=\"".$this->name."\" value=\"".$this->value."\" min=\"0\"/><br/>\n";
        
        } else if ($this->type == "select"){
            $s .= "<select name=\"".$this->name."\">\n";
            foreach($this->value as $key => $val){
                $temp = $val;
                if(!is_Array($temp)){
                    $temp = $val->toArray();
                }
                if($temp[0] != $this->select)
                    $s .= "<option value=\"". $temp[0] ."\">".$temp[0].'-'.$temp[1]."</option>\n";
                else
                    $s .= "<option value=\"". $temp[0] ."\" selected>".$temp[0].'-'.$temp[1]."</option>\n";
            }
            $s .= "</select>";
        }

        else {
            $s .= "<input type=\"".$this->type."\" name=\"".$this->name."\" value=\"".$this->value."\"/><br/>\n";
        }
        return $s;
    }

    /**
     * Accesseur/mutateur
     */
    public function setValue($value) {
        $this->value = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function setSelect($id) {
        $this->select = $id;
    }

}

?>

