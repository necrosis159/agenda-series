<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['id'])) {
      $id = $_GET['id'];

      // Test de l'existance de l'article
      if(!check_record($id, "moderation_episode")) {
         header('Location: manage_admin_articles.php?error_exists=true');
      }
      else {
         $data = get_proposal($id);
      }
   }
   else {
      header('Location: ./index.php');
   }

   if(isset($_POST['submit'])) {

      $result_validate = false;

      $id = $_POST["id"];

      if(check_record($id, "moderation_episode")) {
         $data = get_proposal($id);
         $id_episode = $data['id_episode'];
      }
      else {
         header('Location: manage_admin_articles.php?error_exists=true');
      }

      $name = $_POST["name"];
      $summary = $_POST["summary"];
      $release_date = $_POST["release_date"];

      // Modification du contenu
      $result_validate = validate_proposal($id, $id_episode, $name, $summary, $release_date);

   }
   else if(isset($_POST['submit_reject'])) {

      $result_reject = false;

      $id = $_POST["id"];

      // Modification du contenu
      $result_reject = reject_proposal($id);
   }

   if(isset($result_validate) && $result_validate != false) {
      header('Location: manage_admin_articles.php?validate=true');
   }
   elseif(isset($result_reject) && $result_reject != false) {
      header('Location: manage_admin_articles.php?reject=true');
   }
   elseif(isset($result_validate) && $result_validate == false) {
      error_message("Une erreur s'est produite!");
   }

?>

<div class="wrap">

   <section id="manage">
      <h1 class="heading">Proposition : <?php echo $data['serie']; ?> - saison <?php echo $data['season']; ?> "<?php echo $data['episode']; ?>"</h1>

      <form id="article_form" method="POST">

         <input type="hidden" name="id" value="<?php echo $id ?>">

         <div>
            <label>Titre
               <input id="name" name="name" type="text" value="<?php echo $data['name']; ?>" placeholder="Titre de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>Date de sortie
               <input type="date" id="release_date" name="release_date" value="<?php echo date('Y-m-d', strtotime($data["release_date"])); ?>" size="30" class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10" value="" autofocus="">
            </label>
         </div>

         <div>
            <label>Résumé
               <textarea class="wysiwyg" id="summary" name="summary"><?php echo $data['summary']; ?></textarea>
            </label>
         </div>

         <div>
            <input name="submit" type="submit" value="Valider"> <input name="submit_reject" type="submit" value="Refuser">
         </div>
      </form>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
