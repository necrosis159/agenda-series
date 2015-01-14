<?php
include"tpl/header.php";
include"tpl/menu.php";
include"tpl/pdo.php";
$title="Inscription";

// Test des champs du formulaire à l'envoi
if (isset($_POST["submit"])) {
    $arrayErrors = array();
    // On vérifie qu'aucun champ du formulaire n'a été ajouté par l'utilisateur
    $liste_champs = array("gender", "name", "surname", "email", "pseudo", "password", "password_confirm", "birthdate", "submit");
    if (count(array_diff($liste_champs, array_keys($_POST))) === 0) {
        $error = 0;

        // On affecte chaque champ du formulaire à une variable
        $gender = trim($_POST['gender']);
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $email = trim($_POST['email']);
        $pseudo = trim($_POST['pseudo']);
        $password = trim($_POST['password']);
        $password_confirm = trim($_POST['password_confirm']);
        $birthdate = trim($_POST['birthdate']);

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
        if(!empty($name) && !empty($surname) && $name == $surname) {
            $arrayErrors[] = "Le prénom et le nom sont identiques";
            $error ++;
        }

        // Champ email
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // On vérifie si le mail existe dans la bdd
            $query = $db->prepare("SELECT email FROM user where email = '".$email."'");
            $query->execute();
            if($query->rowCount() > 0) {
                $arrayErrors[] = "Le mail existe déjà";
                $error ++;
            }
            $query->closeCursor();
        } else {
            $arrayErrors[] = "Le mail n'est pas valide";
            $error ++;
        }

        // Champ pseudo
        if (!empty($pseudo) && strlen($pseudo) >= 4 && strlen($pseudo) <= 50) {
            // On vérifie si le pseudo existe dans la bdd
            $query = $db->prepare("SELECT pseudo FROM user where pseudo = '".$pseudo."'");
            $query->execute();
            if($query->rowCount() > 0) {
                $arrayErrors[] = "Le pseudo existe déjà";
                $error ++;
            }
            $query->closeCursor();
        } else {
            $arrayErrors[] = "Le pseudo n'est pas valide";
            $error ++;
        }

        // Champ password
        if (empty($password) || preg_match("/^(?=.*\d)(?=.*[A-Z]).{4,8}$/", $password) === 0) {
            $arrayErrors[] = "Le mot de passe n'est pas valide";
            $error ++;
        } else {
            // Champ password_confirm
            if(empty($password_confirm) || preg_match("/^(?=.*\d)(?=.*[A-Z]).{4,8}$/", $password_confirm) === 0 || $password!=$password_confirm) {
                $arrayErrors[] = "Les 2 mots de passe ne sont pas identiques";
                $error ++;
            }
        }

        // Champ date
        if (!empty($birthdate)) {
            // format dd/mm/yyyy
            if(preg_match("/^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[\/]\d{4}$/", $birthdate) === 1) {
                $birthdate_explode = explode("/", $birthdate);
                if(checkdate($birthdate_explode["1"], $birthdate_explode["0"], $birthdate_explode["2"])) {
                    $birthdateFormat = $birthdate_explode['2']."-".$birthdate_explode["1"]."-".$birthdate_explode["0"];
                } else {
                    $arrayErrors[] = "La date indiquée n'existe pas";
                    $error ++;
                }
            }
            // format dd-mm-yyyy
            elseif (preg_match("/^(0?[1-9]|[12][0-9]|3[01])[\-](0?[1-9]|1[012])[\-]\d{4}$/", $birthdate)) {
                $birthdate_explode = explode("-", $birthdate);
                if(checkdate($birthdate_explode["1"], $birthdate_explode["0"], $birthdate_explode["2"])) {
                    $birthdateFormat = $birthdate_explode['2']."-".$birthdate_explode["1"]."-".$birthdate_explode["0"];
                } else {
                    $arrayErrors[] = "La date indiquée n'existe pas";
                    $error ++;
                }
            }
            // format yyyy-mm-dd
            elseif (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $birthdate)) {
                $birthdate_explode = explode("-", $birthdate);
                if(checkdate($birthdate_explode["1"], $birthdate_explode["2"], $birthdate_explode["0"])) {
                    $birthdateFormat = $birthdate;
                } else {
                    $arrayErrors[] = "La date indiquée n'existe pas";
                    $error ++;
                }
            }
            else {
                $arrayErrors[] = "La date n'est pas dans un format valide";
                $error ++;
            }
        // si la date est vide
        } else {
            $arrayErrors[] = "La date de naissance n'est pas valide";
            $error ++;
        }

        // Si il y a une erreur on retourne le message d'erreur sinon on insert dans la bdd
        if ($error > 0) {
            array_unshift($arrayErrors, "Formulaire invalide");
        } else {
            $query = $db->prepare("INSERT into user(gender, name, surname, email, pseudo, password, birthdate)
                                    VALUES(".$gender.", '".ucfirst($name)."', '".ucfirst($surname)."', '".$email."', '".$pseudo."', '".$password."', '".$birthdateFormat."')");
            $query->execute();
        }
    } else {
        $arrayErrors[] = "Petit coquinou qui essaye d'insérer des champs :o";
    }
}
?>
        <div id='formulaire_inscription'>
            <div id="erreurFormulaire">
                <?php
                if(isset($_POST["submit"])) {
                    if(count($arrayErrors) > 0) {
                        foreach ($arrayErrors as $row) {
                            echo $row;
                            echo "<br/>";
                        }
                    }
                }
                ?>
            </div>
            <h1>Inscription</h1>
            <form action="" method="POST" id='form_register'>
                <p>
                    <label for="gender">Genre</label>
                    <input type='radio' name='gender' value='0' checked> Masculin
                    <input type='radio' name='gender' value='1'> Féminin
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
                    <input type='email' id='email' name='email' class="input_form" placeholder='exemple@exemple.com' size="30" value='<?php if(isset($email)) echo $email ?>'> *
                </p>
                <p>
                    <label for="pseudo">Pseudo</label>
                    <input type='text' id='pseudo' name='pseudo' class="input_form" placeholder='Pseudo' size="30" maxlength="50" value='<?php if(isset($pseudo)) echo $pseudo ?>'> *
                </p>
                <p>
                    <label for="password">Mot de passe</label>
                    <input type='password' id='password' name='password' class="input_form" placeholder='Mot de passe' size="30" maxlength="8" value='<?php if(isset($password)) echo $password ?>'> *
                </p>
                <p>
                    <label for="password_confirm">Confirmation mot de passe</label>
                    <input type='password' id='password_confirm' name='password_confirm'  class="input_form"placeholder='Confirmation' maxlength="8" size="30"> *
                </p>
                <p>
                    <label for="birthdate">Date de naissance</label>
                    <input type="date" id="birthdate" name="birthdate" size="30"  class="input_form" placeholder="JJ/MM/AAAA ou JJ-MM-AAAA" maxlength="10" value='<?php if(isset($birthdate)) echo $birthdate ?>'> *
                </p>
                <p>
                    * Champs obligatoires
                </p>
                <p >
                    <input type='submit' id='submit' name='submit' value='Envoyer'>
                </p>
            </form>
        </div>

<?php

   include("tpl/footer.php");

?>