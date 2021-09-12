<?php
// On démarre la session AVANT d'écrire du code HTML

session_start();

if (isset($_POST['user_pseudo'])) {

	$_SESSION['pseudo'] = $_POST['user_pseudo'];
	setcookie('pseudo', $_POST['user_pseudo'], time() + 365*24*3600, null, null, false, true);
}


if (isset($_POST['password_user_connexion'])){

	$_SESSION['mdp'] = $_POST['password_user_connexion'];
}


// On s'amuse à créer quelques variables de session dans $_SESSION



// Et SEULEMENT MAINTENANT, on peut commencer à écrire du code html
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style_app_android.css">
	<title>Eternity Project</title>
</head>
<body>

	<p>
		
		<?php /*echo ($_SESSION['pseudo']);
echo ($_SESSION['mdp']);*/?>
	</p>



			<?php


			if  ((isset($_POST['user_pseudo']) AND isset($_POST['password_user_connexion'])) OR  isset($_SESSION['pseudo']) AND isset($_SESSION['mdp'])) {

		

				if (( $_SESSION['pseudo']=="test" AND $_SESSION['mdp']=="test")){

					include("header.php");

					?>

					<section>
						
						<h1>Home Page</h1>
					</section>



					<?php
					include("menu.php");
					include ("test.php");
					

				  ?>



<section>
	
	<p> Mettre les prévision de conso</p>

</section>

<section>
	
	<p><?php include("meteo.php")?></p>

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

				echo "Veuillez rentrer un mot de passe et un nom d'utilisateur or session expiré";

				?>

				<p><a href="login_page.php">Revenir à la page de log</a></p>

				<?php
			}


		
			?>

	

<body>

	

</html>