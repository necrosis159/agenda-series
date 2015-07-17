<div class="wrap">
   <section id="manage">
      <h1 class="heading">Recherche d'un utilisateur</h1>

      <form action="" method="GET" id="article_form" class="search adm_search">
         <p>ID:</p> <input name="id" type="text" placeholder="Entrez un ID" value="<?php echo $oldid; ?>">
         <p>Username:</p> <input name="username" type="text" placeholder="Entrez le nom de l'utilisateur" value="<?php echo $oldusername; ?>">
            <?php if($content != ""): ?>
            <p>
               Il y a <?php echo count($content); if(count($content) > 1) { echo " résultats "; } else { echo " résultat "; }?> pour votre recherche.
            </p>
         <?php endif; ?>
            <input type="submit" value="Rechercher">
         </p>
      </form>

      <?php if($content != ""): ?>
         <table class="heavyTable">
            <thead>
               <tr>
                  <th class="th_small">ID</th>
                  <th>Username</th>
                  <th class="th_small">Actions</th>
               </tr>
            </thead>

            <tbody>
               <?php if(count($content) > 0):
                  foreach($content as $value): ?>
                  <tr>
                     <td><span style="color: #d8871e;">#</span><?php echo $value['user_id'] ?></td>
                     <td>
                        <?php
                           if($value['user_username'] != "") {
                              echo $value['user_username'];
                           }
                           else {
                              echo "<span style='color: red;'>Aucun nom n'est disponible<span style='color: red;'>";
                           }
                         ?>
                     </td>
                     <td class="table_mod">
                           <a href="/admin/edituser/<?php echo $value['user_id'] ?>">
                              <img class="tab_icons" src="../images/manage_edit.png" title="Modifier" alt="Modifier" />
                           </a>
                     </td>
                  </tr>
               <?php endforeach; else: ?>
                  <td style="padding-top: 6px;" colspan="6">Aucun résultat</td>
               <?php  endif; ?>
            </tbody>
         </table>
      <?php endif; ?>
   </section>
</div>
