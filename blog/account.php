<?php
$title="Connexion";
include ("includes/pdo.php");
include("includes/header.php");
include("includes/menu.php");

$query = $db->prepare("SELECT * FROM users
                       WHERE id = '".$_SESSION['id']."'
                       ORDER BY id");
$query->execute();

while($data = $query->fetch()) {
    $gender = $data["gender"];
    $name = $data["name"];
    $surname = $data["surname"];
    $email = $data["email"];
    $pseudo = $data["pseudo"];
    $password = $data["password"];
    $birthdate = $data["birthdate"];
}

?>
<section id="account">
	<h1>Mon Compte</h1>
            <form action="" method="POST" id='form_account'>
                <p>
                    <label for="gender">Genre</label>
                    <?php 
                        if($gender == 0) {
                            echo "<input type='radio' name='gender' value='0' checked> Masculin";
                            echo "<input type='radio' name='gender' value='1'> Féminin";
                        } else {
                            echo "<input type='radio' name='gender' value='0'> Masculin";
                            echo "<input type='radio' name='gender' value='1' checked> Féminin";
                        }
                    ?>
                </p>
                <p>
                    <label for="name">Nom</label>
                    <input type='text' id='name' name='name' class="input_form" placeholder='Nom' size="30" maxlength="50" value='<?php if(isset($name)) echo $name ?>'>
                </p>
                <p>
                    <label for="surname">Prénom</label>
                    <input type='text' id='surname' name='surname' class="input_form" placeholder='Prénom' size="30" maxlength="50" value='<?php if(isset($surname)) echo $surname ?>'>
                </p>
                <p>
                    <label for="email">Adresse Mail</label>
                    <input type='email' id='email' name='email' class="input_form" placeholder='exemple@exemple.com' size="30" value='<?php if(isset($email)) echo $email ?>'>
                </p>
                <p>
                    <label for="pseudo">Pseudo</label>
                    <input type='text' id='pseudo' name='pseudo' class="input_form" placeholder='Pseudo' size="30" maxlength="50" value='<?php if(isset($pseudo)) echo $pseudo ?>'>
                </p>
                <p>
                    <label for="password">Mot de passe</label>
                    <input type='password' id='password' name='password' class="input_form" placeholder='Mot de passe' size="30" maxlength="8" value=''>
                </p>
                <p>
                    <label for="password_confirm">Confirmation mot de passe</label>
                    <input type='password' id='password_confirm' name='password_confirm'  class="input_form"placeholder='Confirmation' maxlength="8" size="30">
                </p>
                <p>
                    <label for="birthdate">Date de naissance</label>
                    <input type="date" id="birthdate" name="birthdate" size="30"  class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10" value='<?php if(isset($birthdate)) echo $birthdate ?>'>
                </p>
                <p>
                    * Champs obligatoires
                </p>
                <p >
                    <input type='submit' id='submit' name='submit' value='Modifier'>
                </p>
            </form>
        </div>
</section>