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
            $message = $this->errorMessage("Vous devez vous connecter !");
        }

        // Fonction pour les requêtes avec en parametre les $_POST
        if (isset($_POST['username'])) {

            if (empty($_POST['username']) || empty($_POST['password'])) {
                $message = $this->errorMessage('Vous devez renseigner tous les champs');
            } else {
                $username = $_POST["username"];

                $model_user = new User();
                $data = $model_user->getUserByUsername($username);
                if (!empty($data)) {
                    if ($data['user_password'] == md5($_POST['password'])) {
                        $_SESSION['user_status'] = $data['user_status'];
                        $_SESSION['user_id'] = $data['user_id'];
                        $data_update = array("user_last_login" => date("Y-m-d H:i:s"));
                        $model_user->updateUser($data['user_id'], $data_update);
                        $page = htmlspecialchars($_POST['page']);
                        $this->redirect("index", "");
                    } else {
                        $message = $this->errorMessage('Le mot de passe n\'est pas correct');
                    }
                } else {
                    $message = $this->errorMessage('Le pseudo n\'existe pas');
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
                if (!empty($name) && !empty($surname) && !empty($username) && (mb_strtolower($name) == mb_strtolower($surname) || mb_strtolower($name) == mb_strtolower($username) || mb_strtolower($username) == mb_strtolower($surname) )) {
                    $arrayErrors[] = "Le nom, prénom et pseudo doivent être différents";
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
                    $arrayErrors[] = "Le mot de passe doit contenir 1 chiffre minimum";
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
                    $message = $this->validMessage("Inscription réussie");
                }
            } else {
                $message = $this->errorMessage("Une erreur s'est produite !");
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

    public function profile() {
        $model_user = new User();
        $result = $model_user->getUserById($_SESSION['user_id']);
        $message = "";

        $explode_birthdate = explode('-', $result['user_birthdate']);
        $birthdate = $explode_birthdate[1] . '/' . $explode_birthdate[0] . '/' . $explode_birthdate[2];
        $avatar = $result['user_avatar'];

        $maxsize = ini_get("upload_max_filesize");
        $maxsize_octet = 1024 * 1024 * str_replace("M", "", $maxsize);

        $this->assign("maxsize", $maxsize);
        $this->assign("maxsize_octet", $maxsize_octet);

//Création d'un tableau php avec les extensions valides
        $extensions_valides = array('jpg', 'jpeg', 'png');
//chemin en relatif d'upload
//      $upload_directory = "./uploads";
        $upload_directory = '/images/avatar';
        $fonts_directory = '/fonts';

// Quand l'utilisateur envoie le formulaire
        if (isset($_POST["submit"])) {
            //Est-ce que le fichier image existe
            if (isset($_FILES['image'])) {

                if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                    if ($_FILES['image']['size'] > $maxsize_octet) {
                        echo "Le fichier est trop gros";
                        $message = $this->errorMessage("Le fichier est trop gros");
                    } else {
//        if (isset($_POST['description']) && trim($_POST['description']) != "") {
                        $error = 0;
                        // Vérification de l'extension du fichier
                        $parse_name = explode(".", $_FILES['image']['name']);
                        $extension_upload = strtolower(end($parse_name));
                        if (in_array($extension_upload, $extensions_valides)) {
                            // Si le dossier d'upload n'existe pas on le crée
                            if (!file_exists($upload_directory)) {
                                mkdir($upload_directory);
                            }
                            // Création d'un nom unique pour le fichier
                            $nom = md5(uniqid(rand(), true)) . "." . end($parse_name);
                            // ici on fait tout
                            // On transfert le fichier dans le répertoire d'upload
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_directory . "/" . $nom)) {
                                // Création de l'image en fonction de l'extension
                                if ($extension_upload == "png") {
                                    $image = imagecreatefrompng($upload_directory . "/" . $nom);
                                    // $image = imagecreatefrompng($_FILES['image']['tmp_name']);
                                } else {
                                    $image = imagecreatefromjpeg($upload_directory . "/" . $nom);
                                    // $image = imagecreatefrompng($_FILES['image']['tmp_name']);
                                }


                                // Récup données formulaires
                                // Texte à écrire sur l'image
//                                $texte = $_POST["description"];
//                                echo $texte;
//                                // Taile de la police
//                                if (is_numeric($_POST["font_size"])) {
//                                    $font_size = $_POST["font_size"];
//                                } else {
//                                    $error ++;
//                                }
//
//                                // Récupération de la police avec le style choisis
//                                $bold = "";
//                                $italic = "";
//                                if (isset($_POST["font_bold"]) && $_POST["font_bold"] == "on") {
//                                    $bold .= "b";
//                                }
//                                if (isset($_POST["font_italic"]) && $_POST["font_italic"] == "on") {
//                                    $italic .= "i";
//                                }
//
//                                $font = $fonts_directory . "/" . $_POST["font"] . $bold . $italic . ".ttf";
//
//                                // Couleur du texte
//                                $font_color = hexdec($_POST["font_color"]);
//
//                                // Cadre autour du texte
//                                $bbox = imageftbbox($font_size, 0, $font, $texte);
//
//                                // Abscisse du cadre
//                                switch ($_POST["font_position_x"]) {
//                                    case 'gauche':
//                                        $x = $bbox[0] + (imagesx($image) * 0.05);
//                                        break;
//                                    case 'milieu':
//                                        $x = $bbox[0] + (imagesx($image) / 2) - ($bbox[4] / 2) - 5;
//                                        break;
//                                    case 'droite':
//                                        $x = imagesx($image) - ((imagesx($image) * 0.05) + $bbox[4]);
//                                        break;
//                                    default:
//                                        $error ++;
//                                        break;
//                                }
//
//                                // Ordonnée du cadre
//                                switch ($_POST["font_position_y"]) {
//                                    case 'haut':
//                                        $y = $bbox[0] + (imagesy($image) * 0.10);
//                                        break;
//                                    case 'milieu':
//                                        $y = $bbox[1] + (imagesy($image) / 2) - ($bbox[5] / 2) - 5;
//                                        break;
//                                    case 'bas':
//                                        $y = imagesy($image) - ((imagesy($image) * 0.10) + $bbox[3]);
//                                        ;
//                                        break;
//                                    default:
//                                        $error ++;
//                                        break;
//                                }
//
//                                // Rotation du texte en degrés
//                                if (isset($_POST["rotation"]) && is_numeric($_POST["rotation"])) {
//                                    $rotation = intval($_POST["rotation"]);
//                                } else {
//                                    $rotation = 0;
//                                }
                                // Tous les pramamètres sont bons, il n'y a pas d'erreur
                                if ($error < 1) {

                                    putenv('GDFONTPATH=' . realpath('.'));
//                                    imagettftext($image, $font_size, $rotation, $x, $y, $font_color, $font, $texte);
                                    imagepng($image, $upload_directory . "/" . $nom);
//                echo "<br/>Prévisualisation - ";
//                echo "<a href=\"download.php?file=" . $nom . "&root=" . $upload_directory . "/\">Télécharger</a>";
//                echo "<br/><br/>";
//                echo "<img src='" . $upload_directory . "/" . $nom . "' width='200px' height='200px'>";
                                    $data = array("user_avatar" => 'avatar/' . $nom);
                                    $model_user->updateUser($_SESSION['user_id'], $data);
                                    $newAvatarUrl = 'avatar/' . $nom;
                                    $error = -1;
                                } else {
                                    $message = $this->errorMessage("Erreur de paramètres du texte");
                                }
                            } else {
                                $message = $this->errorMessage("Transfert echec");
                            }
                        } else {
                            $message = $this->errorMessage("Extension incorrecte");
                        }
                        //} 
//        else {
//          echo $upload_directory . "/" . $nom; 
//          updateAvatar();
//          validMessage('Avatar modifié');
//        }
                    }
                } else {
                    switch ($_FILES['image']['error']) {
                        case UPLOAD_ERR_NO_FILE:
                            $message = $this->errorMessage("Fichier manquant");
                            break;
                        case UPLOAD_ERR_INI_SIZE:
                            $message = $this->errorMessage("Fichier dépassant la taille maximale autorisée par PHP");
                            break;
                        case UPLOAD_ERR_FORM_SIZE:
                            $message = $this->errorMessage("Fichier dépassant la taille maximale autorisée par le formulaire");
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            $message = $this->errorMessage("Fichier transféré partiellement");
                            break;
                        default:
                            $message = $this->errorMessage("Erreur inconnue ...");
                            break;
                    }
                }
            }
        }

        if (isset($error) && $error == -1) {
            $message = $this->validMessage('Avatar modifié');
        }
        if (isset($newAvatarUrl)) {
            $avatar = $newAvatarUrl;
        }

        $nb_series_follow = $model_user->rowCountByIdUser($_SESSION["user_id"], "serie_user", "su_id_user");
        $nb_comments_posted = $model_user->rowCountByIdUser($_SESSION["user_id"], "comment", "comment_id_user");

        $this->assign("nb_series_follow", $nb_series_follow);
        $this->assign("nb_comments_posted", $nb_comments_posted);

        $age = $model_user->age($result["user_birthdate"]);
        $result["user_creation_date"] = $this->dateConvert($result["user_creation_date"]);
        $this->assign("result", $result);
        $this->assign("age", $age);
        $this->assign("message", $message);
        $this->render("account/profile");
    }

    public function edit() {

        $model_user = new User();


        // Test des champs du formulaire à l'envoi
        if (isset($_POST["submit"])) {
            $arrayErrors = array();
            $data = array();
            // On vérifie qu'aucun champ du formulaire n'a été ajouté par l'utilisateur
            $liste_champs = array("gender", "name", "surname", "email", "password", "password_confirm", "submit");
            if (count(array_diff($liste_champs, array_keys($_POST))) === 0) {
                $error = 0;

                // On affecte chaque champ du formulaire à une variable
                $gender = trim($_POST['gender']);
                $name = trim($_POST['name']);
                $surname = trim($_POST['surname']);
                $email = trim($_POST['email']);

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
                if (!empty($name) && !empty($surname) && mb_strtolower($name) == mb_strtolower($surname)) {
                    $arrayErrors[] = "Le prénom et le nom sont identiques";
                    $error ++;
                }

                // Champ email
                if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // On vérifie si le mail existe dans la bdd et que ce n'est pas le mail de l'utilisateur
                    $result = $model_user->isEmailExistsWhenUpdate($_SESSION['user_id'], $email);
                    if ($result != 0) {
                        $arrayErrors[] = "Le mail existe déjà";
                        $error ++;
                    }
                }

                // Champ password
                $password = trim($_POST["password"]);
                if (!empty($password)) {
                    $password = trim($_POST['password']);
                    $password_confirm = trim($_POST['password_confirm']);
                    if (empty($password) || ctype_digit($password) || ctype_alpha($password) || strlen($password) < 5) {
                        $arrayErrors[] = "Le mot de passe doit contenir 1 chiffre minimum";
                        $error ++;
                    } else {
                        if ($password != $password_confirm) {
                            $arrayErrors[] = "Les 2 mots de passe ne correspondent pas";
                            $error++;
                        } else {
                            $password = $_POST["password"];
                            $data["user_password"] = md5($password);
                        }
                    }
                }

                // Si il y a une erreur on retourne le message d'erreur sinon on insert dans la bdd
                if ($error > 0) {
                    array_unshift($arrayErrors, "Formulaire invalide");
                } else {
                    $data["user_gender"] = $gender;
                    $data["user_name"] = $name;
                    $data["user_surname"] = $surname;
                    $data["user_email"] = $email;
                    $model_user->updateUser($_SESSION['user_id'], $data);
                    $message = $this->validMessage("Modifications effectuées");
                    $this->assign("message", $message);
                }
            } else {
                $arrayErrors[] = "Erreur lors de l'envoie des données";
            }
            $this->assign("arrayErrors", $arrayErrors);
        }
        $result = $model_user->getUserById($_SESSION['user_id']);

        $id = $result["user_id"];
        $gender = $result["user_gender"];
        $name = $result["user_name"];
        $surname = $result["user_surname"];
        $email = $result["user_email"];

        $this->assign("id", $id);
        $this->assign("gender", $gender);
        $this->assign("name", $name);
        $this->assign("surname", $surname);
        $this->assign("email", $email);
        $this->render("account/edit");
    }

    public function series() {
        $model_user = new User();
        $series_user = $model_user->getSeriesByUser($_SESSION["user_id"]);
        if (!isset($series_user[0])) {
            $data = array();
            $data[] = $series_user;
            $this->assign("data", $data);
        } else {
            $this->assign("data", $series_user);
        }

        $this->render("account/series");
    }

    public function ajaxSearchSeriesByName() {
        $model_user = new User();
        $result = $model_user->searchSeriesFromUser($_SESSION['user_id'], $_GET['term']);
        $data = array();
        
        if (!isset($result[0])) {
            $results = array();
            $results[] = $result;
            foreach ($results as $serie) {
                $data[] = $serie['serie_name'];
            }
        } else {
            foreach ($result as $serie) {
                $data[] = $serie['serie_name'];
            }
        }

        echo json_encode($data);
    }

    public function ajaxAddSerieToUser() {
        $serie_name = $_GET["serie_name"];
        $model_serie = new Serie();
        $model_user = new User();
        $serie_id = $model_serie->getIdSerieByName($serie_name);
        $model_user->addSerieToUser($serie_id["serie_id"], $_SESSION["user_id"]);
        
    }

}
