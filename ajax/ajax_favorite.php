<?php 
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/global_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/user_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/series_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/comment_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/front_functions.php';

$idSerie = $_GET["id"];
$idUser = $_SESSION["id"];

add_favorite($idUser, $idSerie, $notation);
/*	$db = call_pdo();

    $query = $db->query("INSERT INTO `agendaserie`.`comment` (`id`, `id_user`, `id_episode`, `id_season`, `id_serie`, `date_publication`, `content`, `notation`) 
    	VALUES (NULL, '1', '1', '1', '1', '2015-01-07', 'Ceciestun test', '1');");*/

?>