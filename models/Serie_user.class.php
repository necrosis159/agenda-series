<?php

class Serie_user extends baseModels{

	private $id_serie;
	private $id_user;

	public function __construct(){
		parent::__construct();
		$prefixe="su";

	}

	//Id_serie
		public function setId_serie($id_serie){
		$this->id_serie=$id_serie;
	}

	public function getId_serie(){
		return $this->id_serie;
	}

	//Id_saison
		public function setId_user($id_user){
		$this->id_user=$id_user;
	}

	public function getId_user(){
		return $this->id_user;
	}

}