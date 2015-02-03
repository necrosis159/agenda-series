<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   // Récupération des utilisateur du site
   $data = users_list();

   $message = "";

   if(isset($_GET['delete']) && $_GET['delete'] != false) {
      valid_message($message = "Utilisateur supprimé!");
   }
   elseif(isset($_GET['delete']) && $_GET['delete'] == false) {
      error_message($message);
   }

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Liste des utilisateurs</h5>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Pseudo</th>
               <th class="th_small">Statut</th>
               <th>Mail</th>
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
                  <td><?php echo $value['surname']; ?></td>
                  <td><?php if($value['status'] == 1) { echo "Utilisateur"; } elseif($value['status'] == 2) { echo "Contributeur"; } elseif($value['status'] == 3) { echo "Administrateur"; } ?></td>
                  <td><?php echo $value['email']; ?></td>
                  <td><?php if(isset($value['creation_date']) && $value['creation_date'] != 00-00-0000) { echo date_convert($value['creation_date']); }  else { echo "&mdash;"; } ?></td>
                  <td class="table_mod">
                     <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_edit_user.php?id=<?php echo $id_user; ?>">
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

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
