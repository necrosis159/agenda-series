<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['id'])) {
      $id = $_GET['id'];
   }

   if(isset($_POST['submit'])) {

      $result_update = false;

      $id = $_POST["id"];
      $title = $_POST["title"];
      $content = $_POST["content"];

      // Modification du contenu
      // $result_update = update_comment($id, $title, $content);

   }

   // Récupération de l'épisode selon son ID
   $data = get_comment($id);

   if(isset($result_update) && $result_update != false) {
      echo '<p class="right">Modifications enregistrées!</p>';
   }
   elseif(isset($result_update) && $result_update == false) {
      echo '<p class="wrong">Désolé, une erreur s\'est produite</p>';
   }

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Modifier le commentaire : # <?php echo $data['id_user']; ?></h5>

      <form id="article_form" method="POST">

         <input type="hidden" name="id" value="<?php echo $id ?>">

         <div>
            <label>Titre
               <input id="title" name="title" type="text" value="<?php echo $data['title']; ?>" placeholder="Titre de la série" required="required" autofocus="">
            </label>
         </div>

         <div>
            <label>Contenu
               <textarea id="content" name="content"><?php echo $data['content']; ?></textarea>
            </label>
         </div>

         <div>
            <input name="submit" type="submit" value="Enregistrer">
         </div>
      </form>

   </section>
</div>
