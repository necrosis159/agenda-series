<?php

class Serie_user extends baseModels{

	private $su_id_serie;
	private $su_id_user;

	public function __construct(){
		parent::__construct();

	}

	//Id_serie
		public function setId_serie($su_id_serie){
		$this->su_id_serie=$su_id_serie;
	}

	public function getId_serie(){
		return $this->su_id_serie;
	}

	//Id_saison
		public function setId_user($su_id_user){
		$this->su_id_user=$su_id_user;
	}

	public function getId_user(){
		return $this->su_id_user;
	}

}