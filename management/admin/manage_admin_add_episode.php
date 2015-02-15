<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   // Récupération de la saison si on est pas passé par l'interface de modification d'une saison
   if(isset($_GET['id'])) {
      $id_season = $_GET['id'];

      if(!$season_data = get_season($id_season)) {
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

      $result_insert = false;

      $id_user = $_SESSION['id'];

      // Récupération des champs
      $name = $_POST["name"];
      $short_description = $_POST["short_description"];
      $description = $_POST["description"];
      $video = $_POST["video"];
      $rewrite = $_POST["rewrite"];
      $category = $_POST["category"];
      $meta_keywords = $_POST["meta_keywords"];
      $status = $_POST["status"];
      $highlight = $_POST["highlight"];

      // Ajout du contenu
      $result_insert = create_episode($id_user, $id_serie, $name, $id_season, $episode, $description, $resume, $release_date, $duration);

   }

   if(isset($result_insert) && $result_insert != false) {
      header('Location: manage_admin_episodes.php?add_episode=true');
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

      <a class="button" href="manage_admin_edit_season.php?id=<?php echo $id_season; ?>">Retour à la saison <?php echo $season_data['number']; ?> de <?php echo $serie_data['name']; ?></a>

      <form id="article_form" method="POST" enctype='multipart/form-data'>

         <div>
            <label>Nom
               <input id="name" name="name" type="text" placeholder="Nom de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>Numéro
               <input id="number" name="number" type="text" size="30" placeholder="Numéro de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>URL
               <input id="rewrite" name="rewrite" type="text" placeholder="URL de réécriture" required="required">
            </label>
         </div>

         <div>
            <label>Statut
               <select name="status" onchange="updated(this)">
                  <?php foreach($status_data as $value) : ?>
                     <option value="<?php echo $value['id'] ?>" <?php if(isset($status) && $status == $value['id']) { echo "selected"; } ?>><?php echo $value['name'] ?></option>
                  <?php endforeach; ?>
               </select>
            </label>
         </div>

         <div>
            <label>Description rapide
               <input id="short_description" name="short_description" type="text" placeholder="Description rapide de l'épisode">
            </label>
         </div>

         <div>
            <label>Résumé
               <textarea class="wysiwyg" id="summary" name="summary"></textarea>
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
