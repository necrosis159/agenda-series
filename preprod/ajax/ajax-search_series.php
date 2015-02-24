<?php 
include $_SERVER['DOCUMENT_ROOT']."/tpl/functions.php";

$name = $_GET["q"];
$result = searchSeries($name);

if(count($result) == 0) {
  echo "Aucune série n'a été trouvé pour la recherche '".$_GET['q'].".";
}
while($data  = $result->fetch()) {
	$test= $data['image'];
	echo "<div class='sticker'>";
	echo "<a href='../series/serie_detail.php?id=".$data['ID']."'><img src=../images/series/vignette_".$test."></a>";
	echo "</div>";
}
$result->closeCursor();

?>