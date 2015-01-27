<?php

include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

$message = "Une erreur s'est produite!";

if(isset($_GET['id'])) {
   $id = $_GET['id'];
}

// Récupération de l'épisode selon son ID
$data = get_user($id);

if(isset($_POST['submit'])) {

   if($_POST["password"] === $_POST["password_verif"]) {

      $result_update = false;

      $id = $_POST["id"];

      $name = $_POST["name"];
      $surname = $_POST["surname"];
      $gender = $_POST["gender"];
      $birthdate = $_POST["birthdate"];
      $presentation = $_POST["presentation"];

      $username = $_POST["username"];
      $password = $_POST["password"];

      // Modification des informations
      $result_update = update_user($id, $name, $resume, $number);
   }
   else {
      $message = "Les deux mots de passe doivent correspondre!";
   }

}
elseif(isset($_POST['submit_remove'])) {

   $id = $_POST["id"];

   // Suppression de l'utilisateur
   delete_user($id);

   header('Location: manage_users.php?delete=true');

}

if(isset($result_update) && $result_update != false) {
   valid_message($message = "Modifications enregistrées!");
}
elseif(isset($result_update) && $result_update == false) {
   error_message($message);
}

?>

<div class="wrap">

   <section id="manage">
      <h2 class="heading">Informations personnelles</h2>

      <form id="article_form" method="POST">

         <input type="hidden" name="id" value="<?php echo $id ?>">

         <div>
            <label>Genre
               <select name="gender" onchange="updated(this)" autofocus="">
                     <option value="1" <?php if($data['gender'] == 1) { echo "selected"; } ?>>Homme</option>
                     <option value="2" <?php if($data['gender'] == 2) { echo "selected"; } ?>>Femme</option>
               </select>
            </label>
         </div>

         <div>
            <label>Nom
               <input id="name" name="name" type="text" value="<?php echo $data['name']; ?>" placeholder="Nom" required="required">
            </label>
         </div>

         <div>
            <label>Prénom
               <input id="surname" name="surname" type="text" value="<?php echo $data['surname']; ?>" placeholder="Prénom" required="required">
            </label>
         </div>

         <div>
            <label>Date de naissance
               <input type="date" id="birthdate" name="birthdate" value="<?php echo date('Y-m-d', strtotime($data["birthdate"])); ?>" size="30" class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10" value="">
            </label>
         </div>

         <div>
            <label>Présentation
               <textarea id="presentation" name="presentation"><?php echo $data['presentation']; ?></textarea>
            </label>
         </div>

         <h3 class="heading">Compte</h3>

         <div>
            <label>Pseudo
               <input id="username" name="username" type="text" value="<?php echo $data['username']; ?>" placeholder="Pseudonyme" required="required">
            </label>
         </div>

         <div>
            <label>Mot de passe
               <input id="password" name="password" type="password" value="<?php echo $data['password']; ?>" placeholder="Mot de passe" required="required">
            </label>
         </div>

         <div>
            <label>Retapez votre mot de passe
               <input id="password_verif" name="password_verif" type="password" value="<?php echo $data['password']; ?>" placeholder="Mot de passe" required="required">
            </label>
         </div>

         <div>
            <input name="submit" type="submit" value="Enregistrer"> <input name="submit_remove" type="submit" value="Supprimer">
         </div>
      </form>

   </section>
</div>

<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";

?>
