<?php
   include './tpl/top.php';
   $seriesHightlight = series_get_hightlight();
?>

<div class="last_posts">
   <!-- Début des dernières séries ajoutées -->
   <div class="wrap">
      <h5 class="heading">Dernières séries ajoutées</h5>
      <div class="l-grids">
         <?php 
            $temp = null;
            $i = 1;
            while($donnees = $seriesHightlight->fetch()){
               echo '<div class="l-grid-1 '.$temp.'" style="margin-top: 10px;"> <div class="desc">';
               echo "<h3>".$donnees['name']."</h3>";
               echo "<span>".$donnees['nb_season']." saisons - ".$donnees['nb_episode']." episodes</span>";
               echo "<p>".$donnees['short_description']."</p>";
               echo "</div><img src='images/series/vignette_".$donnees['image']."'><div class='clear'> </div> </div>";
               if($i%2==0){
                  if($temp != "l-grid-2")
                     $temp = null;
                  else
                     $temp = "l-grid-2";
                  continue;
               }

               if($temp != "l-grid-2")
                  $temp = "l-grid-2";
               else
                  $temp = null;
               $i++;
            }
         ?>
      </div>
   </div>
</div>

<div style="clear:both;" class="last_comments">
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
