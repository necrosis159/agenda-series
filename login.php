<?php

   include ("tpl/top.php");

   if(isset($_SESSION['id'])) {
      header('Location: ../account/index.php');
   }

   if(isset($_GET['error'])) {
      $message = "Vous devez vous connecter!";
   }

   // Fonction pour les requêtes avec en parametre les $_POST
   if (isset($_POST['username'])) {

     if (empty($_POST['username']) || empty($_POST['password'])) {
       $message = 'Vous devez renseigner tous les champs';
     } else {
       $username = $_POST["username"];
       $result = login($username);
       $data = $result->fetch();
      //  echo $data['password']. " => ". md5($_POST['password']);
       if ($data['password'] == md5($_POST['password'])) {
         $_SESSION['username'] = $data['username'];
         $_SESSION['status'] = $data['status'];
         $_SESSION['id'] = $data['id'];
         updateLastLogin($_SESSION['id']);
         $page = htmlspecialchars($_POST['page']);
         header('Location:' . $page);
       } else {
         $message = 'Le mot de passe n\'est pas correct';
       }

       $result->CloseCursor();
     }
   }

?>

  <div class="wrap">
    <div id='connection_bloc'>
      <h5 class="heading">Connexion</h5>
        <fieldset>
          <legend>Connexion</legend>
          <form method="post" action="">
            <input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
            <div class="row_form">
              <label for="username">Pseudo *</label>
              <div class="input_connection">
                <input name="username" type="text" id="username" tabindex="1"><br />
              </div>
            </div>
            <div class="row_form">
              <label for="password">Mot de Passe *</label>
              <div class="input_connection">
                <input type="password" name="password" id="password" tabindex="2">
              </div>
            </div>
            <div class="row_form">
               <?php if(isset($message)) { echo '<p style="text-align: center;"><span style="color: red;">' . $message . '</span></p>'; } ?>
              <input class="button" type="submit" value="Connexion">
            </div>
          </form>
          <a href="./register.php">Pas encore inscrit ?</a>
        </fieldset>
    </div>
  </div>

<?php

   include "tpl/footer.php";

?>
