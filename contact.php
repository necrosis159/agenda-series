<?php
include 'tpl/top.php';

// Test des champs du formulaire à l'envoi
if (isset($_POST["submit"])) {
  $arrayErrors = array();
  // On vérifie qu'aucun champ du formulaire n'a été ajouté par l'utilisateur
  $liste_champs = array("name", "surname", "email", "message", "submit");
  if (count(array_diff($liste_champs, array_keys($_POST))) === 0) {
    $error = 0;

    // On affecte chaque champ du formulaire à une variable
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $message = $_POST['message'];


    // Champ name
    if (empty($name) || strlen($name) > 50) {
      $arrayErrors[] = "Le nom n'est pas valide";
      $error ++;
    }

    // Champ Prénom
    if (empty($surname) || strlen($surname) > 50) {
      $arrayErrors[] = "Le prénom n'est pas valide";
      $error ++;
    }

    // On vérifie que le name et le Prénom ne sont pas égaux
    if (!empty($name) && !empty($surname) && mb_strtolower($name) == mb_strtolower($surname)) {
      $arrayErrors[] = "Le prénom et le nom sont identiques";
      $error ++;
    }

    // Champ email
    if (empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $arrayErrors[] = "L'email n'est pas valide";
      $error ++;
    }

    // Si il y a une erreur on retourne le message d'erreur
    if ($error == 0) {
      $subject = "Agenda-Serie : Mail Contact";
      $message = wordwrap($message, 70);
      mail("agendaserie@gmail.com", $subject, $message);
      valid_message("Merci de nous avoir contacté !");
    }
   } else {
    error_message("Une erreur s'est produite !");
   }
}
?>

<div id="erreurFormulaire" style="display: none;">
    <?php
    if (isset($_POST["submit"])) :
      if (count($arrayErrors) > 0) :
      echo error_message($arrayErrors[0]);
      endif;
    endif;
    ?>
</div>
<div class="wrap">
  <h5 class="heading">Formulaire de contact</h5>
  <div class="form_account_bloc">
    <form action="" method="POST" id="article_form">

      <label for="name">Nom *
        <input type='text' id='name' name='name' class="input_form" placeholder='Nom' size="30" maxlength="50" value="<?php if (isset($name)) echo $name ?>">
      </label>

      <label for="surname">Prénom *
        <input type='text' id='surname' name='surname' class="input_form" placeholder='Prénom' size="30" maxlength="50" value="<?php if (isset($surname)) echo $surname ?>">
      </label>

      <label for="email">Adresse Mail *
        <input type='email' id='email' name='email' class="input_form" placeholder='exemple@exemple.com' size="30" value="<?php if (isset($email)) echo $email ?>">
      </label>

      <label for="message">Message *
        <textarea id='message' name='message' class="input_form" placeholder='Message' size="30" maxlength="1000" value="<?php if (isset($message)) echo $message ?>"></textarea>
      </label>

      <br/><br/>
      * Champs obligatoires
      <br/><br/>
      <input class="button" type='submit' id='submit' name='submit' value='Envoyer'>

    </form>
  </div>
</div>

<?php
include 'tpl/footer.php';
?>
