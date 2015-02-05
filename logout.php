<?php
  include"tpl/top.php";
  session_destroy();

  if ($id == 0) error_message("Vous n'êtes pas connecté");
  header('Location: index.php');
?>
