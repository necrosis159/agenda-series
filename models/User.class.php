<?php

class User extends baseModels{

	public $id='';
	public $name;
	public $surname;
	public $avatar;
	public $gender;
	public $presentation;
	public $username;
	public $password;
	public $email;
	public $birthdate;
	public $creation_date;
	public $last_login;
	public $status;

	public function __construct(){
		parent::__construct();

	}

	//Pas besoin de faire tous les SET, la "baseModels" le fait deja
}