<?php
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=clients.xls");

    require_once('../ManageClass/clientManager.class.php');
    require_once('../ViewClass/vueClient.class.php');
    $cm = new ClientManager();
    $allClient = $cm->getAllClients();  
    $vClients = new VueClient($allClient);
    echo $vClients->__toStringForExcel();
?>
