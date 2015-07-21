<?php

   if($update == true) {
      echo $this->validMessage('Commentaire modifié avec succès!');
   }

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Modérer le commentaire : <?php echo "#" . $idComment . ' - "' . $data['serie_name'] . " : " . $data['episode_name']; ?>"</h1>

      <form id="article_form" action="" method="POST">

         <div>
            <label>Statut<br>
               <select name="status">
                  <option <?php if($data['comment_status'] == 0) { echo "selected"; } ?> value="0">Validé</option>
                  <option <?php if($data['comment_status'] == 1) { echo "selected"; } ?> value="1">Refusé</option>
                  <option <?php if($data['comment_status'] == 2) { echo "selected"; } ?> value="2">Signalé</option>
               </select>
            </label>
         </div>

         <div>
            <label>Mettre en avant<br>
               <select name="highlight">
                  <option <?php if($data['comment_highlighting'] == 0) { echo "selected"; } ?> value="0">Activer</option>
                  <option <?php if($data['comment_highlighting'] == 1) { echo "selected"; } ?> value="1">Désactiver</option>
               </select>
            </label>
         </div>


         <?php
            // for($i= 1; $i <= $data['comment_notation']; $i++) {
            //   echo '<img style="width: 2.5%;" src="../../../images/star.png" />';
            // }
            // if(strpos($data['comment_notation'], '.')) {
            //   echo '<img style="width: 2.5%;" src="../../../images/half_star.png" />';
            //   $i++;
            // }
            // while($i <= 5) {
            //   echo '<img style="width: 2.5%;" src="../../../images/blank_star.png" />';
            //   $i++;
            // }
         ?>

         <div>
            <label>Contenu
               <textarea rows="7" id="content" name="content"><?php echo $data['comment_content']; ?></textarea>
            </label>
         </div>

         <div>
            <input name="submit" type="submit" value="Sauvegarder"> <a class="button" href="javascript:history.go(-1)">Retour</a>
         </div>
      </form>

   </section>
</div>
