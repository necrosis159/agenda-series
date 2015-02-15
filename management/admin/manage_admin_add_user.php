<?php

   include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

   // Initialisation du message d'erreur
   $message = "Une erreur s'est produite!";

   if(isset($_POST['submit'])) {

      // Récupération des champs
      $presentation = trim($_POST['presentation']);
      $gender = trim($_POST['gender']);
      $name = trim($_POST['name']);
      $surname = trim($_POST['surname']);
      $email = trim($_POST['email']);
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
      $password_verif = trim($_POST['password_verif']);
      $birthdate = trim($_POST['birthdate']);

      if($password_verif === $password) {

         $result_insert = false;

         // Ajout du contenu
         $result_insert = admin_add_user($presentation, $gender, $name, $surname, $email, $username, $password, $birthdate);
      }
      else {
         error_message("Les mots de passe entré sont différents!");
      }

   }

   // Récupération des séries dans la BDD
   $users_list = get_users();

   if(isset($result_insert) && $result_insert != false) {
      header('Location: manage_admin_users.php?add_user=true');
   }
   elseif(isset($result_insert) && $result_insert == false) {
      error_message($message);
   }

?>

<div class="wrap">
   <section id="manage">
      <h1 class="heading">Ajouter un nouvel utilisateur</h1>

      <a class="button" href="manage_admin_users.php">Retour à la liste des utilisateurs</a>

      <form id="article_form" method="POST">

         <div>
            <label>Nom
               <input id="name" name="name" type="text" value="<?php if(isset($name)) { echo $name; } ?>" placeholder="Nom" required="required"  autofocus="">
            </label>
         </div>

         <div>
            <label>Prénom
               <input id="surname" name="surname" type="text" value="<?php if(isset($surname)) { echo $surname; } ?>" placeholder="Prénom" required="required">
            </label>
         </div>

         <div>
            <label>Genre
               <select name="gender" onchange="updated(this)">
                  <option value="0" <?php if(isset($gender) && $gender == 0) { echo "selected"; } ?>>Homme</option>
                  <option value="1" <?php if(isset($gender) && $gender == 1) { echo "selected"; } ?>>Femme</option>
               </select>
            </label>
         </div>

         <div>
            <label>Date de naissance
               <input type="date" id="birthdate" name="birthdate" value="<?php if(isset($birthdate)) { echo date('Y-m-d', strtotime($birthdate)); } ?>" size="30" class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10" value="">
            </label>
         </div>

         <div>
            <label>Présentation
               <textarea id="presentation" name="presentation"><?php if(isset($presentation)) { echo $presentation; } ?></textarea>
            </label>
         </div>

         <h3 class="heading">Compte</h3>

         <div>
            <label>Statut
               <select name="status" onchange="updated(this)">
                  <option value="0" <?php if(isset($status) && $status == 0) { echo "selected"; } ?>>Utilisateur</option>
                  <option value="1" <?php if(isset($status) && $status == 1) { echo "selected"; } ?>>Editeur</option>
                  <option value="2" <?php if(isset($status) && $status == 2) { echo "selected"; } ?>>Administrateur</option>
               </select>
            </label>
         </div>

         <div>
            <label>Email
               <input id="email" name="email" type="email" value="<?php if(isset($email)) { echo $email; } ?>" placeholder="Email" required="required">
            </label>
         </div>

         <div>
            <label>Pseudo
               <input id="username" name="username" type="text" value="<?php if(isset($username)) { echo $username; } ?>" placeholder="Pseudonyme" required="required">
            </label>
         </div>

         <div>
            <label>Mot de passe
               <input id="password" name="password" type="password" value="<?php if(isset($password)) { echo $password; } ?>" placeholder="Mot de passe" required="required">
            </label>
         </div>

         <div>
            <label>Retapez votre mot de passe
               <input id="password_verif" name="password_verif" type="password" placeholder="Mot de passe" required="required">
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
