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

    public function edit() {
        
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

}
