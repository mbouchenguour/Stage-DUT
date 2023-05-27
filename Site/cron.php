<?php
      include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/siteBase/ManageClass/formuleManager.class.php');
      include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/siteBase/Class/mail.class.php');
      $fm = new FormuleManager();
      $formules = $fm->getAllFormules();
      foreach($formules as $value){
            $formule = new Formule();
            $formule->hydrate($value);
            $dateDuJour = new DateTime();
            $dateFinSouscription = new DateTime($formule->dateFinService());
            $temp = date_diff($dateDuJour,$dateFinSouscription);
            switch($temp->format('%a')){
                  case 29://30 jours
                        new Mail($formule,30);
                        break;
                  case 14://15 jours
                        new Mail($formule,15);
                        break;
                  case 7://8 jours
                        new Mail($formule,8);
                        break;
                  case 4://5 jours
                        new Mail($formule,5);
                        break;
                  case 2://3 jours
                        new Mail($formule,3);
                        break;
                  case 0://1 jours
                        new Mail($formule,1);
                        break;      
            }
      }
?>
