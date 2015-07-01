<?php

class AccountController extends baseView {

    public function index() {
        $this->render("account/login");
    }

    public function login() {

//        var_dump($_POST);
        $this->render("account/login");
    }

    public function checkLogin() {
        
        $message = "";
        if (isset($_SESSION['id'])) {
            header('Location: ../account/index.php');
        }

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
                $data = $model_user->login($username);
                if ($data != 0) {
                    if ($data[0]['user_password'] == md5($_POST['password'])) {
                        $_SESSION['user_username'] = $data['user_username'];
                        $_SESSION['user_status'] = $data['user_status'];
                        $_SESSION['user_id'] = $data['user_id'];
//                        updateLastLogin($_SESSION['user_id']);
                        $page = htmlspecialchars($_POST['page']);
                        $this->redirect("user", "show", array("canu", "gregoire"));
//                        header('Location: /account/login');
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

}
