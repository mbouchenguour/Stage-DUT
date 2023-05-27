<?php

/**
 * Cron
 */

include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/manageclass/formuleManager.class.php');
include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/manageclass/mailManager.class.php');
include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/manageclass/clientManager.class.php');
include_once('/home/stage2021/domains/stage.hofmann.fr/public_html/sitereact/server/class/mail.class.php');

$fm = new FormuleManager();
$formules = $fm->getAllFormules();
$mm = new MailManager();
$cm = new ClientManager();
$mail;
$i = 0;
foreach ($formules as $value) {
      $formule = new Formule();
      $formule->hydrate($value);
      $dateDuJour = new DateTime();
      $dateFinSouscription = new DateTime($formule->dateFinService());
      $temp = date_diff($dateDuJour, $dateFinSouscription);
      $mail = $mm->getMailByIdClient($formule->idClient());
      if (empty($mail->toArray()[0])) {
            $mail = $mm->getByDefaultMail();
            $mail->setIdClient($formule->idClient());
      }
      $mail->setFormule($formule);
      $mail->setClient($cm->getClientById($formule->idClient()));
      switch ($temp->format('%a')) {
            case 29: //30 jours
                  $mail->setJour(30);
                  $mail->sendMail();
                  break;
            case 14: //15 jours
                  $mail->setJour(15);
                  $mail->sendMail();
                  break;
            case 7: //8 jours
                  $mail->setJour(8);
                  $mail->sendMail();
                  break;
            case 4: //5 jours
                  $mail->setJour(5);
                  $mail->sendMail();
                  break;
            case 2: //3 jours
                  $mail->setJour(3);
                  $mail->sendMail();
                  break;
            case 0: //1 jours
                  $mail->setJour(1);
                  $mail->sendMail();
                  break;
            default:
                  $mail->setJour(850);
                  $mail->sendMail();
      }
}
