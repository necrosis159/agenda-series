<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   $id_user = $_SESSION['id'];

   $result = last_user_comments($id_user);

   while($data = $result->fetch()) {
      $id_comment = $data["id"];
      $title = $data["title"];
      $content = $data["content"];
      $date = $data["date"];
   }

?>

<div class="wrap">
   <section id="manage">
   	<h5 class="heading">Mes derniers commentaires</h5>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Série</th>
               <th>Mon commentaire</th>
               <th class="th_small">Date</th>
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

   <section id="account">
      <h5 class="heading">Mes derniers ajouts</h5>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Série</th>
               <th>Contenu</th>
               <th class="th_small">Date</th>
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
