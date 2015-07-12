<div class="wrap">
   <div class="last_posts">
      <!-- Début des dernières séries ajoutées -->
      <h5 class="heading">Séries mise en avant</h5>
      <div class="l-grids">
         <?php 
            $temp = null; //Permet d'intervertir entre les deux CSS (Vert, Orange)
            $i = 1;
            foreach ($serieHightlight as $value){
                  if($i%2==0)
                     $temp = "";
                  else
                     $temp = "l-grid-2";

                  $i += 1;
                  
                  echo '<div class="l-grid-1 '.$temp.'" style="margin-top: 10px;"> <div class="desc">';
                  echo '<a href="/serie/'.$value->getId().'" target="_BLANK">';
                  echo "<h3>".$value->getName()."</h3>";
                  echo "<span> ".$serieInfo[$value->getId()]["seasonNB"]." saisons - ".$serieInfo[$value->getId()]["episodeNB"]." episodes</span>";
                  echo "<p>".mb_substr($value->getOverview(), 0, 200, "utf-8")."...</p>";
                  echo '</a>';
                  echo "</div><a href='/serie/".$value->getId()."' target='_BLANK'><img style='height:443px;' src='".$value->getImage()."'></a><div class='clear'> </div> </div>";
            }
         ?>
      </div>
   </div>
   <div class="last_comments">
      <!-- start last_posts -->
      <h5 class="heading" style="margin-top: 100px;">Commentaires mis en avant</h5>

      <?php
         $tempContent = "first_grid"; //Permet d'intervertir entre les deux CSS (grid 1 / grid 2)
         $tempImage = "img_1"; //Permet d'intervertir entre les deux CSS (image gauche/droite)
         $i = 1;
         foreach ($commentaireHightlight as $value){
            if($i%2==0){
                  $tempContent = "first_grid";
                  $tempImage = "img_1";
            }
            else{
               $tempContent = "first_grid_2";
               $tempImage = "img_2";
            }      

               $i++;

               echo  '<div class="grids">';
               echo     '<div class="'.$tempContent.'">';
               echo        "<h3>".$value->getTitle()."</h3>";
               echo        "<p>".$value->getContent()."</p>";
               echo     "</div>";
               echo     '<div class="'.$tempImage.'">
                           <img height="128" src="/images/'.$userAvatar[$value->getId_user()]["avatar"].'">
                        </div>
                        <div class="clear"> </div>
                     </div>';
         }               
      ?>
   </div>
</div>