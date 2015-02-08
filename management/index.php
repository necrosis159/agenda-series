<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['error_exists']) && $_GET['error_exists'] == true) {
      error_message("Aucun contenu ne possède cet ID!");
   }
   else if(isset($_GET['add_serie']) && $_GET['add_serie'] == true) {
      valid_message("Ajout réussi. Article en attente de validation par un administrateur.");
   }

   $data_comments = last_user_comments($_SESSION['id']);

   $data_articles = last_user_articles($_SESSION['id']);

?>

<div class="wrap">
   <section id="manage">
   	<h1 class="heading">Tableau de bord</h1>

      <h2 class="heading">Mes derniers commentaires</h2>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Série</th>
               <th>Commentaire</th>
               <th class="th_small">Date d'ajout</th>
               <th class="th_small">Statut</th>
               <th class="th_small">Options</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if($data_comments != false):
                  foreach($data_comments as $value):
                     $id_comment = $value["id"];
            ?>
            <tr>
               <td><span style="color: #d8871e;"># </span><?php echo $id_comment; ?></td>
               <td><?php echo $value['title']; ?></td>
               <td><?php echo $value['content']; ?></td>
               <td><?php echo date_convert($value['date_publication']); ?></td>
               <td><?php if($value['status'] == 1) { echo '<img class="tab_icons" src="../images/valid.png" title="Validé" alt="Validé" />'; } else if($value['status'] == 2) { echo '<img class="tab_icons" src="../images/error.png" title="refusé" alt="Refusé" />'; } else { echo '<img class="tab_icons" src="../images/warning.png" title="En attente" alt="En attente" />'; } ?></td>
               <td class="table_mod">
                  <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_view_comment.php?id=<?php echo $id_comment; ?>">
                     <img class="tab_icons" src="../images/magnify.png" alt="Voir" />
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
      <h2 class="heading">Mes derniers ajouts</h2>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Série</th>
               <th class="th_small">Saison</th>
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
                     <td><?php if($value['status'] == 1) { echo '<img class="tab_icons" src="../images/valid.png" title="Validé" alt="Validé" />'; } else if($value['status'] == 2) { echo '<img class="tab_icons" src="../images/error.png" title="refusé" alt="Refusé" />'; } else { echo '<img class="tab_icons" src="../images/warning.png" title="En attente" alt="En attente" />'; } ?></td>
                     <td><?php echo date_convert($value['release_date']); ?></td>
                     <td class="table_mod">
                        <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_edit_article.php?id=<?php echo $id_article; ?>">
                           <img class="tab_icons" src="../images/manage_edit.png" alt="Modifier" />
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
