<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['error_exists']) && $_GET['error_exists'] == true) {
      error_message("Le contenu n'existe pas!");
   }
   else if(isset($_GET['validate']) && $_GET['validate'] == true) {
      valid_message("Commentaire validé, son contenu est désormais visible sur le site");
   }
   else if(isset($_GET['reject']) && $_GET['reject'] == true) {
      valid_message("Commentaire refusé");
   }
   else if(isset($_GET['action']) && $_GET['action'] == "delete") {

      $id = $_GET['id'];

      $check = check_record($id, "comment");

      if($check == true) {
         $result = suspend_comment($id);

         valid_message("Le commentaire à été suspendu!");
      }
      else {
         error_message("Le contenu n'existe pas!");
      }
   }

   // Déclaration des paramètres de la pagination
   $rows = 5;
   $table = "comment";
   $status_table = "status_article";

   if(isset($_GET['page'])) {
      $current_page = intval($_GET['page']);
   }
   else {
      $current_page = 1; // La page actuelle est la n°1
   }

   // Récupération du nombre de pages
   $pages_number = pagination($rows, $table, $current_page);

   // Récupération des données de la page en fonction
   $data = pagination_data($rows, $current_page, $pages_number, $table, $status_table);

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Liste des commentaires</h1>

      <a class="button" href="manage_admin_moderation_comments.php">Voir les commentaires en attente</a>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Episode</th>
               <th>Commentaire</th>
               <th class="th_small">Date</th>
               <th class="th_small">Statut</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <?php
            if($data != false):
            foreach($data as $value):
            $id_comment = $value["id"];
            ?>
            <tr>
               <td><span style="color: #d8871e;"># </span><?php echo $value["id_user"]; ?></td>
               <td><?php echo $value['title']; ?></td>
               <td><?php echo $value['content']; ?></td>
               <td>
                  <?php if(isset($value['date_publication'])) {
                     echo date_convert($value['date_publication']);
                  } else {
                     echo "Aucune date";
                  } ?>
               </td>
               <td>
                  <?php if($value['status'] == 4): ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/valid.png" title="Validé" alt="Validé">
                  <?php elseif($value['status'] == 5): ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/error.png" title="Refusé" alt="Refusé">
                  <?php else: ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/warning.png" title="En attente" alt="En attente">
                  <?php endif; ?>
               </td>
               <td class="table_mod">
                  <a href="manage_admin_edit_comment.php?id=<?php echo $id_comment; ?>">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" alt="Modifier" />
                  </a>
               <?php if($value['status'] != 2): ?>
                  &nbsp;
                  <a href="manage_admin_comments.php?action=delete&id=<?php echo $id_comment; ?>">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/trash.png" alt="Désactiver" />
                  </a>
               <?php endif; ?>
               </td>
            </tr>
            <?php
            endforeach;
            else:
            ?>
            <tr>
               <td colspan="6">Il n'y a aucun commentaire</td>
            </tr>
         <?php endif; ?>
      </tbody>
   </table>

   <?php if($pages_number > 1): ?>
      <p class="pagination">
         <?php
         for($i = 1; $i <= $pages_number; $i++):
         if($i == $current_page):
         ?>
         <span class="active"><?php echo $i; ?></span>
      <?php else: ?>
         &nbsp; <a href="manage_admin_comments.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
         <?php
         endif;
         endfor;
         ?>
      </p>
   <?php endif; ?>

</section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
