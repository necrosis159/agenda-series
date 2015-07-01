<?php

   if(isset($_SESSION['status'])) {
      if(!check_user_admin($_SESSION['status'])) {
         header('Location: ../index.php');
      }
   }

?>
