<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>
  
  <h1>Premier test d'affichage de la base de données</h1> 
</body>

<pre>

<?php 
  include_once('../Class/historique.class.php');
  include_once('../ManageClass/historiqueManager.class.php');

  $hm = new HistoriqueManager();
  $list = $hm->getAllHistorique();
  print_r($list);
?>

</pre>

</html>