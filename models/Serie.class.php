<?php

class Serie extends baseModels{

	public $id='';
	public $name;
	public $short_description;
	public $description;
	public $nationality;
	public $year_start;
	public $year_end;
	public $image;
	public $video;
	public $notation;
	public $id_category;
	public $status;
	public $meta_keywords;
	public $air_date;
	public $highlighting;

	public function __construct(){
		parent::__construct();

	}

	//Pas besoin de faire tous les SET, la "baseModels" le fait deja
}