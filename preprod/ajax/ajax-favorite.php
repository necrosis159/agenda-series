<?php 
include $_SERVER['DOCUMENT_ROOT']."/tpl/functions.php";

$idSerie = $_GET["id"];
$idUser = $_SESSION["id"];

add_favorite($idUser, $idSerie, $notation);
/*	$db = call_pdo();

    $query = $db->query("INSERT INTO `agendaserie`.`comment` (`id`, `id_user`, `id_episode`, `id_season`, `id_serie`, `date_publication`, `content`, `notation`) 
    	VALUES (NULL, '1', '1', '1', '1', '2015-01-07', 'Ceciestun test', '1');");*/

?>