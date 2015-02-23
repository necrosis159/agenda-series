<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['error_exists']) && $_GET['error_exists'] == true) {
      error_message("Le contenu n'existe pas!");
   }
   else if(isset($_GET['validate']) && $_GET['validate'] == true) {
      valid_message("Article validé, son contenu est désormais associé à l'épisode");
   }
   else if(isset($_GET['reject']) && $_GET['reject'] == true) {
      valid_message("Article refusé");
   }

   $data = get_proposals();

   $data_status = get_status();

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Liste des articles</h1>

      <a class="button" href="manage_admin_moderation_articles.php">Voir les articles en attente</a>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th class="th_small">Série</th>
               <th class="th_small">Saison</th>
               <th class="th_small">Episode</th>
               <th class="th_small">Statut</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <?php
            if($data != false):
               foreach($data as $value):
                  $id_article = $value["id"];
                  ?>
                  <tr>
                     <td><span style="color: #d8871e;"># </span><?php echo $value["id"]; ?></td>
                     <td><a href="manage_admin_edit_series.php?id=<?php echo $value['id_serie']; ?>"><?php echo $value['serie']; ?></a></td>
                     <td><?php echo $value['season']; ?></td>
                     <td><?php echo $value['episode']; ?></td>
                     <td>
                        <?php if($value['status'] == 0) {
                           echo '<span class="color_pending">' . $data_status[0]['name'] . '</span>';
                        }
                        else if($value['status'] == 4) {
                           echo '<span class="color_validate">' . $data_status[4]['name'] . '</span>';
                        }
                        else if($value['status'] == 5) {
                           echo '<span class="color_error">' . $data_status[5]['name'] . '</span>';
                        }
                        else if($value['status'] == 3) {
                           echo '<span class="color_pending">' . $data_status[3]['name'] . '</span>';
                        } ?>
                     </td>
                     <td class="table_mod">
                        <a href="manage_admin_edit_article.php?id=<?php echo $id_article; ?>">
                           <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" title="Modérer l'article" alt="Modérer l'article" />
                        </a>
                     </td>
                  </tr>
                  <?php
                  endforeach;
                  else:
                  ?>
                  <tr>
                     <td colspan="8">Il n'y a aucun article</td>
                  </tr>
               <?php endif; ?>
            </tbody>
         </table>

      </section>
   </div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>