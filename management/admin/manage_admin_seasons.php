<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['id'])) {
      $id_serie = $_GET['id'];

      if(!check_record($id_serie, "serie")) {
         header('Location: manage_admin_series.php?error_exists=true');
      }
      else {
         $serie_data = get_serie($id_serie);
      }
   }
   else {
      header('Location: manage_admin_series.php?error_selected=true');
   }

   if(isset($_GET['id_season']) || isset($_GET['action'])) {
      $id_season = $_GET['id_season'];

      if(!check_record($id_season, "season")) {
         header('Location: manage_admin_series.php?error_exists=true');
      }
   }

   if(isset($_GET['add_series']) && $_GET['add_series'] == true) {
      valid_message("La série à bien été ajoutée!");
   }
   else if(isset($_GET['add_season']) && $_GET['add_season'] == true) {
      valid_message("La saison à bien été ajoutée!");
   }
   else if(isset($_GET['id_season']) && isset($_GET['action']) && $_GET['action'] == "delete") {

      $id_season = $_GET['id_season'];

      $check = check_record($id_season, "season");

      if($check == true) {
         $result = suspend_season($id_season);

         valid_message("La saison à été suspendue!");
      }
   }

   $data = get_series_seasons($id_serie);

   $data_status = get_status();

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Gestion des saisons de "<?php echo $serie_data['name']; ?>"</h1>

      <a class="button" href="manage_admin_add_season.php?id=<?php echo $id_serie; ?>">Ajouter une saison</a> &nbsp; <a class="button" href="manage_admin_edit_series.php?id=<?php echo $id_serie; ?>">Retour à la série <?php echo $serie_data['name']; ?></a>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Saison</th>
               <th>Description</th>
               <th class="th_small">Statut</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>

         <tbody>
            <?php
            if($data != false):
               foreach($data as $value):
               $id_season = $value["id"];
               ?>
               <tr>
                  <td><span style="color: #d8871e;"># </span><?php echo $id_season; ?></td>
                  <td><?php echo $value['name']; ?></td>
                  <td><?php echo $value['description']; ?></td>
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
                     <a href="./manage_admin_edit_season.php?id=<?php echo $id_season; ?>">
                        <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" title="Modifier" alt="Modifier" />
                     </a>
                     &nbsp; &nbsp;
                     <a href="./manage_admin_episodes.php?id_season=<?php echo $id_season; ?>">
                        <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/files.png" title="Voir les épisodes" alt="Voir les épisodes" />
                     </a>
                     &nbsp; &nbsp;
                     <?php if($value['status'] != 3): ?>
                        <a href="./manage_admin_seasons.php?id=<?php echo $id_serie; ?>&id_season=<?php echo $id_season; ?>&action=delete">
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
                  <td colspan="6">Cette série ne possède pas encore de saisons</td>
               </tr>
            <?php endif; ?>
         </tbody>
      </table>
   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
