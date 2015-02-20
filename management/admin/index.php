<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_GET['error_exists']) && $_GET['error_exists'] == true) {
      error_message("Le contenu n'existe pas!");
   }

   // Récupération du nombre d'utilisateurs
   $users = row_count("user");
   // Test de contenu non modéré
   $check_users = new_content("user");

   // Récupération du nombre de séries
   $series = row_count("serie");
   // Test de contenu non modéré
   $check_series = new_content("serie");

   // Récupération du nombre de commentaires
   $comments = row_count("comment");
   // Test de contenu non modéré
   $check_comments = new_content("comment");

   // Récupération du nombre de contenu en attente
   $proposals = row_count("moderation_episode");
   // Test de contenu non modéré
   $check_proposals = new_content("moderation_episode");

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Espace administration</h1>

      <table class="heavyTable">
         <thead>
            <tr>
               <th>Interface</th>
               <th class="th_small">Quantité</th>
               <th class="th_small">Notification</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td><a href="manage_admin_users.php">Utilisateurs</a></td>
               <td><?php echo $users[0]; ?></td>
               <td>
                  <?php if($check_users[0] == 0): ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/check.png" title="Aucun nouveau" alt="Aucun nouveau">
                  <?php else: ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/warning.png" title="Nouveau" alt="Nouveau!">
                  <?php endif; ?>
               </td>
               <td class="table_mod">
                  <a href="manage_admin_users.php">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" title="Voir les utilisateurs" alt="Voir les utilisateurs">
                  </a>
                  &nbsp;
                  <a href="manage_admin_add_user.php">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/add.png" title="Ajouter un utilisateur" alt="Ajouter un utilisateur">
                  </a>
               </td>
            </tr>

            <tr>
               <td><a href="manage_admin_series.php">Séries</a></td>
               <td><?php echo $series[0]; ?></td>
               <td>
                  <?php if($check_series[0] == 0): ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/check.png" title="Aucun nouveau" alt="Aucun nouveau">
                  <?php else: ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/warning.png" title="Nouveau" alt="Nouveau!">
                  <?php endif; ?>
               </td>
               <td class="table_mod">
                  <a href="manage_admin_series.php">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" title="Voir les séries" alt="Voir les séries">
                  </a>
                  &nbsp;
                  <a href="manage_admin_add_series.php">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/add.png" title="Ajouter une série" alt="Ajouter une série">
                  </a>
               </td>
            </tr>

            <tr>
               <td><a href="manage_admin_comments.php">Commentaires</a></td>
               <td><?php echo $comments[0]; ?></td>
               <td>
                  <?php if($check_comments[0] == 0): ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/check.png" title="Aucun nouveau" alt="Aucun nouveau">
                  <?php else: ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/warning.png" title="Nouveau" alt="Nouveau!">
                  <?php endif; ?>
               </td>
               <td class="table_mod">
                  <a href="manage_admin_comments.php">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" title="Voir les commentaires en attente" alt="Voir les commentaires en attente">
                  </a>
               </td>
            </tr>

            <tr>
               <td><a href="manage_admin_articles.php">Articles</a></td>
               <td><?php echo $proposals[0]; ?></td>
               <td>
                  <?php if($check_proposals[0] == 0): ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/check.png" title="Aucun nouveau" alt="Aucun nouveau">
                  <?php else: ?>
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/warning.png" title="Nouveau" alt="Nouveau!">
                  <?php endif; ?>
               </td>
               <td class="table_mod">
                  <a href="manage_admin_articles.php">
                     <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" title="Voir les articles en attente" alt="Voir les articles en attente">
                  </a>
               </td>
            </tr>

         </tbody>
      </table>
   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
