<?php 
include $_SERVER['DOCUMENT_ROOT']."/tpl/functions.php";

$comment = $_GET["q"];
$idUser = $idUser;
$idSerie= 1;
$idSeason = 1;
$idEpisode = 2;
$notation = 1;
$date = 0;
add_comment($idUser, $idEpisode, $idSeason, $idSerie, $date, $comment, $notation);
?>