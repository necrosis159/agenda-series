<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   $data_comments = last_user_comments($_SESSION['id']);

   $data_articles = last_user_articles($_SESSION['id']);

?>

<div class="wrap">
   <section id="manage">
   	<h5 class="heading">Mes derniers commentaires</h5>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Série</th>
               <th>Mon commentaire</th>
               <th class="th_small">Date</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if($data_comments != false):
                  foreach($data_comments as $value):
                     $id_comment = $value["id_user"];
            ?>
            <tr>
               <td><span style="color: #d8871e;"># </span><?php echo $value["id_user"]; ?></td>
               <td><?php echo $value['title']; ?></td>
               <td><?php echo $value['content']; ?></td>
               <td><?php echo date_convert($value['date_publication']); ?></td>
               <td class="table_mod">
                  <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_edit_comment.php?id=<?php echo $id_comment; ?>">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" alt="Modifier" />
                  </a>
                  <a href="#">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_remove.png" alt="Supprimer" />
                  </a>
               </td>
            </tr>
            <?php
               endforeach;
               else:
            ?>
            <tr>
               <td colspan="5">Aucune entrée récente</td>
            </tr>
            <?php endif; ?>
         </tbody>
      </table>

   </section>

   <section id="account">
      <h5 class="heading">Mes derniers ajouts</h5>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Série</th>
               <th class="th_small">N° Episode</th>
               <th class="th_small">Episode</th>
               <th class="th_small">Statut</th>
               <th class="th_small">Date d'ajout</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <?php
            if($data_articles != false):
               foreach($data_articles as $value):
                  $id_article = $value["id"];
                  ?>
                  <tr>
                     <td><span style="color: #d8871e;"># </span><?php echo $value["id"]; ?></td>
                     <td><?php echo $value['serie_name']; ?></td>
                     <td><?php echo $value['name']; ?></td>
                     <td><?php echo $value['number']; ?></td>
                     <td><?php if($value['status'] == 0) { echo '<span class="color_pending">En attente</span>'; } elseif($value['status'] == 1) { echo '<span class="color_validate">Validé</span>'; } else { echo '<span class="color_error">Refusé</span>'; } ?></td>
                     <td><?php echo date_convert($value['release_date']); ?></td>
                     <td class="table_mod">
                        <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_edit_article.php?id=<?php echo $id_article; ?>">
                           <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" alt="Modifier" />
                        </a>
                     </td>
                  </tr>
                  <?php
               endforeach;
            else:
               ?>
               <tr>
                  <td colspan="7">Aucune entrée récente</td>
               </tr>
            <?php endif; ?>
         </tbody>
      </table>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
