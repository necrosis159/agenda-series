<?php if(isset($message)) echo $message;?>

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
  <h5 class="heading">Utilisateur : <?php if (isset($username)) echo $username ?> </h5>
  <div class="form_account_bloc">
    <form action="" method="POST" id="article_form">

      <label for="id">ID
      <input type='text' id='id' name='id' class="input_form" placeholder='ID' size="30" maxlength="50" value='<?php if (isset($id)) echo $id ?>'>
      </label>

      <label for="name">Nom
      <input type='text' id='name' name='name' class="input_form" placeholder='Nom' size="30" maxlength="50" value='<?php if (isset($name)) echo $name ?>'>
      </label>

      <label for="surname">Prénom
      <input type='text' id='surname' name='surname' class="input_form" placeholder='Prénom' size="30" maxlength="50" value='<?php if (isset($surname)) echo $surname ?>'>
      </label>

      <label for="username">Username
      <input type='text' id='username' name='username' class="input_form" placeholder='Username' size="30" maxlength="50" value='<?php if (isset($username)) echo $username ?>'>
      </label>

      <label for="email">Adresse Mail
      <input type='email' id='email' name='email' class="input_form" placeholder='exemple@exemple.com' size="30" value='<?php if (isset($email)) echo $email ?>'>
      </label>

      <label for="password">Mot de passe
      <input type='password' id='password' name='password' class="input_form" placeholder='Mot de passe' size="30" maxlength="20" value=''>
      </label>

      <label for="password_confirm">Confirmation mot de passe
      <input type='password' id='password_confirm' name='password_confirm'  class="input_form"placeholder='Confirmation' maxlength="20" size="30">
      </label>

      <label for="status">Status<br>
      <select name="status">
        <option <?php if($status == "0") { echo "selected"; } ?> value="0">Utilisateur</option>
        <option <?php if($status == "1") { echo "selected"; } ?> value="1">Administrateur</option>
        <option <?php if($status == "2") { echo "selected"; } ?> value="2">Suspendu</option>
      </select><br>

      <label for="newsletter">Inscription newsletter<br>
      <select name="newsletter">
        <option <?php if($newsletter == "0") { echo "selected"; } ?> value="0">Non</option>
        <option <?php if($newsletter == "1") { echo "selected"; } ?> value="1">Oui</option>
      </select><br>
      </label>

      <input class="button" type='submit' id='submit' name='submit' value='Modifier'>
    </form>
  </div>
</div>

