<div class="wrap">
   <section id="manage">
      <h1 class="heading">Modérer le commentaire : <?php echo "#" . $idComment . ' - "' . $data['comment_title']; ?>"</h1>

      <form id="article_form" action="" method="POST">

         <div>
            <label>Titre
               <input id="title" name="title" type="text" value="<?php echo $data['comment_title']; ?>" placeholder="Titre du commentaire" required="required" autofocus="">
            </label>
         </div>

         <div>
            <label>Statut<br>
               <select name="status">
                  <option <?php if($data['comment_status'] == 0) { echo "selected"; } ?> value="0">Refusé</option>
                  <option <?php if($data['comment_status'] == 1) { echo "selected"; } ?> value="1">Validé</option>
               </select>
            </label>
         </div>

         <div>
            <label>Contenu
               <textarea id="content" name="content"><?php echo $data['comment_content']; ?></textarea>
            </label>
         </div>

         <div>
            <input name="submit" type="submit" value="Sauvegarder">
         </div>
      </form>

   </section>
</div>
