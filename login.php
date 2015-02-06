<?php

   include ("tpl/top.php");

   if(isset($_SESSION['id'])) {
      header('Location: ../account/index.php');
   }

   if(isset($_GET['error'])) {
      error_message("Vous devez vous connecter !");
   }

   // Fonction pour les requêtes avec en parametre les $_POST
   if (isset($_POST['username'])) {

     if (empty($_POST['username']) || empty($_POST['password'])) {
       error_message('Vous devez renseigner tous les champs');
     } else {
       $username = $_POST["username"];
       $result = login($username);
       $data = $result->fetch();
       if($data != 0) {
         if ($data['password'] == md5($_POST['password'])) {
           $_SESSION['username'] = $data['username'];
           $_SESSION['status'] = $data['status'];
           $_SESSION['id'] = $data['id'];
           updateLastLogin($_SESSION['id']);
           $page = htmlspecialchars($_POST['page']);
           header('Location:' . $page);
         } else {
           error_message('Le mot de passe n\'est pas correct');

         }
       } else {
         error_message('Le pseudo n\'existe pas');
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
          <form method="post" action="" id="article_form">
            <input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
            <label for="username">Pseudo
              <input name="username" class="input_form" type="text" id="username" tabindex="1">
            </label>
            <label for="password">Mot de Passe
              <input type="password" name="password" id="password" tabindex="2">
            </label>
            <div id="connection_btn_bloc">
              <input class="button" type="submit" value="Connexion">
              <input class="button" type="button" value="S'inscrire">
            </div>
          </form>
          <!--<a href="./register.php">Pas encore inscrit ?</a>-->
        </fieldset>
    </div>
  </div>

<?php

   include "tpl/footer.php";

?>
