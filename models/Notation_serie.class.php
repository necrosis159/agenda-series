<?php

class Notation_serie extends baseModels{

	private $id_serie;
	private $id_user;
	private $notation;
	
	public function __construct(){
		parent::__construct();

	}

	//Id_episode
	public function setId_serie($id_serie){
		$this->id_serie=$id_serie;
	}

	public function getId_serie(){
		return $this->id_serie;
	}

	//Id_user
		public function setId_user($id_user){
		$this->id_user=$id_user;
	}

	public function getId_user(){
		return $this->id_user;
	}

	//Notation
	public function setNotation($Notation){
		$this->notation=$notation;
	}

	public function getNotation(){
		return $this->notation;
	}
}