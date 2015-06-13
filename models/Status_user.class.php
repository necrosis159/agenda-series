<?php

class Status_user extends baseModels{

	public $id='';
	public $name;

	public function __construct(){
		parent::__construct();

	}

	//Pas besoin de faire tous les SET, la "baseModels" le fait deja
}