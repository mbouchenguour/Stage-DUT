<?php
    require_once('../ManageClass/serviceManager.class.php');

    if(isset($_POST['id'])){
        $sm = new ServiceManager();
        $sm->deleteService($_POST['id']);
        header('Location: ../Page/service.php');
    }
?>