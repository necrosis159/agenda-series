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
  <h5 class="heading">Formulaire Contact </h5>
  <div class="form_account_bloc">
    <form action="" method="POST" id="article_form">
      <label for="nom">Nom
      <input type='text' id='nom' name='nom' class="input_form" placeholder='Nom' size="30" maxlength="50" value='<?php if (isset($nom)) echo $nom ?>'>
      </label>

      <label for="prenom">Prénom
      <input type='text' id='prenom' name='prenom' class="input_form" placeholder='Prénom' size="30" maxlength="50" value='<?php if (isset($prenom)) echo $prenom ?>'>
      </label>

      <label for="email">Adresse Mail
      <input type='email' id='email' name='email' class="input_form" placeholder='exemple@exemple.com' size="30" value='<?php if (isset($email)) echo $email ?>'>
      </label>

      <label for="messageForm">Votre message
      <textarea rows="6" id='messageForm' name='messageForm' class="input_form" placeholder='Votre message (Maximum 1000 caractères)' size="30" maxlength="1000"><?php if (isset($messageForm)) echo $messageForm ?></textarea>
      </label>
      <div class="g-recaptcha" data-sitekey="6LdmCgoTAAAAAATpLzVe055r2o6osymaYs1p5O5J"></div>

      <input class="button" type='submit' id='submit' name='submit' value='Envoyer'>
    </form>
  </div>
</div>