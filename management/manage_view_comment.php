<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['id'])) {
      $id = $_GET['id'];

      // Test de l'existance de l'article
      if(!get_comment($id)) {
         header('Location: ./index.php?error_exists=true');
      }
   }
   else {
      header('Location: ./index.php');
   }

   // Récupération du commentaire via son ID
   $data = get_comment($id);

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Affichage du commentaire :</h1>

      <p class="info">Publié sur <a href=""><?php echo $data['episode']; ?></a> par <a href=""><?php echo $data['author']; ?></a> - Etat : <?php echo $data['status']; ?></p>

      <h2 class="heading">Titre : "<?php echo $data['title']; ?>"</h2>

      <h2 class="heading">Contenu :</h2>
      <p>"<?php echo $data['content']; ?>"</p>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
