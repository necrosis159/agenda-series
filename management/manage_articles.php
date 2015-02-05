<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   $data = user_episodes($_SESSION['id']);

   // die(var_dump($data));

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Mes articles</h5>

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
                  $id_episode = $value["id"];
                  ?>
                  <tr>
                     <td><span style="color: #d8871e;"># </span><?php echo $value["id"]; ?></td>
                     <td><?php echo $value['serie_name']; ?></td>
                     <td><?php echo $value['name']; ?></td>
                     <td><?php if(isset($value['release_date'])) { echo date_convert($value['release_date']); } else { echo "Aucune date"; } ?></td>
                     <td class="table_mod">
                        <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_edit_article.php?id=<?php echo $id_episode; ?>">
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
