<?php

class AccountController extends baseView {

    public function index() {
        $this->render("account/login");
    }

    public function login() {

        if (isset($_SESSION['user_id'])) {
            $this->redirect("index", "");
        }
        $this->render("account/login");
    }
    
    public function logout() {
        session_destroy();
        $this->redirect("index", "");
    }

    public function checkLogin() {

        $message = "";

        if (isset($_GET['error'])) {
            $message = $this->error_message("Vous devez vous connecter !");
        }

        // Fonction pour les requêtes avec en parametre les $_POST
        if (isset($_POST['username'])) {

            if (empty($_POST['username']) || empty($_POST['password'])) {
                $message = $this->error_message('Vous devez renseigner tous les champs');
            } else {
                $username = $_POST["username"];

                $model_user = new User();
                $data = $model_user->getUserByUsername($username);
                if ($data != 0) {
                    if ($data[0]['user_password'] == md5($_POST['password'])) {
                        $_SESSION['user_status'] = $data[0]['user_status'];
                        $_SESSION['user_id'] = $data[0]['user_id'];
                        $data_update = array("user_last_login" => date("Y-m-d H:i:s"));
                        $model_user->updateLastLogin($data_update, $data[0]['user_id']);
                        $page = htmlspecialchars($_POST['page']);
                        $this->redirect("index", "");
                    } else {
                        $message = $this->error_message('Le mot de passe n\'est pas correct');
                    }
                } else {
                    $message = $this->error_message('Le pseudo n\'existe pas');
                }
            }
        }
        $this->assign("message", $message);
        $this->render("account/login");
    }

    public function register() {

        if (isset($_SESSION['user_id'])) {
            $this->redirect("index", "");
        }
        
        // Test des champs du formulaire à l'envoi
        if (isset($_POST["submit"])) {
            $model_user = new User();
            $arrayErrors = array();
            $message = "";
            // On vérifie qu'aucun champ du formulaire n'a été ajouté par l'utilisateur
            $liste_champs = array("gender", "name", "surname", "email", "username", "password", "password_confirm", "birthdate", "submit");
            if (count(array_diff($liste_champs, array_keys($_POST))) === 0) {
                $error = 0;

                // On affecte chaque champ du formulaire à une variable
                $gender = trim($_POST['gender']);
                $name = trim($_POST['name']);
                $surname = trim($_POST['surname']);
                $email = trim($_POST['email']);
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $password_confirm = trim($_POST['password_confirm']);
                $birthdate = trim($_POST['birthdate']);

                // Champ name
                if (empty($name) || strlen($name) > 50) {
                    $arrayErrors[] = "Le nom n'est pas valide";
                    $error ++;
                }

                // Champ Prénom
                if (empty($surname) || strlen($surname) > 50) {
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
                    // On vérifie si le mail existe dans la bdd
                    $result = $model_user->isEmailExists($email);
                    if ($result == 1) {
                        $arrayErrors[] = "Le mail existe déjà";
                        $error ++;
                    }
                } else {
                    $arrayErrors[] = "Le mail n'est pas valide";
                    $error ++;
                }

                // Champ pseudo
                if (!empty($username) && strlen($username) >= 4 && strlen($username) <= 50) {
                    // On vérifie si le pseudo existe dans la bdd
                    $result = $model_user->isUsernameExists($username);
                    if ($result == 1) {
                        $arrayErrors[] = "Le pseudo existe déjà";
                        $error ++;
                    }
                } else {
                    $arrayErrors[] = "Le pseudo n'est pas valide";
                    $error ++;
                }

                // Champ password
                if (empty($password) || ctype_digit($password) || ctype_alpha($password) || strlen($password) < 5) {
                    $arrayErrors[] = "Le mot de passe n'est pas valide";
                    $error ++;
                } else { // Champ password_confirm
                    if (empty($password) || $password != $password_confirm) {
                        $arrayErrors[] = "Les 2 mots de passe ne sont pas identiques";
                        $error ++;
                    }
                }

                // Champ date
                if (!empty($birthdate)) {
                    // format dd/mm/yyyy
                    if (preg_match("/^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[\/]\d{4}$/", $birthdate) === 1) {
                        $birthdate_explode = explode("/", $birthdate);
                        if (checkdate($birthdate_explode["1"], $birthdate_explode["0"], $birthdate_explode["2"])) {
                            $birthdateFormat = $birthdate_explode['2'] . "-" . $birthdate_explode["1"] . "-" . $birthdate_explode["0"];
                        } else {
                            $arrayErrors[] = "La date indiquée n'existe pas";
                            $error ++;
                        }
                    }
                    // format dd-mm-yyyy
                    elseif (preg_match("/^(0?[1-9]|[12][0-9]|3[01])[\-](0?[1-9]|1[012])[\-]\d{4}$/", $birthdate)) {
                        $birthdate_explode = explode("-", $birthdate);
                        if (checkdate($birthdate_explode["1"], $birthdate_explode["0"], $birthdate_explode["2"])) {
                            $birthdateFormat = $birthdate_explode['2'] . "-" . $birthdate_explode["1"] . "-" . $birthdate_explode["0"];
                        } else {
                            $arrayErrors[] = "La date indiquée n'existe pas";
                            $error ++;
                        }
                    }
                    // format yyyy-mm-dd
                    elseif (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $birthdate)) {
                        $birthdate_explode = explode("-", $birthdate);
                        if (checkdate($birthdate_explode["1"], $birthdate_explode["2"], $birthdate_explode["0"])) {
                            $birthdateFormat = $birthdate;
                        } else {
                            $arrayErrors[] = "La date indiquée n'existe pas";
                            $error ++;
                        }
                    } else {
                        $arrayErrors[] = "La date n'est pas dans un format valide";
                        $error ++;
                    }
                    // si la date est vide
                } else {
                    $arrayErrors[] = "La date de naissance n'est pas valide";
                    $error ++;
                }

                // Si il y a une erreur on retourne le message d'erreur sinon on insert dans la bdd
                if ($error == 0) {
                    $data_insert = array(
                        "user_gender" => $gender, 
                        "user_name" => $name, 
                        "user_surname" => $surname, 
                        "user_email" => $email, 
                        "user_username" => $username, 
                        "user_password" => md5($password), 
                        "user_birthdate" => $birthdateFormat
                    );
                    $model_user->addUser($data_insert);
                    $message = $this->valid_message("Inscription réussie");
                }
            } else {
                $message = $this->error_message("Une erreur s'est produite !");
            }
            // On passe les infos entrées par l'utilisateur à la vue pour ne pas les perdre s'il se trompe dans le formulaire
            $this->assign("gender", $gender);
            $this->assign("name", $name);
            $this->assign("surname", $surname);
            $this->assign("email", $email);
            $this->assign("username", $username);
            $this->assign("birthdate", $birthdate);
            $this->assign("arrayErrors", $arrayErrors);
            $this->assign("message", $message);
        }
        
        
        $this->render("account/register");
    }

}
