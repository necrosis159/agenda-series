<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['id'])) {
      $id = $_GET['id'];
   }

   if(isset($_POST['submit'])) {

      $result_update = false;

      $id = $_POST["id"];
      $name = $_POST["name"];
      $number = $_POST["number"];
      $resume = $_POST["resume"];

      // Modification du contenu
      $result_update = update_episode($id, $name, $resume, $number);

   }

   // Récupération de l'épisode selon son ID
   $data = get_episode($id);

   // Récupération des séries dans la BDD
   $series_list = series_list();

   if(isset($result_update) && $result_update != false) {
      valid_message($message = "Modifications enregistrées!");
   }
   elseif(isset($result_update) && $result_update == false) {
      error_message($message = "Une erreur s'est produite!");
   }

?>

<div class="wrap">

   <section id="manage">
      <h5 class="heading">Modifier l'article : # <?php echo $data['id']; ?></h5>

      <form id="article_form" method="POST">

         <input type="hidden" name="id" value="<?php echo $id ?>">

         <div>
            <label>Série
               <select name="serie" onchange="updated(this)" disabled>
                  <?php foreach($series_list as $value): ?>
                  <option value="1"><?php echo $value['name']; ?></option>
               <?php endforeach; ?>
               </select>
            </label>
         </div>

         <div>
            <label>Date de sortie
               <input type="date" id="release_date" name="release_date" value="<?php echo date('Y-m-d', strtotime($data["release_date"])); ?>" size="30" class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10" value="">
            </label>
         </div>


         <div>
            <label>Titre de l'épisode
               <input id="name" name="name" type="text" value="<?php echo $data['name']; ?>" placeholder="Titre de la série" required="required" autofocus="">
            </label>
         </div>

         <div>
            <label>Numéro de l'épisode
               <input id="number" name="number" type="text" value="<?php echo $data['number']; ?>" placeholder="Numéro de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>Contenu
               <textarea id="resume" name="resume"><?php echo $data['resume']; ?></textarea>
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
