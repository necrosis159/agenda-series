<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/pdo.php";

$query = $db->prepare("SELECT * FROM serie s
                       WHERE s.name LIKE :name
                       ");
$query->execute(array("name"=>"%".$_GET['q']."%"));
if(count($query) == 0) {
  echo "coucou";
}
// foreach ($query as $data) {
// 	echo "<div class='serie_user'>";
// 	echo "<img src='images/".$data['image']."'class='image_serie'>";
// 	echo "</div>";
// }
while($data  = $query->fetch()) {
	echo "<div class='serie_user'>";
	echo "<img src='../images/".$data['image']."' class='image_serie'>";
	echo "</div>";
}
$query->closeCursor();
?>
