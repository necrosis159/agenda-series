<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/functions.php";

$name = $_GET["q"];
$result = searchSeries($name);
if(count($result) == 0) {
  echo "coucou";
}

while($data  = $result->fetch()) {
	echo "<div class='serie_user'>";
	echo "<img src='../images/".$data['image']."' class='image_serie'>";
	echo "</div>";
}
$result->closeCursor();
?>
