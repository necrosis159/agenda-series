<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

$result = selectInfosUser($_SESSION['id']);

while ($data = $result->fetch()) {
  $id = $data["id"];
  $gender = $data["gender"];
  $name = $data["name"];
  $surname = $data["surname"];
  $email = $data["email"];
  $password = $data["password"];
}


// Test des champs du formulaire à l'envoi
if (isset($_POST["submit"])) {
  $arrayErrors = array();
  // On vérifie qu'aucun champ du formulaire n'a été ajouté par l'utilisateur
  $liste_champs = array("gender", "name", "surname", "email", "password", "password_confirm", "submit");
  if (count(array_diff($liste_champs, array_keys($_POST))) === 0) {
    $error = 0;

    // On affecte chaque champ du formulaire à une variable
    $gender = trim($_POST['gender']);
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    if (!empty($_POST["password"])) {
      $password = trim($_POST['password']);
      $password_confirm = trim($_POST['password_confirm']);
    }

    // Champ name
    if (strlen($name) > 50) {
      $arrayErrors[] = "Le nom n'est pas valide";
      $error ++;
    }

    // Champ Prénom
    if (strlen($surname) > 50) {
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
      // On vérifie si le mail existe dans la bdd et que ce n'est pas le mail de l'utilisateur
      $result = isEmailExistsWhenUpdate($_SESSION['id'], $email);
      if ($result->rowCount() > 0) {
        $arrayErrors[] = "Le mail existe déjà";
        $error ++;
      }
      $result->closeCursor();
    }

    // Champ password
    $password_form = trim($_POST["password"]);
    if (!empty($password_form) && preg_match("/^(?=.*\d)(?=.*[A-Z]).{4,8}$/", $_POST["password"]) === 1 && $_POST["password"] == $_POST["password_confirm"]) {
      $password = $_POST["password"];
    }

    // Si il y a une erreur on retourne le message d'erreur sinon on insert dans la bdd
    if ($error > 0) {
      array_unshift($arrayErrors, "Formulaire invalide");
    } else {
      update_user($_SESSION['id'], $gender, $name, $surname, $email, $password);
    }
  } else {
    $arrayErrors[] = "Petit coquinou qui essaye d'insérer des champs :o";
  }
}
?>

<div id="erreurFormulaire">
  <?php
  if (isset($_POST["submit"])) {
    if (count($arrayErrors) > 0) {
      foreach ($arrayErrors as $row) {
        echo $row;
        echo "<br/>";
      }
    }
  }
  ?>
</div>
<div class="wrap">
  <div class="form_account_bloc">
    <h5 class="heading">Mes Informations</h5>
    <fieldset>
      <legend>Mes Informations</legend>
      <form action="" method="POST" id="article_form">

        <label for="name">Nom
        <input type='text' id='name' name='name' class="input_form" placeholder='Nom' size="30" maxlength="50" value='<?php if (isset($name)) echo $name ?>'>
        </label>
        
        <label for="surname">Prénom
        <input type='text' id='surname' name='surname' class="input_form" placeholder='Prénom' size="30" maxlength="50" value='<?php if (isset($surname)) echo $surname ?>'>
        </label>
        
        <label for="gender">Genre
        <?php
        if ($gender == 0): ?>
          <p>
            <input type='radio' name='gender' value='0' checked> Masculin
            <input type='radio' name='gender' value='1'> Féminin
          </p>
        <?php else : ?>
          <p>
            <input type='radio' name='gender' value='0'> Masculin
            <input type='radio' name='gender' value='1' checked> Féminin
          </p>
        <?php endif; ?>
        </label>
          
        <label for="email">Adresse Mail
        <input type='email' id='email' name='email' class="input_form" placeholder='exemple@exemple.com' size="30" value='<?php if (isset($email)) echo $email ?>'>
        </label>
        
        <label for="password">Mot de passe
        <input type='password' id='password' name='password' class="input_form" placeholder='Mot de passe' size="30" maxlength="8" value=''>
        </label>
        
        <label for="password_confirm">Confirmation mot de passe
        <input type='password' id='password_confirm' name='password_confirm'  class="input_form"placeholder='Confirmation' maxlength="8" size="30">
        </label>
        
        <input class="button" type='submit' id='submit' name='submit' value='Modifier'>
      </form>
    </fieldset>

  </div>
</div>
<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";
?>