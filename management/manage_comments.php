<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   $data = user_comments($_SESSION['id']);

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Mes commentaires</h1>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Série</th>
               <th>Mon commentaire</th>
               <th class="th_small">Date</th>
               <th class="th_small">Statut</th>
               <th class="th_small">Option</th>
            </tr>
         </thead>
         <tbody>
            <?php
            if($data != false):
               foreach($data as $value):
                  $id_comment = $value["id"];
                  ?>
                  <tr>
                     <td><span style="color: #d8871e;"># </span><?php echo $id_comment; ?></td>
                     <td><?php echo $value['title']; ?></td>
                     <td><?php echo $value['content']; ?></td>
                     <td><?php if(isset($value['date_publication'])) { echo date_convert($value['date_publication']); } else { echo "Aucune date"; } ?></td>
                     <td><?php if($value['status'] == 4) { echo '<img class="tab_icons" src="../images/valid.png" title="Validé" alt="Validé" />'; } else if($value['status'] == 5) { echo '<img class="tab_icons" src="../images/error.png" title="refusé" alt="Refusé" />'; } else { echo '<img class="tab_icons" src="../images/warning.png" title="En attente" alt="En attente" />'; } ?></td>
                     <td class="table_mod">
                        <a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_view_comment.php?id=<?php echo $id_comment; ?>">
                           <img class="tab_icons" src="../images/magnify.png" alt="Modifier" />
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
