<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

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

      $result_insert = false;

      $id_user = $_SESSION['id'];

      // Récupération des champs
      $name = $_POST["name"];
      $short_description = $_POST["short_description"];
      $description = $_POST["description"];
      $nationality = $_POST["nationality"];
      $channel = $_POST["channel"];
      $year_start = $_POST["year_start"];
      $year_end = $_POST["year_end"];
      $image = "";

      if(isset($_FILES['file']))
      {
         // Test de la présence d'une image
         if($_FILES['file']['error'] == 0)
         {
            // Test de la taille de l'image
            if($_FILES['file']['size'] < $maxsize_octet)
            {
               // Initialisation du répertoire de destination
               $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/images/series/';

               // Initialisation du tableau des formats acceptés
               $tabExt = array('jpg','png','jpeg');

               //Récupération des champs
               $file_name = $_FILES['file']['name'];
               $extension  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

               // Test de l'existance du dossier de destination et s'il n'existe pas on le créée
               if(!file_exists($uploads_dir))
               {
                  mkdir($uploads_dir);
               }

               //Test de l'extension du fichier passé
               if(in_array(strtolower($extension), $tabExt))
               {
                  move_uploaded_file($_FILES['file']['tmp_name'], $uploads_dir . $file_name);
                  $image = 'series/' . $file_name;
               }
               else
               {
                  $message = "L'extension ne correspond pas!";
               }
            }
            else
            {
               $message = "La taille de votre image est trop grande!";
            }
         }
      }

      $video = $_POST["video"];
      $rewrite = $_POST["rewrite"];
      $category = $_POST["category"];
      $meta_keywords = $_POST["meta_keywords"];
      $status = $_POST["status"];
      $highlight = $_POST["highlight"];

      // Ajout du contenu
      $result_insert = create_serie($name, $short_description, $description, $nationality, $channel, $year_start, $year_end, $image, $video, $rewrite, $category, $status, $meta_keywords, $id_user, $highlight);

   }

   if(isset($result_insert) && $result_insert != false) {
      header('Location: manage_admin_series.php?add_series=true');
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
      <h1 class="heading">Ajouter une nouvelle série</h1>

      <form id="article_form" method="POST" enctype='multipart/form-data'>

         <div>
            <label>Nom
               <input id="name" name="name" type="text" placeholder="Nom de la série" required="required">
            </label>
         </div>

         <div>
            <label>URL
               <input id="rewrite" name="rewrite" type="text" placeholder="URL de réécriture" required="required">
            </label>
         </div>

         <div>
            <label>Nationalité
               <input id="nationality" name="nationality" type="text" placeholder="Nationalité" required="required">
            </label>
         </div>

         <div>
            <label>Catégorie
               <select name="category" onchange="updated(this)">
                  <?php foreach($category_data as $value) : ?>
                     <option value="<?php echo $value['id'] ?>" <?php if(isset($category) && $category == $value['id']) { echo "selected"; } ?>><?php echo $value['category'] ?></option>
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
            <label>Chaîne de diffusion
               <input id="channel" name="channel" type="text" placeholder="Chaîne de diffusion">
            </label>
         </div>

         <div>
            <label>Date de début
               <input type="date" id="year_start" name="year_start" size="30" class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10">
            </label>
         </div>

         <div>
            <label>Date de fin
               <input type="date" id="year_end" name="year_end" size="30" class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10">
            </label>
         </div>

         <div>
            <label>Description
               <textarea class="wysiwyg" id="description" name="description"></textarea>
            </label>
         </div>

         <div>
            <label>Mots-clés
               <input id="meta_keywords" name="meta_keywords" type="text" placeholder="Mots-clés">
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
            <label for="highlight">Mettre en avant
               <p>
                  <input type='radio' name='highlight' value='0'> Oui
                  <input type='radio' name='highlight' value='1' checked> Non
               </p>
            </label>
         </div>

         <h2 class="heading">Partie média :</h2>

         <div>
            <label>Image de la série<br>
               <input name="file" type='file' maxlength='<?php echo $maxsize_octet; ?>'>
            </label>
         </div>

         <div>
            <label>Lien vidéo
               <input id="video" name="video" type="text" placeholder="Lien vers la vidéo">
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
