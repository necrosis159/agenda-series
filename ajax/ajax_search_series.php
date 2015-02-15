<?php 
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/global_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/user_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/series_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/comment_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/front_functions.php';

$name = $_GET["q"];
$result = series_research($name);

if(count($result) == 0) {
  echo "Aucune série n'a été trouvé pour la recherche '".$_GET['q'].".";
}
while($data  = $result->fetch()) {
	$test= $data['image'];
	echo "<div class='sticker'>";
	echo "<a href='../les-series/".$data['name']."'><img src=../images/series/vignette_".$test."></a>";
	echo "</div>";
}
$result->closeCursor();

?>