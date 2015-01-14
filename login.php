<?php
  include ("tpl/top.php");

   
    if (!isset($_POST['pseudo'])) {
      $message = '';
    } else {
      $message = '';
      if (empty($_POST['pseudo']) || empty($_POST['password'])) {
        $message = 'Vous devez renseigner tous les champs';
      } else {
        $query = $db->prepare("SELECT id, pseudo, password, status FROM user WHERE pseudo = :pseudo");
        $query->execute(array("pseudo" => $_POST["pseudo"]));
        // $query->execute();
        $data = $query->fetch();
        if ($data['password'] == $_POST['password']) {
          $_SESSION['pseudo'] = $data['pseudo'];
          $_SESSION['level'] = $data['status'];
          $_SESSION['id'] = $data['id'];
          $page = htmlspecialchars($_POST['page']);
          header('Location:'.$page);
          echo $page;
        } else {
          $message = 'Le mot de passe n\'est pas correct';
        }
          $query->CloseCursor();
        }
    }
  
  if ($id == 0) {
?>
<div id='connection_bloc'>
  <div id="connection">
    <fieldset>
      <legend>Connexion</legend>
      <form method="post" action="">
        <input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
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
          <input type="submit" value="Connexion" />
        </div>
      </form>
      <a href="./register.php">Pas encore inscrit ?</a>
    </fieldset>
  </div>
</div>
<?php
} else {
      $message = "Vous êtes déjà connecté";
  }
  echo $message;
  
