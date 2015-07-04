<?php

class Notation_episode extends baseModels{

	private $ne_id_episode;
	private $ne_id_user;
	private $ne_notation;
	
	public function __construct(){
		parent::__construct();

	}

	//Id_episode
	public function setId_episode($ne_id_episode){
		$this->ne_id_episode=$ne_id_episode;
	}

	public function getId_episode(){
		return $this->ne_id_episode;
	}

	//Id_user
		public function setId_user($ne_id_user){
		$this->ne_id_user=$ne_id_user;
	}

	public function getId_user(){
		return $this->ne_id_user;
	}

	//Notation
	public function setNotation($ne_Notation){
		$this->ne_notation=$ne_notation;
	}

	public function getNotation(){
		return $this->ne_notation;
	}
}