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
            require_once('../Class/professionnel.class.php');
            require_once('../ManageClass/clientManager.class.php');

            $id = $_GET['id'];
            $form = new Form("modifyProfessionnel.php?id=".$id);

            $cm = new ClientManager();
            $prof = $cm->getProfessionnelById($id); 

            $champs_id = new Champ("Id","id","number",$prof->id());
            $champs_nomCompte = new Champ("Nom compte","nomCompte","text",$prof->nomCompte());
            $champs_dateCreation = new Champ("Date creation","dateCreation","date",$prof->dateCreation());
            $champs_nom = new Champ("Nom","nom","text",$prof->nom());
            $champs_prenom = new Champ("Prenom","prenom","text",$prof->prenom());
            $champs_adresse = new Champ("Adresse","adresse","text",$prof->adresse());
            $champs_cp = new Champ("Code postal","cp","number",$prof->cp());
            $champs_ville = new Champ("Ville","ville","text",$prof->ville());
            $champs_pays = new Champ("Pays","pays","text",$prof->pays());
            $champs_mail = new Champ("E-mail","mail","email",$prof->mail());
            $champs_telephone = new Champ("Téléphone","telephone","tel",$prof->telephone());
            $champs_nomSociete = new Champ("Nom de la société","nomSociete","date",$prof->nomSociete());
            $champs_siret = new Champ("Numéro SIRET","siret","text",$prof->siret());
            $champs_codeApe = new Champ("Code APE","codeApe","text",$prof->codeApe());
            $champs_numeroTVA = new Champ("Numéro TVA","numeroTVA","text",$prof->numeroTVA());
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
            $form->add($champs_nomSociete);
            $form->add($champs_siret);
            $form->add($champs_codeApe);
            $form->add($champs_numeroTVA);
            $form->add($champs_submit);

            echo $form->__toString();

            if(isset($_POST['submit']))
            {
                $professionnel = new Professionnel();      
                $professionnel->hydrate($_POST);
                $cm = new ClientManager();
                $cm->updateProfessionnel($professionnel);
                header('Location: ../Page/client.php');
            }
        ?>
    </body>
</html>
