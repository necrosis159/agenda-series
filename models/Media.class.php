<?php

class Media extends baseModels{

	private $media_id='';
	private $media_name;
	private $media_path;
	private $media_type;

	public function __construct(){
		parent::__construct();
	}
	
	//Id
	public function setId($media_id){
		$this->media_id=$media_id;
	}

	public function getId(){
		return $this->media_id;	
	}

	//Name
	public function setName($media_name){
		$this->media_name=$media_name;
	}

	public function getName(){
		return $this->media_Name;	
	}

	//Path
	public function setPath($media_path){
		$this->media_path=$media_path;
	}

	public function getPath(){
		return $this->media_path;	
	}

	//Type
	public function setType($media_type){
		$this->media_type=$media_type;
	}

	public function getType(){
		return $this->media_type;	
	}
}