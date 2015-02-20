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
      $result_validate = validate_comment($id, $title, $content);

   }
   else if(isset($_POST['submit_reject'])) {

      $result_reject = false;

      $id = $_POST["id"];

      // Modification du contenu
      $result_reject = reject_comment($id);
   }

   if(isset($result_validate) && $result_validate != false) {
      header('Location: manage_admin_comments.php?validate=true');
   }
   elseif(isset($result_reject) && $result_reject != false) {
      header('Location: manage_admin_comments.php?reject=true');
   }
   elseif(isset($result_validate) && $result_validate == false) {
      error_message("Une erreur s'est produite!");
   }

   // Récupération de l'épisode selon son ID
   $data = get_comment($id);

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Modération d'un commentaire : "<?php echo $data['title']; ?>"</h1>

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
            <input name="submit" type="submit" value="Valider"> <input name="submit_reject" type="submit" value="Refuser">
         </div>
      </form>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
