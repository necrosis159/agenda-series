<?php

class Notation_episode extends baseModels{

	private $id_episode;
	private $id_user;
	private $notation;
	
	public function __construct(){
		parent::__construct();

	}

	//Id_episode
	public function setId_episode($id_episode){
		$this->id_episode=$id_episode;
	}

	public function getId_episode(){
		return $this->id_episode;
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