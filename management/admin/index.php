<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['add_user']) && $_GET['add_user'] == true) {
      valid_message("L'utilisateur à bien été ajouté!");
   }
   else if(isset($_GET['add_serie']) && $_GET['add_serie'] == true) {
      valid_message("Ajout réussi. Article en attente de validation par un administrateur.");
   }

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Espace administration</h1>

      <ul class="admin_links">
         <a href="manage_admin_users.php"><li>- Gérer des utilisteurs</li></a>
         <a href="manage_admin_series.php"><li>- Gérer les séries</li></a>
         <a href="manage_admin_seasons.php"><li>- Gérer les saisons</li></a>
         <a href="manage_admin_episodes.php"><li>- Gérer les épisodes</li></a>
         <a href="manage_admin_comments.php"><li>- Gérer les commentaires</li></a>
         <a href="manage_admin_articles.php"><li>- Gérer les articles en attente</li></a>
      </ul>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
