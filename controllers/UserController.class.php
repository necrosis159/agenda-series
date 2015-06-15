<?php
class UserController extends baseView {


	
	public function index() {
		$this->render("userInsert");
	}
	//fonction avec get
	public function show($name, $username) {
		//Création de la class
		$user = new User();
		//Séléction dans la bdd
		$user = new User($user->select()
								//Condition where simple
							  ->where('name', $name)
							  //Condition Where AND (après un where)
							  ->andWhere('surname', $username)
							  //execution de la requète SQL
							  ->execute());
		//Affichage qui envoie l'objet user (on peut envoyer d'autres types de variables)
		$this->assign('user',$user)
				//Appel view : userIndex
				->render("userShow");
			 ->render("userShow");
	}

	//fonction avec post
	public function insert(){

		//Créer un objet user
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

		//Appeler la méthode save
		$user->insert();
		//appeller une autre page si vous souhaitez un affichage après l'insertion
	}
	//syntaxe de la fonction update
	public function update()
	{
		$user = new User();
		$user->set('name','modif');
		$user->update()->where('name',$name);
	}
}