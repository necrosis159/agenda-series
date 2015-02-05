<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_POST['submit'])) {

      $result_insert = false;

      $id_user = $_SESSION['id'];

      // Récupération des champs
      $serie = $_POST["serie"];
      $name = $_POST["name"];
      $release_date = $_POST["release_date"];
      $duration = $_POST["duration"];
      $season = $_POST["season"];
      $episode = $_POST["episode"];
      $description = $_POST["description"];
      $resume = $_POST["resume"];

      // Ajout du contenu
      $result_insert = create_episode($id_user, $serie, $name, $season, $episode, $description, $resume, $release_date, $duration);

   }

   // Récupération des séries dans la BDD
   $series_list = series_list();

   if(isset($result_insert) && $result_insert != false) {
      valid_message($message = "Ajout réussi. Article en attente de validation par un administrateur.");
   }
   elseif(isset($result_insert) && $result_insert == false) {
      error_message($message = "Désolé, une erreur s'est produite!");
   }

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Ajouter un nouvel article</h5>

      <form id="article_form" method="POST">

         <div>
            <label>Série
               <select name="serie" onchange="updated(this)" required="required" autofocus="">
                  <?php foreach($series_list as $value): ?>
                     <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php endforeach; ?>
               </select>
            </label>
         </div>

         <div>
            <label>Numéro de la saison
               <input id="season" name="season" type="text" placeholder="Numéro de la saison" required="required">
            </label>
         </div>

         <div>
            <label>Numéro de l'épisode
               <input id="episode" name="episode" type="text" placeholder="Numéro de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>Date de sortie
               <input type="date" id="release_date" name="release_date" size="30" class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10">
            </label>
         </div>


         <div>
            <label>Titre de l'épisode
               <input id="name" name="name" type="text" placeholder="Titre de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>Durée de l'épisode
               <input id="duration" name="duration" type="time" placeholder="Durée de l'épisode">
            </label>
         </div>

         <div>
            <label>Description
               <input id="description" name="description" type="text" placeholder="Déscription de l'épisode">
            </label>
         </div>

         <div>
            <label>Résumé
               <textarea class="wysiwyg" id="resume" name="resume"></textarea>
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
