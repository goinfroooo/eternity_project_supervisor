<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style_app_android.css">
	<title>Eternity Project</title>
</head>
<body>



			<?php


			if  (isset($_SESSION['pseudo']) AND isset($_SESSION['mdp'])) {

		

				if ($_SESSION['pseudo']=="test" AND $_SESSION['mdp']=="test"){

					include("header.php");

					?>

					<section>
						
						<h1>Qualité de l'air</h1>

					</section>

					<?php

					include("menu.php");

				  ?>



	
			<?php
// Sous WAMP
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '' , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer

?>

<section>
	
	<h1> CO2 salon</h1>

	<?php


// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM test_temperature');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{


	if ($donnees['Lieu']=='Salon'){
?>



<p>
    <strong>Température : </strong> : <?php echo $donnees['Valeur']; ?>°
    le <?php echo $donnees['Date'];?> à <?php echo $donnees['Heure'] ; ?>

   
   </p>
  
<?php
}}

$reponse->closeCursor(); // Termine le traitement de la requête ?>

</section>




			<?php
// Sous WAMP
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '' , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer

?>

<section>
	
	<h1> CO2 chambre</h1>

	<?php


// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM test_temperature');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{


	if ($donnees['Lieu']=='Chambre'){
?>



<p>
    <strong>Température : </strong> : <?php echo $donnees['Valeur']; ?>°
    le <?php echo $donnees['Date'];?> à <?php echo $donnees['Heure'] ; ?>

   
   </p>
  
<?php
}}

$reponse->closeCursor(); // Termine le traitement de la requête ?>

</section>


<?php include("footer.php"); ?>



		<?php
	}		

					else {

				echo "Mauvaise combinaison log/mdp";

				?>

				<p><a href="login_page.php">Revenir à la page de log</a></p>

				<?php
			}

			}

						else {

				echo "Veuillez rentrer un mot de passe et un nom d'utilisateur";

				?>

				<p><a href="login_page.php">Revenir à la page de log</a></p>

				<?php
			}


		
			?>

	

<body>

	

</html>