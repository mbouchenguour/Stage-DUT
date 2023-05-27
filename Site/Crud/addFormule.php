<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" integrity="sha256-BJ/G+e+y7bQdrYkS2RBTyNfBHpA9IuGaPmf9htub5MQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="../Css/navbar.css" />
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
            require_once('../Class/formule.class.php');
            require_once('../ManageClass/formuleManager.class.php');
            require_once('../ManageClass/serviceManager.class.php');
            require_once('../ManageClass/clientManager.class.php');

            $form = new Form("addFormule.php");

            $sm = new ServiceManager();
            $listServ = $sm->getAllServices();

            $cm = new ClientManager();
            $listClient = $cm->getAllClients();

            $fm = new FormuleManager();
            $listTypes = $fm->getTypesFacturation();

            $champs_idClient = new Champ("Nom du compte","idClient","select",$listClient);
            $champs_idService = new Champ("Nom du service","idService","select",$listServ);
            $champs_dateSouscription = new Champ("Date de souscription","dateSouscription","date","");
            $champs_dateFinService = new Champ("Date fin de service","dateFinService","date","");
            $champs_typeFacturation = new Champ("Type de Facturation","typeFacturation","select",$listTypes);
            $champs_prix = new Champ("Prix","prix","number","");
            $champs_submit = new Champ("","submit","submit","Valider");

            $form->add($champs_idClient);
            $form->add($champs_idService);
            $form->add($champs_dateSouscription);
            $form->add($champs_dateFinService);
            $form->add($champs_typeFacturation);
            $form->add($champs_prix);
            $form->add($champs_submit);

            echo $form->__toString();

            if(isset($_POST['submit']))
            {
                $formule = new Formule();      
                $formule->hydrate($_POST);
                $fm = new formuleManager();
                $fm->addFormuleClient($formule);
                header('Location: ../Page/client.php');
            }
        ?>
    </body>
</html>