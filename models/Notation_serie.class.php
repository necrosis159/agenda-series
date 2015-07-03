<?php

class Notation_serie extends baseModels{

	private $ns_id_serie;
	private $ns_id_user;
	private $ns_notation;
	
	public function __construct(){
		parent::__construct();

	}

	//Id_episode
	public function setId_serie($ns_id_serie){
		$this->ns_id_serie=$ns_id_serie;
	}

	public function getId_serie(){
		return $this->ns_id_serie;
	}

	//Id_user
		public function setId_user($ns_id_user){
		$this->ns_id_user=$ns_id_user;
	}

	public function getId_user(){
		return $this->ns_id_user;
	}

	//Notation
	public function setNotation($ns_Notation){
		$this->ns_notation=$ns_notation;
	}

	public function getNotation(){
		return $this->ns_notation;
	}
}