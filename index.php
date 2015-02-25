<?php
   include './tpl/top.php';
   $seriesHightlight = series_get_last_published();
   $commentHightlight = series_get_comment_highlight();
?>

<div class="last_posts">
   <!-- Début des dernières séries ajoutées -->
   <div class="wrap">
      <h5 class="heading">Dernières séries ajoutées</h5>
      <div class="l-grids">
         <?php 
            $temp = null; //Permet d'intervertir entre les deux CSS (Vert, Orange)
            $i = 1;
            while($donnees = $seriesHightlight->fetch()){
               echo '<div class="l-grid-1 '.$temp.'" style="margin-top: 10px;"> <div class="desc">';
               echo "<h3>".$donnees['name']."</h3>";
               echo "<span>".$donnees['nb_season']." saisons - ".$donnees['nb_episode']." episodes</span>";
               echo "<p>".$donnees['short_description']."</p>";
               echo "</div><img style='height:443px;' src='images/".$donnees['image']."'><div class='clear'> </div> </div>";
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

<div class="last_comments">
   <!-- start last_posts -->
   <div class="wrap">
      <h5 class="heading">Commentaires mis en avant</h5>

      <?php
         $tempContent = "first_grid"; //Permet d'intervertir entre les deux CSS (grid 1 / grid 2)
         $tempImage = "img_1"; //Permet d'intervertir entre les deux CSS (image gauche/droite)
         $i = 1;
         while($donnees = $commentHightlight->fetch()){
               echo  '<div class="grids">';
               echo     '<div class="'.$tempContent.'">';
               echo        "<h3>".$donnees['title']."</h3>";
               echo        "<p>".$donnees['content']."</p>";
               echo     "</div>";
               echo     '<div class="'.$tempImage.'">
                           <img src="images/avator.png">
                        </div>
                        <div class="clear"> </div>
                     </div>';
               if($i%2==0){
                  if($tempContent != "first_grid_2"){
                     $tempContent = "first_grid";
                     $tempImage = "img_1";}
                  else{
                     $tempContent = "first_grid_2";
                     $tempImage = "img_2";}
                  continue;
               }

               if($tempContent != "first_grid_2"){
                  $tempContent = "first_grid_2";
                  $tempImage = "img_2";}
               else{
                  $tempContent = "first_grid";
                  $tempImage = "img_1";}
               $i++;
            }
      ?>
   </div>
</div>

<?php

   include './tpl/footer.php';

?>
