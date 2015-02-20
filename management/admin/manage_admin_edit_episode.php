<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   // Récupération de l'épisode
   if(isset($_GET['id'])) {
      $id = $_GET['id'];

      if(!check_record($id, "episode")) {
         header('Location: manage_admin_series.php?error_exists=true');
      }
   }

   // Récupération des statuts
   $status_data = get_status();

   // Initialisation du message d'erreur
   $message = "Une erreur s'est produite!";

   if(isset($_POST['submit'])) {

      $check_number = (check_number($_POST['season_id'], "id_season", $_POST['number'], "episode"));

      if($check_number != false) {

         if($_POST['old_number'] == $check_number['number']) {

            $result_update = false;

            $id_user = $_SESSION['id'];

            // Récupération des champs
            $name = $_POST["name"];
            $number = $_POST["number"];
            $rewrite = $_POST["rewrite"];
            $status = $_POST["status"];
            $short_description = $_POST["short_description"];
            $summary = $_POST["summary"];

            // Ajout du contenu
            $result_update = update_episode($id, $name, $number, $rewrite, $status, $short_description, $summary);
         }
         else {
            error_message("Le numéro d'épisode existe déjà pour cette saison!");
         }
      }
      else {

         $result_update = false;

         $id_user = $_SESSION['id'];

         // Récupération des champs
         $name = $_POST["name"];
         $number = $_POST["number"];
         $rewrite = $_POST["rewrite"];
         $status = $_POST["status"];
         $short_description = $_POST["short_description"];
         $summary = $_POST["summary"];

         // Ajout du contenu
         $result_update = update_episode($id, $name, $number, $rewrite, $status, $short_description, $summary);
      }
   }

   // Récupération des données de l'épisode
   $data = get_episode($id);

   $season_data = get_season($data['id_season']);
   $serie_data = get_serie($season_data['id_serie']);

   if(isset($result_update) && $result_update != false) {
      valid_message("Modifications enregistrées!");
   }
   elseif(isset($result_update) && $result_update == false) {
      error_message($message);
   }

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Modification d'un épisode : "Episode <?php echo $data['number']; ?>" de "<?php echo $serie_data['name']; ?>" dans "<?php echo $season_data['name']; ?>"</h1>

      <a class="button" href="manage_admin_episodes.php?id_season=<?php echo $season_data['id']; ?>">Retour à la liste des épisodes de la saison <?php echo $season_data['number']; ?> de <?php echo $serie_data['name']; ?></a>

      <form id="article_form" method="POST" enctype='multipart/form-data'>

         <input name="season_id" type="hidden" value="<?php echo $season_data['id']; ?>">

         <input name="old_number" type="hidden" value="<?php if(isset($_POST['old_number'])) { echo $_POST['old_number']; } else { echo $data['number']; } ?>">

         <div>
            <label>Nom
               <input id="name" name="name" type="text" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } else { echo $data['name']; } ?>" placeholder="Nom de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>Numéro
               <input id="number" name="number" type="text" size="30" value="<?php if(isset($_POST['number'])) { echo $_POST['number']; } else { echo $data['number']; } ?>" placeholder="Numéro de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>URL
               <input id="rewrite" name="rewrite" type="text" value="<?php if(isset($_POST['rewrite'])) { echo $_POST['rewrite']; } else { echo $data['rewrite']; } ?>" placeholder="URL de réécriture" required="required">
            </label>
         </div>

         <div>
            <label>Statut
               <select name="status" onchange="updated(this)">
                  <?php foreach($status_data as $value) : ?>
                     <option value="<?php echo $value['id'] ?>" <?php if((isset($_POST['status']) && $_POST['status'] == $value['id']) || (isset($data['status']) && $data['status'] == $value['id'])) { echo "selected"; } ?>><?php echo $value['name'] ?></option>
                  <?php endforeach; ?>
               </select>
            </label>
         </div>

         <div>
            <label>Description rapide
               <input id="short_description" name="short_description" type="text" value="<?php if(isset($_POST['short_description'])) { echo $_POST['short_description']; } else { echo $data['description']; } ?>" placeholder="Description rapide de l'épisode">
            </label>
         </div>

         <div>
            <label>Résumé
               <textarea class="wysiwyg" id="summary" name="summary"><?php if(isset($_POST['summary'])) { echo $_POST['summary']; } else { echo $data['summary']; } ?></textarea>
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
