<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['add_series']) && $_GET['add_series'] == true) {
      valid_message("La série à bien été ajoutée!");
   }
   else if(isset($_GET['error_selected']) && $_GET['error_selected'] == true) {
      error_message("Aucune série n'a été sélectionnée!");
   }
   else if(isset($_GET['error_exists']) && $_GET['error_exists'] == true) {
      error_message("Le contenu n'existe pas!");
   }
   else if(isset($_GET['action']) && $_GET['action'] == "delete") {

      $id = $_GET['id'];

      $check = check_record($id, "serie");

      if($check == true) {
         $result = suspend_serie($id);

         valid_message("La série à été suspendue!");
      }
      else {
         error_message("Le contenu n'existe pas!");
      }
   }

   $data = get_series();

   $data_status = get_status();

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Gestion des séries</h1>

      <a class="button" href="manage_admin_add_series.php">Ajouter une série</a>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Série</th>
               <th>Résumé</th>
               <th class="th_small">Statut</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>

         <tbody>
            <?php
               if($data != false):
                  foreach($data as $value):
                     $id_serie = $value["id"];
            ?>
               <tr>
                  <td><span style="color: #d8871e;"># </span><?php echo $value["id"]; ?></td>
                  <td><?php echo $value['name']; ?></td>
                  <td><?php echo $value['short_description']; ?></td>
                  <td>
                     <?php if($value['status'] == 0) {
                        echo '<span class="color_pending">' . $data_status[0]['name'] . '</span>';
                     }
                     else if($value['status'] == 1) {
                        echo '<span class="color_validate">' . $data_status[1]['name'] . '</span>';
                     }
                     else if($value['status'] == 2) {
                        echo '<span class="color_error">' . $data_status[2]['name'] . '</span>';
                     }
                     else if($value['status'] == 3) {
                        echo '<span class="color_pending">' . $data_status[3]['name'] . '</span>';
                     } ?>
                  </td>

                  <td class="table_mod">
                     <a href="./manage_admin_edit_series.php?id=<?php echo $id_serie; ?>">
                        <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" title="Modifier" alt="Modifier" />
                     </a>
                     &nbsp; &nbsp;
                     <?php if($value['status'] != 3): ?>
                     <a href="./manage_admin_series.php?action=delete&id=<?php echo $id_serie; ?>">
                        <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/trash.png" title="Suspendre" alt="Suspendre" />
                     </a>
                  <?php endif; ?>
                  </td>
               </tr>
            <?php
               endforeach;
               else:
            ?>
               <tr>
                  <td colspan="6">Aucune série n'a été créée</td>
               </tr>
            <?php endif; ?>
         </tbody>
      </table>
   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
