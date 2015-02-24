<?php

   if(isset($_SESSION['status'])) {
      if(!check_user_editor($_SESSION['status'])) {
         header('Location: ../index.php');
      }
   }

?>
