<?php
	include("includes/header.php");
	include("includes/menu.php");
	session_destroy();
	$title="Déconnexion";

	if ($id==0) error(ERR_IS_NOT_CO);
  	header('Location: index.php');      
?>