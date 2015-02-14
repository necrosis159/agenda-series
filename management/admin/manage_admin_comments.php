<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   $data = get_comments();

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Commentaires en attente</h1>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Episode</th>
               <th>Commentaire</th>
               <th class="th_small">Date</th>
               <th class="th_small">Statut</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <?php
            if($data != false):
               foreach($data as $value):
                  $id_comment = $value["id_user"];
                  ?>
                  <tr>
                     <td><span style="color: #d8871e;"># </span><?php echo $value["id_user"]; ?></td>
                     <td><?php echo $value['title']; ?></td>
                     <td><?php echo $value['content']; ?></td>
                     <td>
                        <?php if(isset($value['date_publication'])) {
                           echo date_convert($value['date_publication']);
                        } else {
                           echo "Aucune date";
                        } ?>
                     </td>
                     <td>
                        <?php if($value['status'] == 4): ?>
                           <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/valid.png" title="Validé" alt="Validé">
                        <?php elseif($value['status'] == 5): ?>
                           <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/error.png" title="refusé" alt="Refusé">
                        <?php else: ?>
                              <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/warning.png" title="En attente" alt="En attente">
                        <?php endif; ?>
                     </td>
                     <td class="table_mod">
                        <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_admin_edit_comment.php?id=<?php echo $id_comment; ?>">
                           <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" alt="Modifier" />
                        </a>
                        &nbsp;
                        <a href="#">
                           <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/trash.png" alt="Désactiver" />
                        </a>
                     </td>
                  </tr>
                  <?php
               endforeach;
            else:
               ?>
               <tr>
                  <td colspan="6">Vous n'avez aucun commentaire</td>
               </tr>
            <?php endif; ?>
         </tbody>
      </table>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
