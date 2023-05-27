<?php

/**
 * Class permettant de gérer une association
 */
class Association
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
    private $idTypeClient;
    private $nomAssociation;
    private $dateDeclaration;
    private $datePublication;
    private $numeroAnnonce;

    /**
     * Getter/Setter
     */
    public function id()
    {
        return $this->id;
    }
    public function nomCompte()
    {
        return $this->nomCompte;
    }
    public function dateCreation()
    {
        return $this->dateCreation;
    }
    public function nom()
    {
        return $this->nom;
    }
    public function prenom()
    {
        return $this->prenom;
    }
    public function adresse()
    {
        return $this->adresse;
    }
    public function cp()
    {
        return $this->cp;
    }
    public function ville()
    {
        return $this->ville;
    }
    public function pays()
    {
        return $this->pays;
    }
    public function mail()
    {
        return $this->mail;
    }
    public function telephone()
    {
        return $this->telephone;
    }
    public function nomAssociation()
    {
        return $this->nomAssociation;
    }
    public function dateDeclaration()
    {
        return $this->dateDeclaration;
    }
    public function datePublication()
    {
        return $this->datePublication;
    }
    public function numeroAnnonce()
    {
        return $this->numeroAnnonce;
    }
    public function idTypeClient()
    {
        return $this->idTypeClient;
    }
    public function idTypeClientToString()
    {
        return "Association";
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNomCompte($nomCompte)
    {
        $this->nomCompte = $nomCompte;
    }
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }
    public function setCp($cp)
    {
        $this->cp = $cp;
    }
    public function setVille($ville)
    {
        $this->ville = $ville;
    }
    public function setPays($pays)
    {
        $this->pays = $pays;
    }
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }
    public function setNomAssociation($nomAssociation)
    {
        $this->nomAssociation = $nomAssociation;
    }
    public function setDateDeclaration($dateDeclaration)
    {
        $this->dateDeclaration = $dateDeclaration;
    }
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    }
    public function setNumeroAnnonce($numeroAnnonce)
    {
        $this->numeroAnnonce = $numeroAnnonce;
    }
    public function setIdTypeClient($idTypeClient)
    {
        $this->idTypeClient = $idTypeClient;
    }

    /**
     * Permet l'initialisation
     * @param $donnees Array des données de l'associations
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
     * @return array l'array avec les informartions de l'association
     */
    public function toArray()
    {
        $array = array();
        foreach ($this as $key => $value) {
            if ($key != 'idTypeClient')
                array_push($array, $value);
        }
        return $array;
    }

    /**
     * Renvoie l'instance sous forme d'un tableau contenant en plus le type de client en string pour l'API
     * @return array l'array avec les informations de l'association
     */
    public function toArrayJSON()
    {
        $array = array();
        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }
        $array['typeClient'] = $this->idTypeClientToString();
        return $array;
    }

    /**
     * Renvoie l'instance sous forme d'un tableau JSON pour l'API
     * @return array l'array avec les informations de l'association
     */
    public function toJSON()
    {

        $json = json_encode($this->toArrayJSON());
        return $json;
    }
}
