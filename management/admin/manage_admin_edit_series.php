<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['id'])) {
      $id = $_GET['id'];

      // Test de l'existance de la série
      if(!$serie_data = check_record($id, "serie")) {
         header('Location: ./index.php?error_exists=true');
      }
   }

   // Récupération des catégories séries
   $category_data = get_categories();

   // Récupération des status
   $status_data = get_status();

   // Initialisation de la taille maximale de l'image
   $maxsize = ini_get("upload_max_filesize");
   $maxsize_octet = 1024 * 1024 * str_replace("M", "", $maxsize);

   // Initialisation du message d'erreur
   $message = "Une erreur s'est produite!";

   if(isset($_POST['submit'])) {

      $id_user = $_SESSION['id'];

      $image = $_POST["image"];

      if(isset($_FILES['file'])) {
         // Test de la présence d'une image
         if($_FILES['file']['error'] == 0) {
            // Test de la taille de l'image
            if($_FILES['file']['size'] < $maxsize_octet) {
               // Initialisation du répertoire de destination
               $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/images/series/';

               // Initialisation du tableau des formats acceptés
               $tabExt = array('jpg','png','jpeg');

               //Récupération des champs
               $file_name = $_FILES['file']['name'];
               $extension  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

               // Test de l'existance du dossier de destination et s'il n'existe pas on le créée
               if(!file_exists($uploads_dir)) {
                  mkdir($uploads_dir);
               }

               // Test de l'extension du fichier passé
               if(in_array(strtolower($extension), $tabExt)) {
                  move_uploaded_file($_FILES['file']['tmp_name'], $uploads_dir . $file_name);
                  $image = 'series/' . $file_name;
               }
               else {
                  $message = "L'extension de l'image n'est pas autorisée!";
                  $image_error = true;
               }
            }
            else {
               $message = "La taille de votre image est trop grande!";
               $image_error = true;
            }
         }

         $result_update = false;

         // Récupération des champs
         $name = $_POST["name"];
         $short_description = $_POST["short_description"];
         $description = $_POST["description"];
         $nationality = $_POST["nationality"];
         $channel = $_POST["channel"];
         $year_start = $_POST["year_start"];
         $year_end = $_POST["year_end"];
         $video = $_POST["video"];
         $rewrite = $_POST["rewrite"];
         $category = $_POST["category"];
         $meta_keywords = $_POST["meta_keywords"];
         $status = $_POST["status"];
         $highlight = $_POST["highlight"];

         // Modification du contenu
         $result_update = update_serie($id, $name, $short_description, $description, $nationality, $channel, $year_start, $year_end, $image, $video, $rewrite, $category, $status, $meta_keywords, $id_user, $highlight);
      }
   }

   // Récupération des séries dans la BDD
   $data = get_serie($id);

   if(isset($result_update) && $result_update != false) {
      valid_message("Modifications enregistrées!");
   }
   elseif(isset($result_update) && $result_update == false) {
      error_message($message);
   }
   elseif(isset($image_error) && $image_error == true) {
      error_message($message);
   }

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Modification d'une série : "<?php echo $serie_data['name']; ?>"</h1>

      <a class="button" href="manage_admin_series.php">Retour à la liste des séries</a><br>

      <p align="right"><a class="button" href="manage_admin_add_season.php?id=<?php echo $id; ?>">Ajouter une saison</a> &nbsp; <a class="button" href="manage_admin_seasons.php?id=<?php echo $id; ?>">Modifier une saison</a></p>

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
            <label>Nationalité
               <input id="nationality" name="nationality" type="text" value="<?php echo $data['nationality']; ?>" placeholder="Nationalité" required="required">
            </label>
         </div>

         <div>
            <label>Catégorie
               <select name="category" onchange="updated(this)">
                  <?php foreach($category_data as $value) : ?>
                     <option value="<?php echo $value['id'] ?>" <?php if(isset($data['id_category']) && $data['id_category'] == $value['id']) { echo "selected"; } ?>><?php echo $value['category'] ?></option>
                  <?php endforeach; ?>
               </select>
            </label>
         </div>

         <div>
            <label>Description rapide
               <input id="short_description" name="short_description" type="text" value="<?php echo $data['short_description']; ?>" placeholder="Description rapide de l'épisode">
            </label>
         </div>

         <div>
            <label>Chaîne de diffusion
               <input id="channel" name="channel" type="text" value="<?php echo $data['channel']; ?>" placeholder="Chaîne de diffusion">
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
            <label>Description
               <textarea class="wysiwyg" id="description" name="description"><?php echo $data['description']; ?></textarea>
            </label>
         </div>

         <div>
            <label>Mots-clés
               <input id="meta_keywords" name="meta_keywords" type="text" value="<?php echo $data['meta_keywords']; ?>" placeholder="Mots-clés">
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
            <label for="highlight">Mettre en avant
               <p>
                  <input type='radio' name='highlight' value='0' <?php if(isset($data['highlighting']) && $data['highlighting'] == 0) { echo "checked"; } ?>> Oui
                  <input type='radio' name='highlight' value='1' <?php if(isset($data['highlighting']) && $data['highlighting'] == 1) { echo "checked"; } ?>> Non
               </p>
            </label>
         </div>

         <h2 class="heading">Partie média :</h2>

         <div>
            <label>Image de la série (Taille maximale : <?php echo $maxsize; ?>)<br>
               <?php if(isset($data['image']) && $data['image'] != ""): ?>
                  <img src="/images/<?php echo $data['image']; ?>" class="thumb"><br>
               <?php endif; ?>
               <input name="image" type='hidden' value='<?php echo $data['image']; ?>'>
               <input name="file" type='file' maxlength='<?php echo $maxsize_octet; ?>'>
            </label>
         </div>

         <br>

         <div>
            <label>Lien vidéo
               <input id="video" name="video" type="text" value="<?php echo $data['video']; ?>" placeholder="Lien vers la vidéo">
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
