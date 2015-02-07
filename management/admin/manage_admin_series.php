<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   $data = get_series();

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Propositions de séries</h5>

      <a class="button" href="manage_admin_add_series.php">Ajouter une série</a>

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
                  <td><?php if($value['status'] == 0) { echo '<span class="color_pending">En attente</span>'; } elseif($value['status'] == 1) { echo '<span class="color_validate">Validé</span>'; } else { echo '<span class="color_error">Refusé</span>'; } ?></td>
                  <td class="table_mod">
                     <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_admin_edit_series.php?id=<?php echo $id_serie; ?>">
                        <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" alt="Modifier" />
                     </a>
                     &nbsp;&nbsp;
                     <a href="#">
                        <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/bin.png" title="Suspendre" alt="Suspendre" />
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
