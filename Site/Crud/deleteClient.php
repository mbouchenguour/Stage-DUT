<?php
    require_once('../ManageClass/clientManager.class.php');

    if(isset($_POST['id']))
    {
        $cm = new ClientManager();
        $cm->deleteClient($_POST['id']);
        header('Location: ../Page/client.php');
    }
?>

