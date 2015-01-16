<?php
  include"tpl/header.php";
  session_destroy();

  if ($id == 0) error(ERR_IS_NOT_CO);
  header('Location: index.php');
?>