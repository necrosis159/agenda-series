<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Liste des utilisateurs</h5>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Pseudo</th>
               <th class="th_small">Age</th>
               <th>Mail</th>
               <th class="th_small">Date d'inscription</th>
               <th class="th_small">Modération</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>XXX</td>
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