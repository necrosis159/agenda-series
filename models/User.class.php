<?php

class User extends baseModels{

	private $id='';
	private $name;
	private $surname;
	private $avatar;
	private $gender;
	private $presentation;
	private $username;
	private $password;
	private $email;
	private $birthdate;
	private $creation_date;
	private $last_login;
	private $status;

	public function __construct(){
		parent::__construct();

	}
        
//        public function getUser($name, $username) {
//            $resultat = $this->select('id', 'name', 'surname')
//			 ->where('name', $name)
//			 ->andWhere('surname', $username)
//			 ->execute();
//            return $resultat;
//        }
//        
//        public function getAllUsers() {
//            $resultat = $this->select('id', 'name', 'surname')
//			 ->execute();
//            return $resultat;
//        }
        
        public function test() {
            $query = $this->select()
                    ->from(array("u" =>"user"), array("user_id", "user_name"))
                    ->where("u.user_id", "=", 10)
                    ->join(array("su" => "serie_user"), array(), "u.user_id = su.su_id_user")
                    ->join(array("s" => "serie"), array("serie_name"), "su.su_id_serie = s.serie_id")
                    ->execute();
            return $query;
        }
        
        public function login($username) {
            $query = $this->select()
                    ->from(array("u" => "user"), array("user_id", "user_username", "user_password", "user_status"))
                    ->where("u.user_username", "=", $username)
                    ->execute();
            return $query;
        }
        
	//Id
	public function setId($id){
		$this->id=$id;
	}

	public function getId(){
		return $this->id;
	}

	//Name
	public function setName($name){
		$this->name=$name;
	}

	public function getName(){
		return $this->name;	
	}

	//Surname
	public function setSurname($surname){
		$this->surname=$surname;
	}

	public function getSurname(){
		return $this->surname;	
	}

	//Avatar
	public function setAvatar($avatar){
		$this->avatar=$avatar;
	}

	public function getAvatar(){
		return $this->avatar;	
	}

	//Gender
	public function setGender($gender){
		$this->gender=$gender;
	}

	public function getGender(){
		return $this->gender;	
	}

	//Presentation
	public function setPresentation($presentation){
		$this->presentation=$presentation;
	}

	public function getPresentation(){
		return $this->presentation;	
	}

	//Username
	public function setUsername($username){
		$this->username=$username;
	}

	public function getUsername(){
		return $this->username;	
	}

	//Password
	public function setPassword($password){
		$this->password=$password;
	}

	public function getPassword(){
		return $this->password;	
	}

	//Email
	public function setEmail($email){
		$this->email=$email;
	}

	public function getEmail(){
		return $this->email;	
	}

	//Birthdate
	public function setBirthdate($birthdate){
		$this->birthdate=$birthdate;
	}

	public function getBirthdate(){
		return $this->birthdate;	
	}

	//Creation_date
	public function setCreation_date($creation_date){
		$this->creation_date=$creation_date;
	}

	public function getCreation_date(){
		return $this->creation_date;
	}

	//Last_login
	public function setLast_login($last_login){
		$this->last_login=$last_login;
	}

	public function getLast_login(){
		return $this->last_login;	
	}

	//Status
	public function setStatus($status){
		$this->status=$status;
	}

	public function getStatus(){
		return $this->status;	
	}
}