<?php

require_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/mail.class.php');
require_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/tools/toolsDAO.class.php');

/**
 * Permet de communiquer avec la bdd pour effectuer des actions sur les mails
 */
class MailManager
{

    private $tDAO;

    /**
     * Constructeur
     * @param $db Instance PDO de la connexion vers la bdd
     */
    public function __construct()
    {
        $this->tDAO = new ToolsDAO();
    }

    /**
     * Retourne le mail à partir de l'id d'un client
     * @return $mail Instance de mail
     */
    public function getMailByIdClient($idClient)
    {
        $mail = new Mail();
        $temp = $this->tDAO->query("CALL getMailByIdClient(?);", array($idClient));
        if (!empty($temp)) {
            $data = $temp[0];
            $mail->hydrate($data);
        }
        return $mail;
    }

    /**
     * Retourne true si le client a un mail 
     * @return $bool le Booléen (true si le client à un mail, sinon false)
     */
    public function hasMail($idClient)
    {
        $bool = true;
        $req = $this->tDAO->query("CALL getMailByIdClient();", array());
        if (empty($req)) {
            $bool = false;
        }
        return $bool;
    }

    /**
     * Ajouter un mail perso
     */
    public function addMail($idClient, $sujet, $body)
    {
        $req = $this->tDAO->call("CALL addMail(?,?,?);", array($idClient, $sujet, $body));
    }



    /**
     * Supprimer le mail
     */
    public function deleteMail($idMail)
    {
        $req = $this->tDAO->call("CALL deleteMail(?);", array($idMail));
    }

    /**
     * Supprimer le mail d'un client à partir de son id
     * @param $idClient Id du client 
     */
    public function deleteMailByIdClient($idClient)
    {
        $req = $this->tDAO->call("CALL deleteMailByIdClient(?);", array($idClient));
    }

    /**
     * Modifier le mail
     */

    public function updateMail($idClient, $sujet, $body)
    {
        $req = $this->tDAO->call("CALL updateMail(?,?,?);", array($idClient, $sujet, $body));
    }

    /**
     * Modifier le mail par défault
     */

    public function updateDefaultMail($sujet, $body)
    {
        $req = $this->tDAO->call("CALL updateDefaultMail(?,?);", array($sujet, $body));
    }

    /**
     * Retourne le mail par défaut 
     */
    public function getByDefaultMail()
    {
        $req = $this->tDAO->query("CALL getByDefaultMail();", array());
        $mail = new Mail();
        $mail->hydrate($req[0]);
        return $mail;
    }
}
