<?php

class Genre extends baseModels{

	private $genre_id='';
	private $genre_name;

	public function __construct(){
		parent::__construct();

	}

	//Id
	public function setId($genre_id){
		$this->genre_id=$genre_id;
	}

	public function getId(){
		return $this->genre_id;	
	}

	//Name
	public function setName($genre_name){
		$this->genre_name=$genre_name;
	}

	public function getName(){
		return $this->genre_name;	
	}

}