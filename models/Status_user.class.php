<?php

class Status_user extends baseModels{

	private $id='';
	private $name;
	private $prefixe="status_user";

	public function __construct(){
		parent::__construct();

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
}