<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['id'])) {
      $id_season = $_GET['id'];

      // Test de l'existance de la série
      if(!$season_data = check_record($id_season, "season")) {
         header('Location: ./index.php?error_exists=true');
      }
   }

   // Récupération des catégories séries
   $category_data = get_categories();

   // Récupération des status
   $status_data = get_status();

   // Initialisation du message d'erreur
   $message = "Une erreur s'est produite!";

   if(isset($_POST['submit'])) {

      $id_user = $_SESSION['id'];

      $result_update = false;

      // Récupération des champs
      $number = $_POST["number"];
      $name = $_POST["name"];
      $description = $_POST["description"];
      $status = $_POST["status"];
      $year_start = $_POST["year_start"];
      $year_end = $_POST["year_end"];
      $rewrite = $_POST["rewrite"];

      // Modification du contenu
      $result_update = update_season($id_season, $number, $name, $description, $status, $year_start, $year_end, $rewrite);
   }

   // Récupéaration des info de la saison après la fonction de mise à jour
   $data = get_season($id_season);

   if(isset($result_update) && $result_update != false) {
      valid_message("Modifications enregistrées!");
   }
   elseif(isset($result_update) && $result_update == false) {
      error_message($message);
   }

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Modification d'une saison : "<?php echo $data['name']; ?>" dans "<?php echo $data['serie']; ?>"</h1>

      <a class="button" href="manage_admin_seasons.php?id=<?php echo $data['id_serie']; ?>">Retour aux saisons de <?php echo $data['serie']; ?></a> <p align="right"><a class="button" href="manage_admin_add_episode.php?id=<?php echo $id_season; ?>">Ajouter un épisode</a>  &nbsp; <a class="button" href="manage_admin_episodes.php?id_season=<?php echo $id_season; ?>">Modifier un épisode</a> &nbsp;</p>

      <form id="article_form" method="POST" enctype='multipart/form-data'>

         <div>
            <label>Nom
               <input id="name" name="name" type="text" value="<?php echo $data['name']; ?>" placeholder="Nom de la série" required="required">
            </label>
         </div>

         <div>
            <label>URL
               <input id="rewrite" name="rewrite" type="text" value="<?php echo $data['rewrite']; ?>" placeholder="URL de réécriture" required="required">
            </label>
         </div>

         <div>
            <label>Numéro de la saison
               <input id="number" name="number" type="text" size="30" value="<?php echo $data['number']; ?>" placeholder="Numéro de la saison" required="required">
            </label>
         </div>

         <div>
            <label>Date de début
               <input type="text" id="year_start" name="year_start" size="30" class="input_form" <?php if($data["year_start"] != 0000): ?> value="<?php echo $data["year_start"]; ?>" <?php endif; ?> placeholder="AAAA" maxlength="4">
               </label>
         </div>

         <div>
            <label>Date de fin
               <input type="text" id="year_end" name="year_end" max="year" size="30" class="input_form" <?php if($data["year_end"] != 0000): ?> value="<?php echo $data["year_end"]; ?>" <?php endif; ?> placeholder="AAAA" maxlength="4">
               </label>
         </div>

         <div>
            <label>Statut
               <select name="status" onchange="updated(this)">
                  <?php foreach($status_data as $value) : ?>
                     <option value="<?php echo $value['id'] ?>" <?php if(isset($data['status']) && $data['status'] == $value['id']) { echo "selected"; } ?>><?php echo $value['name'] ?></option>
                  <?php endforeach; ?>
               </select>
            </label>
         </div>

         <div>
            <label>Description
               <textarea class="wysiwyg" id="description" name="description"><?php echo $data['description']; ?></textarea>
            </label>
         </div>


         <div>
            <input name="submit" type="submit" value="Enregistrer">
         </div>
      </form>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
