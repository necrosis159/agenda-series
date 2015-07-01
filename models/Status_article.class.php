<?php

class Status_article extends baseModels{

	private $id='';
	private $name;

	public function __construct(){
		parent::__construct();
		$prefixe="status_article";
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