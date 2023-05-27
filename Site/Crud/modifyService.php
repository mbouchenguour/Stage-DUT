<?php include '../TemplatePHP/verify.php';?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" integrity="sha256-BJ/G+e+y7bQdrYkS2RBTyNfBHpA9IuGaPmf9htub5MQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="../Css/navbar.css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script>
            $(function(){
                $("#navBar").load("../TemplateHTML/navbar.html"); 
            });    
        </script>
    </head>
    <body>
        <div id="navBar"></div>
        
        <?php
            require_once('../Tools/Champ.php');
            require_once('../Tools/Form.php');
            require_once('../Class/service.class.php');
            require_once('../ManageClass/serviceManager.class.php');

            $id = $_GET['id'];
            $form = new Form("modifyService.php?id=".$id);

            $sm = new ServiceManager();
            $serv = $sm->getServiceById($id); 


            $champs_nomService = new Champ("Nom du service","nomService","text",$serv->nomService());
            $champs_description = new Champ("Description","description","text",$serv->description());
            $champs_origine = new Champ("Origine","origine","text",$serv->origine());
            $champs_tauxTVA = new Champ("Taux TVA","tauxTVA","number",$serv->tauxTVA());
            $champs_prixHTA = new Champ("Prix hors taxe annuelle","prixHTA","number",$serv->prixHTA());
            $champs_prixHTS = new Champ("Prix hors taxe semestrielle","prixHTS","number",$serv->prixHTS());
            $champs_prixHTT = new Champ("Prix hors taxe trimestrielle","prixHTT","number",$serv->prixHTT());
            $champs_prixHTM = new Champ("Prix hors taxe mensuelle","prixHTM","number",$serv->prixHTM());
            $champs_submit = new Champ("","submit","submit","Valider");

            $form->add($champs_nomService);
            $form->add($champs_description);
            $form->add($champs_origine);
            $form->add($champs_tauxTVA);
            $form->add($champs_prixHTA);
            $form->add($champs_prixHTS);
            $form->add($champs_prixHTT);
            $form->add($champs_prixHTM);
            $form->add($champs_submit);

            echo $form->__toString();

            if(isset($_POST['submit']))
            {
                $service = new Service(); 
                $service->setIdService($serv->idService());   
                $service->hydrate($_POST);
                $sm = new ServiceManager();
                $sm->updateService($service);
                header('Location: ../Page/service.php');
            }
        ?>
    </body>
</html>
