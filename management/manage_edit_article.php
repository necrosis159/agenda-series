<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['id'])) {
      $id = $_GET['id'];

      // Test de l'existance de l'article
      if(!get_episode($id)) {
         header('Location: ./index.php?error_exists=true');
      }
   }
   else {
      header('Location: ./index.php');
   }

   if(isset($_POST['submit'])) {

      $result_update = false;

      $id = $_POST["id"];
      $name = $_POST["name"];
      $summary = $_POST["summary"];

      // Modification du contenu
      $result_update = update_episode($id, $name, $summary);

   }

   // Récupération de l'épisode selon son ID
   $data = get_episode($id);

   // Récupération des séries dans la BDD
   $series_list = get_series();

   if(isset($result_update) && $result_update != false) {
      valid_message("Modifications enregistrées, votre contenu est en attente de validation d'un modérateur.");
   }
   elseif(isset($result_update) && $result_update == false) {
      error_message("Une erreur s'est produite!");
   }

?>

<div class="wrap">

   <section id="manage">
      <h1 class="heading">Modifier l'article : # <?php echo $data['id']; ?></h1>

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
               <input type="date" id="release_date" name="release_date" value="<?php echo date('Y-m-d', strtotime($data["release_date"])); ?>" size="30" class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10" value="" autofocus="">
            </label>
         </div>


         <div>
            <label>Titre de l'épisode
               <input id="name" name="name" type="text" value="<?php echo $data['name']; ?>" placeholder="Titre de la série" required="required">
            </label>
         </div>

         <div>
            <label>Contenu
               <textarea class="wysiwyg" id="summary" name="summary"><?php echo $data['summary']; ?></textarea>
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
