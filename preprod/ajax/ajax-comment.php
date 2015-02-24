<?php 
include $_SERVER['DOCUMENT_ROOT']."/tpl/functions.php";

$comment = $_GET["q"];
$idUser = $_SESSION["id"];
$idSerie= $id_Serie;
$idSeason = 1;
$idEpisode = 1;
$notation = 1;
$date = 0;
add_comment($idUser, $idEpisode, $idSeason, $idSerie, $date, $comment, $notation);

/*	$db = call_pdo();

    $query = $db->query("INSERT INTO `agendaserie`.`comment` (`id`, `id_user`, `id_episode`, `id_season`, `id_serie`, `date_publication`, `content`, `notation`) 
    	VALUES (NULL, '1', '1', '1', '1', '2015-01-07', 'Ceciestun test', '1');");*/

?>