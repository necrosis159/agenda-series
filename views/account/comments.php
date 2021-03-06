<div class="wrap">
   <section id="manage">
      <h1 class="heading">Mes commentaires</h1>

      <table class="heavyTable">
         <thead>
            <tr>
               <th class="th_small">ID</th>
               <th>Posté sur</th>
               <th>Extrait</th>
               <th class="th_small">Date publication</th>
               <th class="th_small">Actions</th>
            </tr>
         </thead>

         <tbody id="result_table">
            <?php if(count($content) > 0):
               foreach($content as $value): ?>
               <tr>
                  <td><span style="color: #d8871e;">#</span><?php echo $value['comment_id'] ?></td>
                  <td>
                     <?php echo $value['serie_name'] . " : S" . $value['season_number'] . "E" . $value['episode_number']; ?>
                  </td>
                  <td><?php echo $value['comment_content'] ?></td>
                  <td>
                     <?php echo $this->dateConvert($value['comment_date_publication']); ?>
                  </td>
                  <td class="table_mod">
                     <a href="/serie/<?php echo $value['serie_id'] ?>/Saison<?php echo $value['season_number'] ?>/Episode<?php echo $value['episode_number'] ?>">
                        <img class="tab_icons" src="../images/files.png" title="Consulter" alt="Consulter" />
                     </a>
                     <?php if($_SESSION['user_status'] == 1): ?>
                        <a href="/admin/comment/edit/<?php echo $value['comment_id'] ?>">
                           <img class="tab_icons" src="../images/manage_edit.png" title="Modifier" alt="Modifier" />
                        </a>
                     <?php endif; ?>
                  </td>
               </tr>
            <?php endforeach; else: ?>
               <td style="padding-top: 6px;" colspan="6">Aucun résultat</td>
            <?php endif; ?>
         </tbody>
      </table>

      <!-- Affichage du chargement supplémentaire de résultats s'il y en a et qu'il y en a plus que le nombre d'affichage de base -->
      <?php if(count($content) > 0 && count($content) > 5): ?>
         <p style="text-align: center;">
            <button class="button" id="loadMore">Charger plus</button>
         </p>
         <br>
      <?php endif; ?>
   </section>
</div>

<script src="/js/admin/loadMore.js"></script>
