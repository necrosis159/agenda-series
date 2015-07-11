<div class="wrap">
   <section id="manage">
      <h1 class="heading">Recherche</h1>

      <form action="" method="GET" id="article_form" class="search adm_search">
         <p>Titre:</p> <input name="title" type="text" placeholder="Entrez un titre" value="<?php echo $oldTitle; ?>">
         <p>Date:</p> <input name="date" type="date" value="<?php echo $oldDate; ?>">
            Type:
            <select name="type">
               <option <?php if($oldType == "default") { echo "selected"; } ?> value="default">- Sélectionnez une option -</option>
               <option <?php if($oldType == "serie") { echo "selected"; } ?> value="serie">Série</option>
               <option <?php if($oldType == "episode") { echo "selected"; } ?> value="episode">Episode</option>
               <option <?php if($oldType == "comment") { echo "selected"; } ?> value="comment">Commentaire</option>
            </select>
            <p>
               Il y a <?php echo count($content); if(count($content) > 1) { echo " résultats "; } else { echo " résultat "; }?> pour votre recherche.
            </p>
            <input type="submit" value="Rechercher">
         </p>
      </form>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Titre</th>
               <th class="th_small">Date publication</th>
               <th class="th_small">Actions</th>
            </tr>
         </thead>

         <tbody>
            <?php if(count($content) > 0):
               foreach($content as $value): ?>
               <tr>
                  <td><span style="color: #d8871e;">#</span><?php echo $value[$oldType . '_id'] ?></td>
                  <td>
                     <?php
                     if($oldType != "comment") {
                        if($value[$oldType . '_name'] != "") {
                           echo $value[$oldType . '_name'];
                        }
                        else {
                           echo "<span style='color: red;'>Aucun titre n'est disponible<span style='color: red;'>";
                        }
                     }
                     else {
                        echo $value['comment_title'];
                     }
                      ?>
                  </td>
                  <td>
                     <?php if($oldType == "serie") {
                        echo $this->dateConvert($value['serie_first_air_date']);
                     }
                     elseif($oldType == "episode") {
                        echo $this->dateConvert($value['episode_air_date']);
                     }
                     elseif($oldType == "comment") {
                        echo $this->dateConvert($value['comment_date_publication']);
                     } ?>
                  </td>
                  <td class="table_mod">
                     <a href="#">
                        <img class="tab_icons" src="../images/files.png" title="Consulter" alt="Consulter" />
                     </a>
                     <?php if($oldType == "comment"): ?>
                        <a href="#">
                           <img class="tab_icons" src="../images/manage_edit.png" title="Modifier" alt="Modifier" />
                        </a>
                     <?php endif; ?>
                  </td>
               </tr>
            <?php endforeach; else: ?>
               <td style="padding-top: 6px;" colspan="6">Aucun résultat</td>
            <?php  endif; ?>
         </tbody>
      </table>
   </section>
</div>
