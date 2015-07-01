<?php
class UserController extends baseView {


	
	public function index() {
		$this->render("userInsert");
	}

	public function show($name, $surname) {

		$user = new User();
		$resultat=$user->select()
                        ->from(array("u" =>"user"), array("user_id", "user_surname", "user_name"))
//			 ->where('user_name', "=", $name)
//			 ->andWhere('user_surname', "=", $surname)
			 ->execute();
		$this->assign('user',$resultat)
			 ->render("userShow");
	}
        
        public function test() {
            $model_user = new User();
            $result = $model_user->test();
            $this->assign("test", $result);
            $this->render("user/userTest");
        }
        
        public function edit() {
            
        }

	public function insert(){

		$user = new User();
		$user->set('name',$_POST['name']);
		$user->set('surname',$_POST['surname']);
		$user->set('avatar',"avatar/83fb6ef6170818216cb140fd7f04ce2d.png");
		$user->set('gender',1);
		$user->set('presentation',"bonjour");
		$user->set('username',"testMVC");
		$user->set('password',"testMVCpw");
		$user->set('email',"test@mvc.fr");
		$user->set('birthdate','0000-00-00');
		$user->set('creation_date','0000-00-00');
		$user->set('last_login','0000-00-00');
		$user->set('status',2);

		$user->insert();
	}

	public function update()
	{
		$user = new User();
		$tab['name']='modif';
		//Créer un tableau  $tab[$key]=$val 
		//$key(nom du champ)
		//$val(valeur du champ)
		$user->update($tab)
				->where('name',$name)
				->execute();
	}
}