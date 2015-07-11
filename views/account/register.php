<?php
if (isset($message) && !empty($message)) {
    echo $message;
}
?>
<div id="erreurFormulaire">
    <?php
    if (isset($_POST["submit"])) {
        if (isset($arrayErrors) && count($arrayErrors) > 0) {
            echo $arrayErrors[0];
        }
    }
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
