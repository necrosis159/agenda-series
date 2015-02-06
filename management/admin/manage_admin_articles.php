<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   $data = pending_episodes();

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Articles en attente de validation</h5>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Série</th>
               <th>Episode</th>
               <th class="th_small">Date publication</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <?php
            if($data != false):
               foreach($data as $value):
                  $id_article = $value["id"];
                  ?>
                  <tr>
                     <td><span style="color: #d8871e;"># </span><?php echo $value["id"]; ?></td>
                     <td><?php echo $value['serie_name']; ?></td>
                     <td><?php echo $value['name']; ?></td>
                     <td><?php if(isset($value['release_date'])) { echo date_convert($value['release_date']); } else { echo "Aucune date"; } ?></td>
                     <td class="table_mod">
                        <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_edit_article.php?id=<?php echo $id_article; ?>">
                           <img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" alt="Modifier" />
                        </a>
                     </td>
                  </tr>
                  <?php
               endforeach;
            else:
               ?>
               <tr>
                  <td colspan="6">Il n'y a aucun contenu en attente de modération</td>
               </tr>
            <?php endif; ?>
         </tbody>
      </table>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>