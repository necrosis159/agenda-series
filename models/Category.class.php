<?php

class Serie extends baseModels{

	public $id='';
	public $category;
	public $age;

	public function __construct(){
		parent::__construct();

	}

	//Pas besoin de faire tous les SET, la "baseModels" le fait deja
}