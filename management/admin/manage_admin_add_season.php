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
               <input id="name" name="name" type="text" placeholder="Nom de la saison" required="required">
            </label>
         </div>

         <div>
            <label>URL
               <input id="rewrite" name="rewrite" type="text" placeholder="URL de réécriture" required="required">
            </label>
         </div>

         <div>
            <label>Numéro de la saison
               <input id="number" name="number" type="text" size="30" placeholder="Numéro de la saison" required="required">
            </label>
         </div>

         <div>
            <label>Date de début
               <input type="text" id="year_start" name="year_start" size="30" class="input_form" placeholder="AAAA" maxlength="4">
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
                     <option value="<?php echo $value['id'] ?>" <?php if(isset($status) && $status == $value['id']) { echo "selected"; } ?>><?php echo $value['name'] ?></option>
                  <?php endforeach; ?>
               </select>
            </label>
         </div>

         <div>
            <label>Description
               <textarea class="wysiwyg" id="description" name="description"></textarea>
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
