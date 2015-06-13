<?php

class Episode extends baseModels{

	public $id='';
	public $id_serie;
	public $id_saison;
	public $name;
	public $number;
	public $overview;
	public $status;
	public $summary;
	public $notation;
	public $duration;
	public $air_date;

	public function __construct(){
		parent::__construct();

	}

	//Pas besoin de faire tous les SET, la "baseModels" le fait deja
}