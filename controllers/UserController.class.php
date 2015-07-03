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
//        $this->assign("test", $result);
        $data_update = array("user_last_login" => date("Y-m-d H:i:s"));
                        $model_user->updateLastLogin($data_update, "10");
        $this->render("user/userTest");
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

    public function update() {
        $user = new User();
//        $tab['user_name'] = 'modif';
//        //Créer un tableau  $tab[$key]=$val 
//        //$key(nom du champ)
//        //$val(valeur du champ)
//        $name = 'Zbra';
//        $user->update($tab)
//                ->where('user_name', $name)->execute_objet();
        $data_update = array("user_last_login" => date("Y-m-d H:i:s"));
                        $user->updateLastLogin($data_update, $data[0]['user_id']);
        $this->render("indexIndex");
    }

}
