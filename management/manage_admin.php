<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";


   if($_SESSION['status'] != 3) {

      header('Location: index.php');
   }

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Espace administrateur</h5>

      <ul class="admin_links">
         <a href="manage_admin_users.php"><li>- Liste des utilisteurs</li></a>
         <a href="manage_admin_series.php"><li>- Propositions séries</li></a>
         <a href="manage_admin_comments.php"><li>- Commentaires en attente de validation</li></a>
         <a href="manage_admin_articles.php"><li>- Articles en attente de validation</li></a>
      </ul>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
