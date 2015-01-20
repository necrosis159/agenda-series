<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['id'])) {
      $id = $_GET['id'];
   }

   if(isset($_POST['submit'])) {

      $result_update = false;

      $id = $_POST["id"];
      $name = $_POST["name"];
      $resume = $_POST["resume"];

      // Modification du contenu
      $result_update = update_episode($id, $name, $resume);

   }

   // Récupération de l'épisode selon son ID
   $data = get_episode($id);

   // Récupération des séries dans la BDD
   $series_list = series_list();

   if(isset($result_update) && $result_update != false) {
      echo '<p class="right">Modifications enregistrées!</p>';
   }
   elseif(isset($result_update) && $result_update == false) {
      echo '<p class="wrong">Désolé, une erreur s\'est produite</p>';
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
            <label>Titre de l'épisode
               <input id="name" name="name" type="text" value="<?php echo $data['name']; ?>" placeholder="Titre de la série" required="required" autofocus="">
            </label>
         </div>

         <div>
            <label>Numéro de l'épisode
               <input id="number" name="number" type="text" value="<?php echo "" ?>" placeholder="Numéro de l'épisode" required="required">
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
