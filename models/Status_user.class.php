<?php

class Status_user extends baseModels{

	private $status_user_id='';
	private $status_user_name;

	public function __construct(){
		parent::__construct();

	}

	//Id
	public function setId($status_user_id){
		$this->status_user_id=$status_user_id;
	}

	public function getId(){
		return $this->status_user_id;
	}

	//Name
	public function setName($status_user_name){
		$this->status_user_name=$status_user_name;
	}

	public function getName(){
		return $this->status_user_name;
	}
}