<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Liste des clients</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Droid+Sans" />
        <link rel="stylesheet" href="../Template/navbar.css" />
        <link rel="stylesheet" href="../Css/clients.css" />
        <link rel="stylesheet" href="../Css/all.css" />
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
        <div class="table">
            <div class="button">
                <ol class="switch">
                    <li>
                        <input type="checkbox" class="labelCheckbox" id="particulierOnly" class="btn">
                        <label for="particulierOnly">Particulier</label>
                    </li>
                    <li>
                        <input type="checkbox" id="professionnelOnly" class="btn">
                        <label for="professionnelOnly">Professionnel</label>
                    </li>
                    <li>
                        <input type="checkbox" id="associationOnly" class="btn">
                        <label for="associationOnly">Association</label>
                    </li>
                </ol>    
            </div>
        <?php
            require_once('../ManagerClass/clientManager.class.php');
            require_once('../ViewClass/vueClient.class.php');

            $clientManager = new ClientManager();
            $clients = $clientManager->getAllClients();
            $vueClient = new VueClient($clients);
            echo $vueClient;
        ?>
        </div>
    </body>

</html>