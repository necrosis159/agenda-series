<?php

class Category extends baseModels{

	private $id='';
	private $category;
	private $age;
	private $prefixe="category";

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

	//Category
	public function setCategory($category){
		$this->category=$category;
	}

	public function getCategory(){
		return $this->category;	
	}

	//Age
	public function setAge($age){
		$this->age=$age;
	}

	public function getAge(){
		return $this->age;	
	}
}