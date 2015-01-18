<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Ajouter un nouvel article</h5>

      <form id="article_form">
         <div>
            <label>Permalien
               <input id="rewrite" name="rewrite" type="text" placeholder="Ex : arrow-s01-e01">
            </label>
         </div>

         <div>
            <label>Titre
               <input id="title" name="title" type="text" placeholder="Titre de la série" required="" autofocus="">
            </label>
         </div>

         <div>
            <label>Catégorie(s)
               <input id="category" name="category" type="text" placeholder="Catégorien de la série">
            </label>
         </div>

         <div>
            <label>Contenu
               <textarea></textarea>
            </label>
         </div>

         <div>
            <input type="submit" value="Enregistrer">
         </div>
      </form>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
