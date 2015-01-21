<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   if(isset($_POST['submit'])) {

      $result_update = false;

      $serie = $_POST["serie"];
      $name = $_POST["name"];
      $release_date = $_POST["release_date"];
      $number = $_POST["number"];
      $resume = $_POST["resume"];

      // Modification du contenu
      $result_insert = create_episode($serie, $name, $number, $resume, $release_date);

   }

   // Récupération des séries dans la BDD
   $series_list = series_list();

   // Récupération des saison de la série
   //$seasons_list = seasons_list($id_serie);

   if(isset($result_insert) && $result_insert != false) {
      header('Location: index.php');
   }
   elseif(isset($result_insert) && $result_insert == false) {
      echo '<p class="wrong">Désolé, une erreur s\'est produite</p>';
   }

?>

<div class="wrap">
   <section id="manage">
      <h5 class="heading">Ajouter un nouvel article</h5>

      <form id="article_form" method="POST">

         <div>
            <label>Série
               <select name="serie" onchange="updated(this)" required="required" autofocus="">
                  <?php foreach($series_list as $value): ?>
                     <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php endforeach; ?>
               </select>
            </label>
         </div>

         <div>
            <label>Saison
               <select name="serie" onchange="updated(this)" required="required">
                  <?php foreach($seasons_list as $value): ?>
                     <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php endforeach; ?>
               </select>
            </label>
         </div>

         <div>
            <label>Date de sortie
               <input type="date" id="release_date" name="release_date" size="30" class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10">
            </label>
         </div>


         <div>
            <label>Titre de l'épisode
               <input id="name" name="name" type="text" placeholder="Titre de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>Numéro de l'épisode
               <input id="number" name="number" type="text" placeholder="Numéro de l'épisode" required="required">
            </label>
         </div>

         <div>
            <label>Contenu
               <textarea id="resume" name="resume"></textarea>
            </label>
         </div>

         <div>
            <input name="submit" type="submit" value="Enregistrer">
         </div>
      </form>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
