<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Mes commentaires</h5>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Article</th>
               <th>Contenu</th>
               <th class="th_small">Date de publication</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>XXX</td>
               <td>XXX</td>
               <td>XXX</td>
               <td>XXX</td>
               <td class="table_mod"><a href="#"><img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_edit.png" alt="Modifier" /></a> <a href="#"><img class="tab_icons" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/manage_remove.png" alt="Supprimer" /></a></td>
            </tr>
         </tbody>
      </table>

   </section>
</div>

<?php

include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
