<?php

class Serie extends baseModels{

	private $serie_id='';
	private $serie_name;
	private $serie_overview;
	private $serie_nationality;
	private $serie_first_air_date;
	private $serie_image;
	private $serie_notation;
	private $serie_status;
	private $serie_air_date;
	private $serie_highlighting;
	private $serie_date_update;

	public function __construct(){
		parent::__construct();
	}

	//ID
		public function setID($serie_id){
		$this->serie_id=$serie_id;
	}

	public function getID(){
		return $this->serie_id;
	}

	//Name
	public function setName($serie_name){
		$this->serie_name=$serie_name;
	}

	public function getName(){
		return $this->serie_name;
	}

	//Overview
		public function setOverview($serie_overview){
		$this->serie_overview=$serie_overview;
	}

	public function getOverview(){
		return $this->serie_overview;
	}

	//Nationality
		public function setNationality($serie_nationality){
		$this->serie_nationality=$serie_nationality;
	}

	public function getNationality(){
		return $this->serie_nationality;
	}

	//First_air_date
	public function setFirstAirDate($serie_first_air_date){
		$this->serie_first_air_date=$serie_first_air_date;
	}

	public function getFirstAirDate(){
		return $this->serie_first_air_date;
	}

	//Image
		public function setImage($serie_image){
		$this->serie_image=$serie_image;
	}

	public function getImage(){
		return $this->serie_image;
	}

	//Notation
	public function setNotation($serie_notation){
		$this->serie_notation=$serie_notation;
	}

	public function getNotation(){
		return $this->serie_notation;
	}

	//Status
		public function setStatus($serie_status){
		$this->serie_status=$serie_status;
	}

	public function getStatus(){
		return $this->serie_status;
	}

	//Highlighting
	public function setHighlighting($serie_highlighting){
		$this->serie_highlighting=$serie_highlighting;
	}

	public function getHighlighting(){
		return $this->serie_highlighting;
	}

	//Date_Update
	public function setDateUpdate($serie_date_update){
		$this->serie_date_update=$serie_date_update;
	}

	public function getDateUpdate(){
		return $this->serie_date_update;
	}
}
