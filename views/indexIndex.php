<div class="last_posts">
   <!-- Début des dernières séries ajoutées -->
   <div class="wrap">
      <h5 class="heading">Séries mise en avant</h5>
      <div class="l-grids">
         <?php 
            $temp = null; //Permet d'intervertir entre les deux CSS (Vert, Orange)
            $i = 1;
            for ($i=1; $i <= 3; $i++) { 
               echo '<div class="l-grid-1 '.$temp.'" style="margin-top: 10px;"> <div class="desc">';
               echo "<h3>Test</h3>";
               echo "<span> 5 saisons - 4 episodes</span>";
               echo "<p>Description</p>";
               echo "</div><img style='height:443px;' src='images/arrow.jpg'><div class='clear'> </div> </div>";
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
               if($i<=2)$i++;
               else $i=100;
            }
         ?>
      </div>
   </div>
</div>
<br>
<div class="last_comments">
   <!-- start last_posts -->
   <div class="wrap">
      <h5 class="heading">Commentaires mis en avant</h5>

      <?php
         $tempContent = "first_grid"; //Permet d'intervertir entre les deux CSS (grid 1 / grid 2)
         $tempImage = "img_1"; //Permet d'intervertir entre les deux CSS (image gauche/droite)
         $i = 1;
               echo  '<div class="grids">';
               echo     '<div class="'.$tempContent.'">';
               echo        "<h3>Titre</h3>";
               echo        "<p>CONTENT</p>";
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
      ?>
   </div>
</div>
