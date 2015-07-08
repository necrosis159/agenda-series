<?php

   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/global_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/user_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/series_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/comment_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/front_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/episode_functions.php';
   if(get_directory() == "admin") {
      include $_SERVER['DOCUMENT_ROOT'] . "/tpl/check_admin.php";
   }
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/header.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/menu.php';

?>
