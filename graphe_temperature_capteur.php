<!DOCTYPE html>
<html>



<?php

	
		

		function moyenne_heure_temperature_capteur(array $temp, array $date){

      $heure_actuelle = time();


      for ($i=0;$i<sizeof($date);$i++){

        $timestamp = strtotime($date[$i]);
}


			

			return $temp_moy;
		}

		try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '' , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT Valeur,Date FROM  test_temperature WHERE Lieu=\'Chambre\' ORDER BY Date DESC LIMIT 144');

// On affiche chaque entrée une à une

?>


<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
    <p>
     <?php  while ($donnees = $reponse->fetch()){?>

     <?php echo $donnees['Valeur']; ?><br>
     <?php echo $donnees['Date']; ?> <br>
     <?php echo time();?> <br>

     <?php } 
      $reponse->closeCursor(); // Termine le traitement de la requête ?>
    

   </p>

  
</body>
</html>