<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Espace administration</h5>

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
