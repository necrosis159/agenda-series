<?php
include"tpl/top.php";

if (isset($_SESSION['id'])) {
  header('Location: ../account/index.php');
}

// Test des champs du formulaire à l'envoi
if (isset($_POST["submit"])) {
  $arrayErrors = array();
  // On vérifie qu'aucun champ du formulaire n'a été ajouté par l'utilisateur
  $liste_champs = array("gender", "name", "surname", "email", "username", "password", "password_confirm", "birthdate", "submit");
  if (count(array_diff($liste_champs, array_keys($_POST))) === 0) {
    $error = 0;

    // On affecte chaque champ du formulaire à une variable
    $gender = trim($_POST['gender']);
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);
    $birthdate = trim($_POST['birthdate']);

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
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // On vérifie si le mail existe dans la bdd
      $result = isEmailExists($email);
      if ($result->rowCount() > 0) {
        $arrayErrors[] = "Le mail existe déjà";
        $error ++;
      }
      $result->closeCursor();
    } else {
      $arrayErrors[] = "Le mail n'est pas valide";
      $error ++;
    }

    // Champ pseudo
    if (!empty($username) && strlen($username) >= 4 && strlen($username) <= 50) {
      // On vérifie si le pseudo existe dans la bdd
      $result = isUsernameExists($username);
      if ($result->rowCount() > 0) {
        $arrayErrors[] = "Le pseudo existe déjà";
        $error ++;
      }
      $result->closeCursor();
    } else {
      $arrayErrors[] = "Le pseudo n'est pas valide";
      $error ++;
    }

    // Champ password
    if (empty($password) || ctype_digit($password) || ctype_alpha($password) || strlen($password) < 5) {
      $arrayErrors[] = "Le mot de passe n'est pas valide";
      $error ++;
    } else { // Champ password_confirm
      if (empty($password) || $password != $password_confirm) {
        $arrayErrors[] = "Les 2 mots de passe ne sont pas identiques";
        $error ++;
      }
    }

    // Champ date
    if (!empty($birthdate)) {
      // format dd/mm/yyyy
      if (preg_match("/^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[\/]\d{4}$/", $birthdate) === 1) {
        $birthdate_explode = explode("/", $birthdate);
        if (checkdate($birthdate_explode["1"], $birthdate_explode["0"], $birthdate_explode["2"])) {
          $birthdateFormat = $birthdate_explode['2'] . "-" . $birthdate_explode["1"] . "-" . $birthdate_explode["0"];
        } else {
          $arrayErrors[] = "La date indiquée n'existe pas";
          $error ++;
        }
      }
      // format dd-mm-yyyy
      elseif (preg_match("/^(0?[1-9]|[12][0-9]|3[01])[\-](0?[1-9]|1[012])[\-]\d{4}$/", $birthdate)) {
        $birthdate_explode = explode("-", $birthdate);
        if (checkdate($birthdate_explode["1"], $birthdate_explode["0"], $birthdate_explode["2"])) {
          $birthdateFormat = $birthdate_explode['2'] . "-" . $birthdate_explode["1"] . "-" . $birthdate_explode["0"];
        } else {
          $arrayErrors[] = "La date indiquée n'existe pas";
          $error ++;
        }
      }
      // format yyyy-mm-dd
      elseif (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $birthdate)) {
        $birthdate_explode = explode("-", $birthdate);
        if (checkdate($birthdate_explode["1"], $birthdate_explode["2"], $birthdate_explode["0"])) {
          $birthdateFormat = $birthdate;
        } else {
          $arrayErrors[] = "La date indiquée n'existe pas";
          $error ++;
        }
      } else {
        $arrayErrors[] = "La date n'est pas dans un format valide";
        $error ++;
      }
      // si la date est vide
    } else {
      $arrayErrors[] = "La date de naissance n'est pas valide";
      $error ++;
    }

    // Si il y a une erreur on retourne le message d'erreur sinon on insert dans la bdd
    if ($error == 0) {
      addUser($gender, $name, $surname, $email, $username, $password, $birthdateFormat);
      valid_message("Inscription réussie");
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
  <h5 class="heading">Inscription</h5>
  <div class="form_account_bloc">
    <form action="" method="POST" id="article_form">

      <label for="name">Nom *
        <input type='text' id='name' name='name' class="input_form" placeholder='Nom' size="30" maxlength="50" value='<?php if (isset($name)) echo $name ?>'>
      </label>

      <label for="surname">Prénom *
        <input type='text' id='surname' name='surname' class="input_form" placeholder='Prénom' size="30" maxlength="50" value='<?php if (isset($surname)) echo $surname ?>'>
      </label>

      <label for="gender">Genre *
        <p>

          <input type='radio' name='gender' value='0' checked> Masculin
          <input type='radio' name='gender' value='1' <?php if (isset($gender) && $gender == 1) echo "checked"; ?> > Féminin
        </p>
      </label>

      <label for="email">Adresse Mail *
        <input type='email' id='email' name='email' class="input_form" placeholder='exemple@exemple.com' size="30" value='<?php if (isset($email)) echo $email ?>'>
      </label>

      <label for="username">Pseudo *
        <input type='text' id='username' name='username' class="input_form" placeholder='Pseudo' size="30" maxlength="50" value='<?php if (isset($username)) echo $username ?>'>
      </label>

      <label for="password">Mot de passe *
        <input type='password' id='password' name='password' class="input_form" placeholder='Mot de passe' size="30" maxlength="20" value='<?php if (isset($password)) echo $password ?>'>
      </label>

      <label for="password_confirm">Confirmation mot de passe *
        <input type='password' id='password_confirm' name='password_confirm'  class="input_form"placeholder='Confirmation' maxlength="20" size="30">
      </label>

      <label for="birthdate">Date de naissance *
        <input type="date" id="birthdate" name="birthdate" size="30"  class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10" value='<?php if (isset($birthdate)) echo $birthdate ?>'>
      </label>

      <br/><br/>
      * Champs obligatoires
      <br/><br/>
      <input class="button" type='submit' id='submit' name='submit' value='Envoyer'>

    </form>
  </div>
</div>

<?php
include("tpl/footer.php");
?>
