<?php
session_start();

//On donne ensuite un titre à la page, puis on appelle notre fichier debut.php
$title = "Index du forum";
include("includes/pdo.php");
include("includes/header.php");
include("includes/menu.php");
?>

<h1>Page d'accueil</h1>

<?php
$query=$db->prepare('SELECT *
FROM users
ORDER BY id');
$query->execute();

echo'<div id="infos">
<h2>Table utilisateurs</h2>';

foreach ($query as $user) {
	// echo $key;
	echo "<table><tr>";
	echo 	"<td>".$user["id"]."</td>";
	echo 	"<td>".$user["gender"]."</td>";
	echo 	"<td>".$user["name"]."</td>";
	echo 	"<td>".$user["surname"]."</td>";
	echo 	"<td>".$user["email"]."</td>";
	echo 	"<td>".$user["pseudo"]."</td>";
	echo 	"<td>".$user["password"]."</td>";
	echo 	"<td>".$user["birthdate"]."</td>";
	echo 	"<td>".$user["creation_date"]."</td>";
	echo 	"<td>".$user["last_modification_date"]."</td>";
	echo 	"<td>".$user["status"]."</td>";
	echo "</tr></table>";

}

selectAllUsers($db);
// $derniermembre = stripslashes(htmlspecialchars($donnees['pseudo']));



$query->CloseCursor();
?>
</div>

<?php
include("includes/footer.php");
?>
