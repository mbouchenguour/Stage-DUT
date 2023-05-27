<?php



include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/manageclass/clientManager.class.php');
include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/manageclass/serviceManager.class.php');
include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/manageclass/formuleManager.class.php');
include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/formule.class.php');
include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/service.class.php');
include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/association.class.php');
include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/particulier.class.php');
include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/professionnel.class.php');

class Mail

{
    private $idMail;
    private $idClient;
    private $sujet;
    private $body;
    private $client;
    private $formule;
    private $jour;

    public function idMail()
    {
        return $this->idMail;
    }

    public function idClient()
    {
        return $this->idClient;
    }

    public function sujet()
    {
        return $this->sujet;
    }

    public function body()
    {
        return $this->body;
    }

    public function client()
    {
        return $this->client;
    }

    public function formule()
    {
        return $this->formule;
    }

    public function jour()
    {
        return $this->jour;
    }

    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    public function setIdMail($idMail)
    {
        $this->idMail = $idMail;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function setFormule($formule)
    {
        $this->formule = $formule;
    }

    /**
     * Function permettant de remplacer les attributs du mail.
     * On récupére le nom, le service et le jour d'un service.
     */
    public function replace()
    {
        $sm = new ServiceManager();
        $id = $this->formule->idService();
        $service = $sm->getServiceById($id);
        $nomService = $service->nomService();
        $sujet = $this->sujet;
        $body = $this->body;
        $sujet = str_replace('$nom', $this->client->nom(), $sujet);
        $sujet = str_replace('$service', $nomService, $sujet);
        $sujet = str_replace('$jour', $this->jour(), $sujet);
        $body = str_replace('$nom', $this->client->nom(), $body);
        $body = str_replace('$service', $nomService, $body);
        $body = str_replace('$jour', $this->jour(), $body);
        $this->setSujet($sujet);
        $this->setBody($body);
    }

    /**
     * Permet d'envoyer le mail
     */
    public function sendMail()
    {
        $this->replace();
        mail($this->client->mail(), $this->sujet, $this->body);
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
     * Retorune l'instance de mail sous la forme d'un tableau
     * @return $array Array contenant le mail
     */
    public function toArray()
    {
        $array = array();
        foreach ($this as $key => $value) {
            array_push($array, $value);
        }
        $array = array_slice($array, 1, 3);
        return $array;
    }


    /**
     * Retourne l'instance de mail(par défaut) sous la forme d'un tableau
     * @return $array Array contenant le mail
     */
    public function toArrayForDefault()
    {
        $array = array();
        foreach ($this as $key => $value) {
            array_push($array, $value);
        }
        $array = array_slice($array, 2, 2);
        return $array;
    }
}
