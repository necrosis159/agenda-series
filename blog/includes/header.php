<!DOCTYPE html>
<html>
	<head>
<?php
		echo (!empty($title))?'<title>'.$title.'</title>':'<title> Agenda-Serie </title>';
?>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/styles.css" media="screen" />
	</head>
	<body>
<?php

//Attribution des variables de session
$id=(isset($_SESSION['id'])) ? (int) $_SESSION['id'] : 0;
$pseudo=(isset($_SESSION['pseudo'])) ? $_SESSION['pseudo'] : '';

include("./includes/functions.php");
include("./includes/constants.php");
?>