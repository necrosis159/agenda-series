<?php
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/global_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/front_functions.php';
$comment = $_GET["q"];
$idUser = $_GET["id_User"];
$idEpisode = $_GET['id_episode'];
$notation = 1;
$title = $_GET['name'];
$date = date("Y-m-d");
$status = 0;
//add_comment($idUser, $idEpisode, $title, $date, $comment, $notation, $status);
add_comment($idUser, $idEpisode, $title, $date , $comment, "5", "1");

?>