<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   // Récupération de la saison si on est pas passé par l'interface de modification d'une saison
   if(isset($_GET['id'])) {
      $id_season = $_GET['id'];

      if(!check_record($id_season, "season")) {
         header('Location: manage_admin_series.php?error_exists=true');
      }
   }

   // Récupération de la saison
   $season_data = get_season($id_season);

   // Récupération de la série
   $serie_data = get_serie($season_data['id_serie']);

   // Récupération des statuts
   $status_data = get_status();

   // Initialisation du message d'erreur
   $message = "Une erreur s'est produite!";

   if(isset($_POST['submit'])) {

      if(!check_number($id_season, "id_season", $_POST['number'], "episode")) {
         $result_insert = false;

         $id_user = $_SESSION['id'];

         // Récupération des champs
         $name = $_POST["name"];
         $number = $_POST["number"];
         $rewrite = $_POST["rewrite"];
         $status = $_POST["status"];
         $short_description = $_POST["short_description"];
         $summary = $_POST["summary"];

         // Ajout du contenu
         $result_insert = create_episode($id_user, $serie_data['id'], $id_season, $name, $number, $rewrite, $status, $short_description, $summary);
      }
      else {
         error_message("Le numéro d'épisode existe déjà pour cet épisode!");
      }
   }

   if(isset($result_insert) && $result_insert != false) {
      header('Location: manage_admin_episodes.php?id_season=' . $id_season . '&add_episode=true');
   }
   elseif(isset($result_insert) && $result_insert == false) {
      error_message($message);
   }
   elseif(isset($image_error) && $image_error == false) {
      error_message($message);
   }

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Ajout d'un épisode : "<?php echo $serie_data['name']; ?>" dans "<?php echo $season_data['name']; ?>"</h1>

      <a class="button" href="manage_admin_seasons.php?id=<?php echo $season_data['id_serie']; ?>">Retour à la saison <?php echo $season_data['number']; ?> de <?php echo $serie_data['name']; ?></a>

      <form id="article_form" method="POST" enctype='multipart/form-data'>

         <div>
            <label>Nom
               <input id="name" name="name" type="text" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>" placeholder="Nom de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>Numéro
               <input id="number" name="number" type="text" size="30" value="<?php if(isset($_POST['number'])) { echo $_POST['number']; } ?>" placeholder="Numéro de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>URL
               <input id="rewrite" name="rewrite" type="text" value="<?php if(isset($_POST['rewrite'])) { echo $_POST['rewrite']; } ?>" placeholder="URL de réécriture" required="required">
            </label>
         </div>

         <div>
            <label>Statut
               <select name="status" onchange="updated(this)">
                  <?php foreach($status_data as $value) : ?>
                     <option value="<?php echo $value['id'] ?>" <?php if(isset($_POST['status']) && $_POST['status'] == $value['id']) { echo "selected"; } ?>><?php echo $value['name'] ?></option>
                  <?php endforeach; ?>
               </select>
            </label>
         </div>

         <div>
            <label>Description rapide
               <input id="short_description" name="short_description" type="text" value="<?php if(isset($_POST['short_description'])) { echo $_POST['short_description']; } ?>" placeholder="Description rapide de l'épisode">
            </label>
         </div>

         <div>
            <label>Résumé
               <textarea class="wysiwyg" id="summary" name="summary"><?php if(isset($_POST['summary'])) { echo $_POST['summary']; } ?></textarea>
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
