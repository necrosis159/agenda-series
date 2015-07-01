<?php

class Media extends baseModels{

	private $id='';
	private $name;
	private $path;
	private $type;

	public function __construct(){
		parent::__construct();
		$prefixe="media";
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
		return $this->Name;	
	}

	//Path
	public function setPath($path){
		$this->path=$path;
	}

	public function getPath(){
		return $this->path;	
	}

	//Type
	public function setType($type){
		$this->type=$type;
	}

	public function getType(){
		return $this->type;	
	}
}