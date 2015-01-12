<?php
$title="Connexion";
include ("includes/pdo.php");
include("includes/header.php");
include("includes/menu.php");
if($id == 0) {
?>

<h1>Connexion</h1>
	<form method="post" action="connection.php">
		<fieldset>
			<legend>Connexion</legend>
			<p>
				<label for="pseudo">Pseudo :</label>
				<input name="pseudo" type="text" id="pseudo" tabindex="1"><br />
				<label for="password">Mot de Passe :</label>
				<input type="password" name="password" id="password" tabindex="2">
			</p>
		</fieldset>
		<p>
			<input type="submit" value="Connexion" />
		</p>
	</form>
	<a href="./register.php">Pas encore inscrit ?</a>
<?php
	if (!isset($_POST['pseudo'])) {
		$message = '';
	} else {
	    $message='';
	    if (empty($_POST['pseudo']) || empty($_POST['password']) ) {
	        $message = '<p>une erreur s\'est produite pendant votre identification.
			Vous devez remplir tous les champs</p>
			<p>Cliquez <a href="./connection.php">ici</a> pour revenir</p>';
	    } else {
	        $query = $db->prepare("SELECT id, pseudo, password
	        FROM users WHERE pseudo = :pseudo");
	        $query->execute(array("pseudo"=>$_POST["pseudo"]));
	        // $query->execute();
	        $data = $query->fetch();
	        var_dump($data);
	        var_dump($_POST);
			if ($data['password'] == $_POST['password']) {
			    $_SESSION['pseudo'] = $data['pseudo'];
			    // $_SESSION['level'] = $data['membre_rang'];
			    $_SESSION['id'] = $data['id'];
			    $message = '<p>Bienvenue '.$data['pseudo'].', 
					vous êtes maintenant connecté!</p>
					<p>Cliquez <a href="./index.php">ici</a> 
					pour revenir à la page d accueil</p>';
		  			header('Location: index.php');      
			}
			else {
			    $message = '<p>Une erreur s\'est produite 
			    pendant votre identification.<br /> Le mot de passe ou le pseudo 
		        entré n\'est pas correcte.</p>';
			}
	    	$query->CloseCursor();
	    }
	}
		// $page = htmlspecialchars($_POST['page']);
		// echo 'Cliquez <a href="'.$page.'">ici</a> pour revenir à la page précédente';
} else {
	$message = "Vous êtes déjà connecté";
}
echo $message;
include("includes/footer.php");
?>
