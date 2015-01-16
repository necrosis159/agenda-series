<?php 
include "tpl/pdo.php";
$queryIdUser = $bdd->prepare("SELECT `ID` FROM `users` WHERE `pseudo`=:pseudo");
$queryIdUser->execute(array("pseudo"=>"necrosis"));
$data = $queryIdUser->fetch();
$idUser = $data[0];

$queryInsertComment = $bdd -> prepare("INSERT INTO `agendaserie`.`comments` (`id`, `idUser`, `idEpisode`, `idSeason`, `idSerie`, `date`, `comment`, `notation`) VALUES (NULL, :idUser, '1', '1', '1', '2015-01-01', :comment, '1');");
$queryInsertComment->execute(array("idUser"=>$idUser, "comment"=>$_GET['comment']));


$queryIdUser->closeCursor();
//$queryInsertComment->closeCursor();

?>