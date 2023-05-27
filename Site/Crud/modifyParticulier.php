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
            require_once('../Class/particulier.class.php');
            require_once('../ManageClass/clientManager.class.php');

            $id = $_GET['id'];
            $form = new Form("modifyParticulier.php?id=".$id);

            $cm = new ClientManager();
            $part = $cm->getParticulierById($id); 

            $champs_id = new Champ("Id","id","number",$part->id());
            $champs_nomCompte = new Champ("Nom compte","nomCompte","text",$part->nomCompte());
            $champs_dateCreation = new Champ("Date creation","dateCreation","date",$part->dateCreation());
            $champs_nom = new Champ("Nom","nom","text",$part->nom());
            $champs_prenom = new Champ("Prenom","prenom","text",$part->prenom());
            $champs_adresse = new Champ("Adresse","adresse","text",$part->adresse());
            $champs_cp = new Champ("Code postal","cp","number",$part->cp());
            $champs_ville = new Champ("Ville","ville","text",$part->ville());
            $champs_pays = new Champ("Pays","pays","text",$part->pays());
            $champs_mail = new Champ("E-mail","mail","email",$part->mail());
            $champs_telephone = new Champ("Téléphone","telephone","tel",$part->telephone());
            $champs_dateNaissance = new Champ("Date de naissance","dateNaissance","date",$part->dateNaissance());
            $champs_villeNaissance = new Champ("Ville de naissance","villeNaissance","text",$part->villeNaissance());
            $champs_paysNaissance = new Champ("Pays de naissance","paysNaissance","text",$part->paysNaissance());
            $champs_submit = new Champ("","submit","submit","Valider");

            $form->add($champs_id);
            $form->add($champs_nomCompte);
            $form->add($champs_dateCreation);
            $form->add($champs_nom);
            $form->add($champs_prenom);
            $form->add($champs_adresse);
            $form->add($champs_cp);
            $form->add($champs_ville);
            $form->add($champs_pays);
            $form->add($champs_mail);
            $form->add($champs_telephone);
            $form->add($champs_dateNaissance);
            $form->add($champs_villeNaissance);
            $form->add($champs_paysNaissance);
            $form->add($champs_submit);

            echo $form->__toString();

            if(isset($_POST['submit']))
            {
                $particulier = new Particulier();      
                $particulier->hydrate($_POST);
                $cm->updateParticulier($particulier);
                header('Location: ../Page/client.php');
            }
        ?>
    </body>
</html>
