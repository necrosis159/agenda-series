<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/check_admin.php";

   // Déclaration des paramètres de la pagination
   $rows = 5;
   $table = "user";
   $status_table = "status_user";

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


   $message = "Une erreur est survenue!";

   if(isset($_GET['delete']) && $_GET['delete'] != false) {
      valid_message("Utilisateur suspendu!");
   }
   elseif(isset($_GET['delete']) && $_GET['delete'] == false) {
      error_message($message);
   }

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Gestion des utilisateurs</h1>

      <a class="button" href="manage_admin_add_user.php">Ajouter un utilisateur</a>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Pseudo</th>
               <th>Mail</th>
               <th class="th_small">Statut</th>
               <th class="th_small">Inscription</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if($data != false):
                  foreach($data as $value):
                     $id_user = $value["id"];
            ?>
               <tr>
                  <td><span style="color: #d8871e;"># </span><?php echo $value["id"]; ?></td>
                  <td><?php echo $value['username']; ?></td>
                  <td><?php echo $value['email']; ?></td>
                  <td><?php echo $value['status_name']; ?></td>
                  <td><?php if(isset($value['creation_date']) && $value['creation_date'] != 00-00-0000) { echo date_convert($value['creation_date']); }  else { echo "&mdash;"; } ?></td>
                  <td class="table_mod">
                     <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/admin/manage_admin_edit_user.php?id=<?php echo $id_user; ?>">
                        <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" alt="Modifier" />
                     </a>
                  </td>
               </tr>
            <?php
                  endforeach;
               else:
            ?>
               <tr>
                  <td colspan="6">Vous n'avez ajouté aucun épisode</td>
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
                  &nbsp; <a href="manage_admin_users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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
