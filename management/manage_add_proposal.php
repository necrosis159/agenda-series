<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_POST['submit'])) {

      $result_insert = false;

      $id_user = $_SESSION['id'];

      // Récupération des champs
      $name = $_POST["name"];
      $description = $_POST["description"];

      // Ajout de la série dans la table des propositions
      $result_insert = create_proposal($id_user, $name, $description);

   }

   // Récupération des séries dans la BDD
   $series_list = series_list();

   if(isset($result_insert) && $result_insert != false) {
      valid_message($message = "Ajout réussi. Votre proposition à été envoyée, elle sera étudiée par un administrateur sous une semaine.");
   }
   elseif(isset($result_insert) && $result_insert == false) {
      error_message($message = "Désolé, une erreur s'est produite!");
   }

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Proposer une série</h5>

      <form id="article_form" method="POST">
         <div>
            <label>Nom de la série
               <input id="name" name="name" type="text" placeholder="Nom de la série" required="required">
            </label>
         </div>

         <div>
            <label>Description de la série
               <textarea id="description" name="description" type="text" placeholder="Déscription de la série"></textarea>
            </label>
         </div>

         <div>
            <input name="submit" type="submit" value="Envoyer">
         </div>
      </form>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
