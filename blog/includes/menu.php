<div id="menu">
	<a href="index.php">Accueil</a>
	<!-- <a href="inscription.php">Inscription</a>
	<a href="connexion.php">Connexion</a>
	<a href="deconnexion.php">Déconnexion</a> -->
	<?php 
	if($id == 0) { 
		echo "<a href='register.php'>Inscription</a>
			  <a href='connection.php'>Connexion</a>";
	} else {
		echo "<a href='logout.php'>Déconnexion</a>
			  Connecté : ".$pseudo; 
	}
	?>
</div>