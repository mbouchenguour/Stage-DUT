<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ajouter client</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Droid+Sans" />
        <link rel="stylesheet" href="../Template/navbar.css" />
        <link rel="stylesheet" href="../Css/all.css" />
        <link rel="stylesheet" href="../Css/addClient.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../Js/clients.js"></script>
        <script>
            $(function(){
                $(".navbar").load("../Template/navbar.html");  
            });    
        </script>
        <link rel="script" href="../Css/clients.css" />
    </head>

    <body>
        <div class="navbar"></div>
        <div class="formulaire">
        <?php
            $type = $_GET['type'];

            require_once('../Tools/Champ.php');
            require_once('../Tools/Form.php');
            require_once('../Class/particulier.class.php');
            require_once('../ManagerClass/clientManager.class.php');

            $form = new Form("addClient.php");
            $champs_id = new Champ("Identifiant","id","number","");
            $champs_nomCompte = new Champ("Nom compte","nomCompte","text","");
            $champs_dateCreation = new Champ("Date creation","dateCreation","date","");
            $champs_nom = new Champ("Nom","nom","text","");
            $champs_prenom = new Champ("Prenom","prenom","text","");
            $champs_adresse = new Champ("Adresse","adresse","text","");
            $champs_cp = new Champ("Code postal","cp","number","");
            $champs_ville = new Champ("Ville","ville","text","");
            $champs_pays = new Champ("Pays","pays","text","");
            $champs_mail = new Champ("E-mail","mail","email","");
            $champs_telephone = new Champ("Téléphone","telephone","tel","");
            
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

            switch($type){
                case "particulier":
                    $champs_dateNaissance = new Champ("Date de naissance","dateNaissance","date","");
                    $champs_villeNaissance = new Champ("Ville de naissance","villeNaissance","text","");
                    $champs_paysNaissance = new Champ("Pays de naissance","paysNaissance","text","");
                    $champs_submit = new Champ("","submitPart","submit","Valider");
                    $form->add($champs_dateNaissance);
                    $form->add($champs_villeNaissance);
                    $form->add($champs_paysNaissance);
                    $form->add($champs_submit);
                    break;
                case "association":
                    $champs_nomAssociation = new Champ("Nom association","nomAssociation","text","");
                    $champs_dateDeclaration = new Champ("Date de déclaration","dateDeclaration","date","");
                    $champs_datePublication = new Champ("Date de publication","datePublication","date","");
                    $champs_numeroAnnonce = new Champ("Numéro annonce","numeroAnnonce","text","");
                    $champs_submit = new Champ("","submitAsso","submit","Valider");
                    $form->add($champs_nomAssociation);
                    $form->add($champs_dateDeclaration);
                    $form->add($champs_datePublication);
                    $form->add($champs_numeroAnnonce);
                    $form->add($champs_submit);
                    break;
                case "professionnel":
                    $champs_nomSociete = new Champ("Nom de la société","nomSociete","text","");
                    $champs_siret = new Champ("Numéro SIRET","siret","text","");
                    $champs_codeApe = new Champ("Code APE","codeApe","text","");
                    $champs_numeroTVA = new Champ("Numéro TVA","numeroTVA","text","");
                    $champs_submit = new Champ("","submitPro","submit","Valider");
                    $form->add($champs_nomSociete);
                    $form->add($champs_siret);
                    $form->add($champs_codeApe);
                    $form->add($champs_numeroTVA);
                    $form->add($champs_submit);
                    break;
            }



            echo $form->__toString();

            if(isset($_POST['submitPro']))
            {
                $cm = new ClientManager();
                $professionnel = new Professionnel();      
                $professionnel->hydrate($_POST);
                $cm->addProfessionnel($professionnel);
                header('Location: ../Html/clients.php');
            }
            if(isset($_POST['submitAsso']))
            {
                $cm = new ClientManager();
                $association = new Association();      
                $association->hydrate($_POST);
                $cm->addAssociation($association);
                header('Location: ../Html/clients.php');
            }
            if(isset($_POST['submitPart']))
            {
                $cm = new ClientManager();
                $particulier = new Particulier();      
                $particulier->hydrate($_POST);
                $cm->addParticulier($particulier);
                header('Location: ../Html/clients.php');
            }
        ?>
        </div>
    </body>

</html>