<div class="wrap">
   <section id="manage">
      <h1 class="heading">Recherche</h1>

      <form action="" method="GET" id="article_form" class="search adm_search">
         Type :
         <select name="type" required>
            <option <?php if($oldType == "") { echo "selected"; } ?> value="">- Sélectionnez une option -</option>
            <option <?php if($oldType == "serie") { echo "selected"; } ?> value="serie">Série</option>
            <option <?php if($oldType == "episode") { echo "selected"; } ?> value="episode">Episode</option>
            <option <?php if($oldType == "user") { echo "selected"; } ?> value="user">Utilisateur</option>
            <option <?php if($oldType == "comment") { echo "selected"; } ?> value="comment">Commentaire</option>
         </select><br>
         <p>Titre/Nom :</p> <input name="title" type="text" placeholder="Entrez un titre" value="<?php echo $oldTitle; ?>">
         <p>Date/Inscription :</p> <input name="date" type="date" value="<?php echo $oldDate; ?>">

         <!-- S'il y a du contenu on affiche le nombre de résultats -->
         <?php if($content != ""): ?>
            <p>
               Il y a <?php echo count($content); if(count($content) > 1) { echo " résultats "; } else { echo " résultat "; }?> pour votre recherche.
            </p>
         <?php endif; ?>
            <input type="submit" value="Rechercher">
         </p>
      </form>

      <?php if($content != ""): ?>
         <table class="heavyTable">
            <thead>
               <tr>
                  <th class="th_small">ID</th>
                  <?php if($oldType == "episode" || $oldType == "comment"): ?>
                     <th>Série</th>
                     <th class="th_small">Saison</th>
                     <th class="th_small">N° Episode</th>
                  <?php endif; ?>

                  <?php if($oldType == "user"): ?>
                     <th>Pseudo</th>
                  <?php elseif($oldType == "episode"): ?>
                     <th>Episode</th>
                  <?php elseif($oldType == "comment"): ?>
                     <th>Posté par</th>
                  <?php else: ?>
                     <th>Titre</th>
                  <?php endif; ?>

                  <?php if($oldType == "user"): ?>
                     <th>Inscription</th>
                  <?php else: ?>
                     <th>Date publication</th>
                  <?php endif; ?>

                  <th class="th_small">Actions</th>
               </tr>
            </thead>

            <tbody id="result_table">
               <?php if(count($content) > 0):
                  foreach($content as $value): ?>
                  <tr>
                     <td><span style="color: #d8871e;">#</span><?php echo $value[$oldType . '_id'] ?></td>
                     <?php if($oldType == "episode" || $oldType == "comment"): ?>
                        <td><?php echo $value['serie_name'] ?></td>
                        <td><?php echo "Saison " . $value['season_number'] ?></td>
                        <td><?php echo $value['episode_number'] ?></td>
                     <?php endif; ?>
                     <td>
                        <?php
                        if($oldType != "comment" && $oldType != "user") {
                           if($value[$oldType . '_name'] != "") {
                              echo $value[$oldType . '_name'];
                           }
                           else {
                              echo "<span style='color: red;'>Aucune information disponible<span style='color: red;'>";
                           }
                        }
                        // elseif($oldType == "user") {
                        //       echo $value[$oldType . '_username'];
                        // }
                        else {
                           echo $value['user_username'];
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
                        }
                        elseif($oldType == "user") {
                           echo $this->dateConvert($value['user_creation_date']);
                        } ?>
                     </td>
                     <td class="table_mod">
                        <?php if($oldType != "user"): ?>
                           <a href="
                           <?php if($oldType == "serie") {
                              echo "/serie/" . $value['serie_id'];
                           }
                           elseif($oldType == "episode") {
                              echo "/serie/" . $value['serie_id'] . "/Saison" . $value['season_number'] . "/Episode" . $value['episode_number'];
                           }
                           elseif($oldType == "comment") {
                              echo "/serie/" . $value['serie_id'] . "/Saison" . $value['season_number'] . "/Episode" . $value['episode_number'] . "#" . $value['comment_id'];
                           } ?>">
                              <img class="tab_icons" src="../images/files.png" title="Voir sur le site" alt="Consulter" />
                           </a>
                        <?php endif; ?>

                        <?php if($oldType == "comment"): ?>
                           <a href="/admin/comment/edit/<?php echo $value['comment_id'] ?>">
                              <img class="tab_icons" src="../images/manage_edit.png" title="Modifier le commentaire" alt="Modifier" />
                           </a>
                        <?php elseif($oldType == "user"): ?>
                           <a href="/admin/user/edit/<?php echo $value['user_id'] ?>">
                              <img class="tab_icons" src="../images/manage_edit.png" title="Modifier l'utilisateur" alt="Modifier" />
                           </a>
                        <?php endif; ?>

                     <?php elseif($oldType == "serie"):
                              if($value['serie_highlighting'] == 1): ?>
                                 <a href="#">
                                    <img class="tab_icons" src="../images/highlight-red.png" title="Ne plus mettre en avant" alt="Désactiver" />
                                 </a>
                              <?php else: ?>
                                 <a href="#">
                                    <img class="tab_icons" src="../images/highlight-green.png" title="Mettre en avant" alt="Activer" />
                                 </a>
                              <?php endif; ?>
                        <?php endif; ?>
                     </td>
                  </tr>
               <?php endforeach; else: ?>
                  <td style="padding-top: 6px;" colspan="6">Aucun résultat</td>
               <?php  endif; ?>
            </tbody>
         </table>

         <!-- Affichage du chargement supplémentaire de résultats s'il y en a et qu'il y en a plus que le nombre d'affichage de base -->
         <?php if(count($content) > 0 && count($content) > 5): ?>
            <p style="text-align: center;">
               <button class="button" id="loadMore">Charger plus</button>
            </p>
            <br>
         <?php endif; ?>

      <?php endif; ?>
   </section>
</div>

<script src="/js/admin/loadMore.js"></script>
