<?php
// On démarre la session AVANT d'écrire du code HTML
session_start(); ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style_login.css">
	<title>eternity supervisor</title>
</head>



<body>


	<?php include("header.php"); ?>

	<section>
		
		<form method="post" action="home_page.php">

			
			<p>
				<label for="pseudo">Pseudo</label> : <input type="text" name="user_pseudo" id="user_pseudo" placeholder="<?php if (isset($_COOKIE['pseudo'])) {echo ($_COOKIE['pseudo']);}?>" maxlength="30" size="20">
				
			</p>

			
			<p>
				<label for="mdp_user_connexion">Mot de passe</label> : <input type="password" name="password_user_connexion" id="password_user_connexion" placeholder="Entrez votre mot de passe" maxlength="30" size="20">
			</p>

			<p><input type="submit" value="Envoyer" /></p>


		</form> 


	</section>

	<section>
		
		<p>Mot de passe oublié ? cliquez <a href="mdp_oublie.php">ici</a></p>

	</section>

	<?php include("footer.php"); ?>



</body>



</html>