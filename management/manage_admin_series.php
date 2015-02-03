<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if($_SESSION['status'] != 3) {

      header('Location: index.php');
   }

   $data = get_series_suggestions();

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Propositions de séries</h5>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Série</th>
               <th>Résumé</th>
               <th class="th_small">Statut</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>

         <tbody>
            <?php
               if($data != false):
                  foreach($data as $value):
                     $id_serie = $value["id"];
            ?>
               <tr>
                  <td><span style="color: #d8871e;"># </span><?php echo $value["id"]; ?></td>
                  <td><?php echo $value['name']; ?></td>
                  <td><?php echo $value['short_description']; ?></td>
                  <td><?php echo $value['status']; ?></td>
                  <td class="table_mod">
                     <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_edit_comment.php?id=<?php echo $id_serie; ?>">
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
                  <td colspan="6">Aucune proposition de série en cours</td>
               </tr>
            <?php endif; ?>
         </tbody>
      </table>
   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
