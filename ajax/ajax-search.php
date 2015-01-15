<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/functions.php";

//$query = $db->prepare("SELECT * FROM serie s
//                       WHERE s.name LIKE :name
//                       ");
//$query->execute(array("name"=>"%".$_GET['q']."%"));
$name = $_GET["q"];
$result = searchSeries($name);
if(count($result) == 0) {
  echo "coucou";
}
// foreach ($query as $data) {
// 	echo "<div class='serie_user'>";
// 	echo "<img src='images/".$data['image']."'class='image_serie'>";
// 	echo "</div>";
// }
while($data  = $result->fetch()) {
	echo "<div class='serie_user'>";
	echo "<img src='../images/".$data['image']."' class='image_serie'>";
	echo "</div>";
}
$result->closeCursor();
?>
