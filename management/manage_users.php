<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   // Récupération des utilisateur du site
   $data = users_list();

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Liste des utilisateurs</h5>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Pseudo</th>
               <th class="th_small">Anniversaire</th>
               <th>Mail</th>
               <th class="th_small">Date d'inscription</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if($data != false):
                  foreach($data as $value):
                     $id_user = $value["id"];
            ?>
               <tr>
                  <td><span style="color: #d8871e;"># </span><?php echo $value["id"]; ?></td>
                  <td><?php echo $value['surname']; ?></td>
                  <td><?php if(isset($value['birthdate'])) { echo date_convert($value['birthdate']); } else { echo "&mdash;"; } ?></td>
                  <td><?php echo $value['email']; ?></td>
                  <td><?php if(isset($value['release_date'])) { echo date_convert($value['creation_date']); }  else { echo "&mdash;"; } ?></td>
                  <td class="table_mod">
                     <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_edit_article.php?id=<?php echo $id_user; ?>">
                        <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" alt="Modifier" />
                     </a>
                     <a href="#">
                        <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_remove.png" alt="Supprimer" />
                     </a>
                  </td>
               </tr>
            <?php
                  endforeach;
               else:
            ?>
               <tr>
                  <td colspan="6">Vous n'avez ajouté aucun épisode</td>
               </tr>
            <?php endif; ?>
         </tbody>
      </table>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
