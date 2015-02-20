<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   // Récupération de la série si on est pas passé par l'interface de modification d'une série
   if(isset($_GET['id'])) {
      $id_serie = $_GET['id'];

      if(!$serie_data = get_serie($id_serie)) {
         header('Location: manage_admin_series.php?error_exists=true');
      }
   }

   // Récupération des status
   $status_data = get_status();

   // Initialisation du message d'erreur
   $message = "Une erreur s'est produite!";

   if(isset($_POST['submit'])) {

      if(!check_number($id_serie, "id_serie", $_POST['number'], "season")) {
         $result_insert = false;

         // Récupération des champs
         $name = $_POST["name"];
         $rewrite = $_POST["rewrite"];
         $number = $_POST["number"];
         $description = $_POST["description"];
         $year_start = $_POST["year_start"];
         $year_end = $_POST["year_end"];
         $status = $_POST["status"];

         // Ajout du contenu
         $result_insert = create_season($id_serie, $number, $name, $description, $status, $year_start, $year_end, $rewrite);
      }
      else {
         error_message("Le numéro d'épisode existe déjà pour cette saison!");
      }

   }

   if(isset($result_insert) && $result_insert != false) {
      header('Location: manage_admin_seasons.php?id=' . $id_serie . '&add_season=true');
   }
   elseif(isset($result_insert) && $result_insert == false) {
      error_message($message);
   }

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Ajout d'une saison : "<?php echo $serie_data['name']; ?>"</h1>

      <a class="button" href="manage_admin_edit_series.php?id=<?php echo $id_serie; ?>">Retour à la série <?php echo $serie_data['name']; ?></a>

      <form id="article_form" method="POST" enctype='multipart/form-data'>

         <div>
            <label>Nom
               <input id="name" name="name" type="text" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>" placeholder="Nom de la saison" required="required">
            </label>
         </div>

         <div>
            <label>URL
               <input id="rewrite" name="rewrite" type="text" value="<?php if(isset($_POST['rewrite'])) { echo $_POST['rewrite']; } ?>" placeholder="URL de réécriture" required="required">
            </label>
         </div>

         <div>
            <label>Numéro de la saison
               <input id="number" name="number" type="text" size="30" value="<?php if(isset($_POST['number'])) { echo $_POST['number']; } ?>" placeholder="Numéro de la saison" required="required">
            </label>
         </div>

         <div>
            <label>Date de début
               <input type="text" id="year_start" name="year_start" size="30" class="input_form" value="<?php if(isset($_POST['year_start'])) { echo $_POST['year_start']; } ?>" placeholder="AAAA" maxlength="4">
            </label>
         </div>

         <div>
            <label>Date de fin
               <input type="text" id="year_end" name="year_end" max="year" size="30" class="input_form" placeholder="AAAA" maxlength="4">
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
            <label>Description
               <textarea class="wysiwyg" id="description" name="description"><?php if(isset($_POST['description'])) { echo $_POST['description']; } ?></textarea>
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
