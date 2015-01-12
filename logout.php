<?php
	include"tpl/header.php";
	include"tpl/menu.php";
	session_destroy();
	$title="Déconnexion";

	if ($id==0) error(ERR_IS_NOT_CO);
  	header('Location: index.php');      
?>