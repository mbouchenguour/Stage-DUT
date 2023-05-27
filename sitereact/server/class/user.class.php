<?php
class User
{
    private $id;
    private $pseudo;
    private $password;
    private $email;
    private $dateInscription;
    private $idGroupe;
    private $idClient;



    public function id()
    {
        return $this->id;
    }
    public function pseudo()
    {
        return $this->pseudo;
    }
    public function password()
    {
        return $this->password;
    }
    public function email()
    {
        return $this->email;
    }
    public function dateInscription()
    {
        return $this->dateInscription;
    }
    public function idGroupe()
    {
        return $this->idGroupe;
    }

    public function idClient()
    {
        return $this->idClient;
    }


    public function setId($id)
    {
        $this->id = $id;
    }
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }
    public function setIdGroupe($idGroupe)
    {
        $this->idGroupe = $idGroupe;
    }
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }


    /**
     * Permet l'initialisation
     * @param $donnees Array des données du particuliers
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
     * @return $array l'array avec les informartions du particulier
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
     * @return array l'array avec les informations de l'utilisateur
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
     * @return array l'array avec les informations de l'utilisateur
     */
    public function toJSON()
    {

        $json = json_encode($this->toArrayJSON());
        return $json;
    }
}
