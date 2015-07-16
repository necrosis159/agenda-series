<?php

class UserController extends baseView {

    public function index() {
        $this->render("userInsert");
    }

    public function show($name, $surname) {

        $user = new User();
        $resultat = $user->select()
                ->from(array("u" => "user"), array("user_id", "user_surname", "user_name"))
//			 ->where('user_name', "=", $name)
//			 ->andWhere('user_surname', "=", $surname)
                ->execute();
        $this->assign('user', $resultat)
                ->render("userShow");
    }

    public function test() {
        $model_user = new User();
//        $result = $model_user->test();
        $result = $model_user->searchSeriesFromUser("10", "bre");
        var_dump($result);die();
    }

    public function insert() {

        $tab['user_name'] = $_POST['name'];
        $tab['user_surname'] = $_POST['surname'];
        $tab['user_avatar'] = "avatar/83fb6ef6170818216cb140fd7f04ce2d.png";
        $tab['user_gender'] = 1;
        $tab['user_presentation'] = "bonjour";
        $tab['user_username'] = "testMVC";
        //Pensez a encoder le password
        $tab['user_password'] = md5("testMVCpw");
        $tab['user_email'] = "test@mvc.fr";
        $tab['user_birthdate'] = '0000-00-00';
        $tab['user_creation_date'] = '0000-00-00';
        $tab['user_last_login'] = '0000-00-00';
        $tab['user_status'] = 2;

        $user->insert($tab);
    }
    public function userlist() {

      if((!isset($_SESSION['user_status'])) || ($_SESSION['user_status'] != 1)) {
          $this->redirect("index", "");
      }

        $content = null;
        $username = "";
        $oldusername = "";
        $id = "";
        $oldid = "";

        if(isset($_GET["username"]) && $_GET["username"] != "") {
            $username = $_GET["username"];
            $oldusername = $_GET["username"];
        }

        if(isset($_GET["id"]) && $_GET["id"] != "") {
            $id = $_GET["id"];
            $oldid = $_GET["id"];
        }
        $admin = new Admin();

        $content = $admin->_searchUser($id, $username);


        $this->assign("oldid", $oldid);
        $this->assign("oldusername", $oldusername);
        $this->assign("content", $content);
        $this->render("admin/listprofile");
    }

    public function edit($id) {

        if((!isset($_SESSION['user_status'])) || ($_SESSION['user_status'] != 1)) {
          $this->redirect("index", "");
        }
        $model_user = new User();

        // Test des champs du formulaire à l'envoi
            $arrayErrors = array();
            $data = array();
            // On vérifie qu'aucun champ du formulaire n'a été ajouté par l'utilisateur
            $liste_champs = array("id", "name", "surname", "username", "email", "password", "password_confirm", "status", "newsletter", "submit");
            if (count(array_diff($liste_champs, array_keys($_POST))) === 0) {
                $error = 0;

                // On affecte chaque champ du formulaire à une variable
                $name = trim($_POST['name']);
                $surname = trim($_POST['surname']);
                $id = trim($_POST['id']);
                $username = trim($_POST['username']);
                $status = trim($_POST['status']);
                $email = trim($_POST['email']);
                $newsletter = trim($_POST['newsletter']);


                // Champ id
                if (strlen($id) > 1000) {
                    $arrayErrors[] = "L'ID n'est pas valide";
                    $error ++;
                }
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

                // Champ Username
                if (strlen($username) > 50) {
                    $arrayErrors[] = "L'username n'est pas valide";
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

                // Champ Status
                if (strlen($status) > 3) {
                    $arrayErrors[] = "Le status n'est pas valide";
                    $error ++;
                }

                // Champ Newsletter
                if (strlen($newsletter) > 50) {
                    $arrayErrors[] = "L'id de la newsletter n'est pas valide";
                    $error ++;
                }

                // Si il y a une erreur on retourne le message d'erreur sinon on insert dans la bdd
                if ($error > 0) {
                    array_unshift($arrayErrors, "Formulaire invalide");
                } else {
                    $data["user_id"] = $id;
                    $data["user_name"] = $name;
                    $data["user_surname"] = $surname;
                    $data["user_username"] = $username;
                    $data["user_status"] = $status;
                    $data["user_email"] = $email;
                    $data["user_newsletter"] = $newsletter;

                    $model_user->updateUser($id, $data);
                    $message = $this->validMessage("Modifications effectuées");
                    $this->assign("message", $message);
                }
            } else {
                $arrayErrors[] = "Erreur lors de l'envoie des données";
            }
            $this->assign("arrayErrors", $arrayErrors);
        $result = $model_user->getUserById($id);

        $id = $result["user_id"];
        $name = $result["user_name"];
        $surname = $result["user_surname"];
        $username = $result["user_username"];
        $status = $result["user_status"];
        $email = $result["user_email"];
        $newsletter = $result["user_newsletter"];


        $this->assign("result", $result);
        $this->assign("id", $id);
        $this->assign("name", $name);
        $this->assign("surname", $surname);
        $this->assign("username", $username);
        $this->assign("status", $status);
        $this->assign("email", $email);
        $this->assign("newsletter", $newsletter);
        $this->render("admin/edituser");

        }

}
