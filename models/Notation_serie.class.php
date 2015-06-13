<?php

class Notation_serie extends baseModels{

	public $id_serie;
	public $id_user;
	public $notation;
	
	public function __construct(){
		parent::__construct();

	}

	//Pas besoin de faire tous les SET, la "baseModels" le fait deja
}