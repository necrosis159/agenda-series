<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Espace administrateur</h5>

      <ul class="admin_links">
         <a href="manage_users.php"><li>- Liste des utilisteurs</li></a>
         <a href=""><li>- Propositions séries</li></a>
         <a href=""><li>- Commentaires en attente de validation</li></a>
         <a href=""><li>- Articles en attente de validation</li></a>
      </ul>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
