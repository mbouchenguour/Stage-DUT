<?php

class ToolsDAO{
    /**
     * Permet d'ouvrir une connection avec PDO
     *
     * @return PDO Instance de la classe permettant d'éxecuter les requêtes SQL.
     */
    private function openCon(){
        return new PDO('mysql:host=localhost;dbname=stage2021_stage','stage2021','49sAWeXoM2');
    }

    /**
     * Permet de fermer la connection.
     * 
     * @return null
     */
    private function closeCon(){
        return null;
    }

    /**
     * Execute la requête $q avec les paramètre $p et retourne le contenu du SELECT
     *
     *
     * @param string $q
     * Représente la requête en elle-même.
     *
     * @param array $p
     * Paramètre de la requête passé sous forme d'une array.
     *
     *
     * @return array
     * Le résultat de la requête.
     */
    public function query($q, $p){
        $c = $this->openCon();

        $req = $c->prepare($q);
        $req->execute($p);

        $res = $req->fetchAll();
        $req->closeCursor();

        $c = $this->closeCon();

        return $res;
    }

    /**
     * Permet d'executer une procedure mysql sans retour.
     *
     *
     * @param string $q
     * Appel de la procédure
     *
     * @param array $p
     * Paramètre(s) de la procédure.
     */
    public function call($q, $p){
        $c = $this->openCon();

        $r = $c->prepare($q);
        $r->execute($p);

        $c = $this->closeCon();
    }
}