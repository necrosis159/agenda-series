<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['id_season'])) {
      $id_season = $_GET['id_season'];

      if(!check_record($id_season, "season")) {
         header('Location: manage_admin_series.php?error_exists=true');
      }
      else {
         $season_data = get_season($id_season);
         $serie_data = get_serie($season_data['id_serie']);
      }
   }
   else {
      header('Location: manage_admin_series.php?error_selected=true');
   }

   if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == "delete") {

      $id_episode = $_GET['id'];

      $check = check_record($id_episode, "episode");

      if($check == true) {
         $result = suspend_episode($id_episode);

         valid_message("L'épisode à été suspendu!");
      }
   }

   if(isset($_GET['add_episode']) && $_GET['add_episode'] == true) {
      valid_message("L'épisode à bien été ajouté!");
   }

   $data = get_season_episodes($id_season);

   $data_status = get_status();

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Gestion des épisodes : "saison <?php echo $season_data['number']; ?>" dans "<?php echo $serie_data['name']; ?>"</h1>

      <a class="button" href="manage_admin_add_episode.php?id=<?php echo $id_season; ?>">Ajouter un épisode</a> &nbsp; <a class="button" href="manage_admin_seasons.php?id=<?php echo $serie_data['id']; ?>">Retour aux saisons de <?php echo $serie_data['name']; ?></a>

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
            $id_episode = $value["id"];
            ?>
            <tr>
               <td><span style="color: #d8871e;"># </span><?php echo $id_episode; ?></td>
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
                  <a href="./manage_admin_edit_episode.php?id=<?php echo $id_episode; ?>">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" title="Modifier" alt="Modifier" />
                  </a>
                  &nbsp; &nbsp;
                  <?php if($value['status'] != 3): ?>
                     <a href="./manage_admin_episodes.php?id=<?php echo $id_episode; ?>&id_season=<?php echo $id_season; ?>&action=delete">
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
               <td colspan="6">Cette série ne possède pas encore d'épisodes</td>
            </tr>
         <?php endif; ?>
      </tbody>
   </table>
</section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
