<?php

/**
 * Class permettant de gérer un service
 */
class Service
{
    private $idService;
    private $nomService;
    private $description;
    private $origine;
    private $tauxTVA;
    private $prixHTA;
    private $prixHTS;
    private $prixHTT;
    private $prixHTM;
    /**
     * Getter/Setter
     */
    public function idService()
    {
        return $this->idService;
    }
    public function nomService()
    {
        return $this->nomService;
    }
    public function description()
    {
        return $this->description;
    }
    public function origine()
    {
        return $this->origine;
    }
    public function tauxTVA()
    {
        return $this->tauxTVA;
    }
    public function prixHTA()
    {
        return $this->prixHTA;
    }
    public function prixHTS()
    {
        return $this->prixHTS;
    }
    public function prixHTT()
    {
        return $this->prixHTT;
    }
    public function prixHTM()
    {
        return $this->prixHTM;
    }

    public function prixTTA()
    {
        return $this->prixHTA * (($this->tauxTVA / 100) + 1);
    }
    public function prixTTS()
    {
        return $this->prixHTS * (($this->tauxTVA / 100) + 1);
    }
    public function prixTTT()
    {
        return $this->prixHTT * (($this->tauxTVA / 100) + 1);
    }
    public function prixTTM()
    {
        return $this->prixHTM * (($this->tauxTVA / 100) + 1);
    }

    public function setIdService($idService)
    {
        $this->idService = $idService;
    }
    public function setNomService($nomService)
    {
        $this->nomService = $nomService;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setOrigine($origine)
    {
        $this->origine = $origine;
    }
    public function setTauxTVA($tauxTVA)
    {
        $this->tauxTVA = $tauxTVA;
    }
    public function setPrixHTA($prixHTA)
    {
        $this->prixHTA = $prixHTA;
    }
    public function setPrixHTS($prixHTS)
    {
        $this->prixHTS = $prixHTS;
    }
    public function setPrixHTT($prixHTT)
    {
        $this->prixHTT = $prixHTT;
    }
    public function setPrixHTM($prixHTM)
    {
        $this->prixHTM = $prixHTM;
    }

    /**
     * Permet l'initialisation
     * @param $donnees Array des données du service
     */
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Renvoie l'instance sous forme d'un tableau
     * @return $array l'array avec les informartions du service
     */
    public function toArray()
    {
        $array = array();
        foreach ($this as $key => $value) {
            array_push($array, $value);
        }
        return $array;
    }

    /**
     * Renvoie l'instance sous forme d'un tableau pour l'API
     * @return array l'array avec les informations du service
     */
    public function toArrayJSON()
    {
        $array = array();
        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }
        return $array;
    }

    /**
     * Renvoie l'instance sous forme d'un tableau JSON pour l'API
     * @return array l'array avec les informations du service
     */
    public function toJSON()
    {

        $json = json_encode($this->toArrayJSON());
        return $json;
    }
}
