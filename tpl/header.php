<?php

   session_start() ;
   $id = (isset($_SESSION["id"])) ? (int) $_SESSION["id"] : 0;

   // Sécurité : vérification des informations du compte pour l'accès aux pages utilisateur

   // Récupération du dossier courant
   $directory = get_directory();

   if($directory == "/account" || $directory == "/management") {

      if(isset($_SESSION["id"])) {
         check_user($_SESSION['id'], $directory);
      } else {
         // Redirige vers la page d'inscription avec une erreur
         header('Location: login.php?error=log');
      }
   }
   
?>
<!DOCTYPE html>

<html>

   <head>
      <title>Agenda-Série.fr - </title>

      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
      <link href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/css/styles.css" rel="stylesheet" type="text/css" media="all" />

      <link type="text/css" rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/css/jquery.mmenu.all.css" />
      <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/js/jquery.min.js"></script>
      <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/js/jquery.mmenu.js"></script>
      <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/js/script.js"></script>

      <script type="text/javascript">
      //	Menu mobile
      $(function() {
         $('nav#menu-left').mmenu();
      });
      </script>

	<!-- Ajout de l'interface wysiwyg (TinyMCE) -->
      <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/tinymce/tinymce.min.js"></script>
      <script type="text/javascript">
      tinymce.init({
         language : "fr_FR",
         selector: "textarea"
      });
      </script>
   </head>

   <body>
