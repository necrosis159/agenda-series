<?php 
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/global_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/user_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/series_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/comment_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/front_functions.php';

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
