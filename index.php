<?php

   include './tpl/top.php';

?>

<div class="last_posts">
   <!-- Début des dernières séries ajoutées -->
   <div class="wrap">
      <h5 class="heading">Dernières séries ajoutées</h5>
      <div class="l-grids">
         <div class="l-grid-1">
            <div class="desc">
               <h3>The Flash</h3>
               <span>Saison 2 - Episode 12</span>
               <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
            </div>
            <img src="images/the_flash.jpg">
            <div class="clear"> </div>
         </div>
         <div class="l-grid-1 l-grid-2">
            <div class="desc">
               <h3>Arrow</h3>
               <?php selectAllUsers($db); ?>
               <span>Saison 3 - Episode 11</span>
               <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
            </div>
            <img src="images/arrow.jpg">
            <div class="clear"> </div>
         </div>
         <div class="clear"> </div>
      </div>
   </div>
</div>

<div class="last_comments">
   <!-- start last_posts -->
   <div class="wrap">
      <h5 class="heading">Derniers commentaires</h5>
      <div class="grids">
         <div class="first_grid">
            <h3>A propos de The Walking dead</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
         </div>
         <div class="img_1">
            <img src="images/avator.png">
         </div>
         <div class="clear"> </div>
      </div>
      <div class="grids">
         <div class="img_2">
            <img src="images/avator.png">
         </div>
         <div class="first_grid_2">
            <h3>The Flash WTF ?!</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
         </div>
         <div class="clear"> </div>
      </div>
   </div>
</div>

<?php

   include './tpl/footer.php';

?>
