<?php

class Season extends baseModels{

	public $id='';
	public $id_serie;
	public $number;
	public $nb_episode;
	public $name;
	public $overview;
	public $status;
	public $notation;
	public $year_start;
	public $year_end;

	public function __construct(){
		parent::__construct();

	}

	//Pas besoin de faire tous les SET, la "baseModels" le fait deja
}