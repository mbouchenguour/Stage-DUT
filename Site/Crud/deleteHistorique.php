<?php
    require_once('../ManageClass/formuleManager.class.php');

    if(isset($_POST['id'])){
        $fm = new FormuleManager();
        $fm->deleteHistorique($_POST['id']);
        header('Location: ../Page/historique.php');
    }
?>