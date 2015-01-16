<?php

   include ("tpl/top.php");

// Fonction pour les requêtes avec en parametre les $_POST
if (!isset($_POST['pseudo'])) {
  $message = '';
} else {
  $message = '';
  if (empty($_POST['pseudo']) || empty($_POST['password'])) {
    $message = 'Vous devez renseigner tous les champs';
  } else {
    $pseudo = $_POST["pseudo"];
    $result = login($pseudo);
    $data = $result->fetch();
   //  echo $data['password']. " => ". md5($_POST['password']);
    if ($data['password'] == md5($_POST['password'])) {
      $_SESSION['pseudo'] = $data['pseudo'];
      $_SESSION['status'] = $data['status'];
      $_SESSION['id'] = $data['id'];
      $page = htmlspecialchars($_POST['page']);
      header('Location:' . $page);
    } else {
      $message = 'Le mot de passe n\'est pas correct';
    }
    $result->CloseCursor();
  }
}

if ($id == 0) {
  ?>
  <div class="wrap">
    <div id='connection_bloc'>
      <h5 class="heading">Connexion</h5>
      <div id="connection">
        <fieldset>
          <legend>Connexion</legend>
          <form method="post" action="">
            <input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
            <div class="row_form">
              <label for="pseudo">Pseudo *</label>
              <div class="input_connection">
                <input name="pseudo" type="text" id="pseudo" tabindex="1"><br />
              </div>
            </div>
            <div class="row_form">
              <label for="password">Mot de Passe *</label>
              <div class="input_connection">
                <input type="password" name="password" id="password" tabindex="2">
              </div>
              <input class="button" type="submit" value="Connexion">
            </div>
          </form>
          <a href="./register.php">Pas encore inscrit ?</a>
        </fieldset>
      </div>
    </div>
  </div>
  <?php
} else {
  $message = "Vous êtes déjà connecté";
}
echo $message;
