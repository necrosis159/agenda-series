<?php

class Media extends baseModels{

	public $id='';
	public $name;
	public $path;
	public $type;

	public function __construct(){
		parent::__construct();

	}

	//Pas besoin de faire tous les SET, la "baseModels" le fait deja
}