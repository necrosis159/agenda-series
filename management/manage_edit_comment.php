<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   $id_comment = $_GET['id'];

   $data = get_comment($id_comment);

   // Sécurité
   if($data['id_user'] != $_SESSION['id'] || $_SESSION['status'] < 3) {
      // Le commentaire n'est pas celui de l'utilisateur ou celui-ci n'a pas les droits suffisants pour le modifier
   }

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Modifier le commentaire : # <?php echo $data['id_user']; ?></h5>

      <form id="article_form">

         <div>
            <label>Titre
               <input id="title" name="title" type="text" value="<?php echo $data['title']; ?>" placeholder="Titre de la série" required="required" autofocus="">
            </label>
         </div>

         <div>
            <label>Contenu
               <textarea></textarea>
            </label>
         </div>

         <div>
            <input type="submit" value="Enregistrer">
         </div>
      </form>

   </section>
</div>
