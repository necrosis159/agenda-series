<?php

class Episode extends baseModels{

	private $episode_id='';
	private $episode_id_serie;
	private $episode_id_saison;
	private $episode_name;
	private $episode_number;
	private $episode_overview;
	private $episode_notation;
	private $episode_air_date;
	private $episode_date_update

	public function __construct(){
		parent::__construct();
	}

	//Id
		public function setId($episode_id){
		$this->episode_id=$episode_id;
	}

	public function getId(){
		return $this->episode_id;
	}

	//Id_serie
		public function setId_serie($episode_id_serie){
		$this->episode_id_serie=$episode_id_serie;
	}

	public function getId_serie(){
		return $this->episode_id_serie;
	}

	//Id_saison
		public function setId_saison($episode_id_saison){
		$this->episode_id_saison=$episode_id_saison;
	}

	public function getId_saison(){
		return $this->episode_id_saison;
	}

	//Name
		public function setName($episode_name){
		$this->episode_name=$episode_name;
	}

	public function getName(){
		return $this->episode_name;
	}

	//Number
		public function setNumber($episode_number){
		$this->episode_number=$episode_number;
	}

	public function getNumber(){
		return $this->episode_number;
	}

	//Overview
		public function setOverview($episode_overview){
		$this->episode_overview=$episode_overview;
	}

	public function getOverview(){
		return $this->episode_overview;
	}

	//Notation
		public function setNotation($episode_notation){
		$this->episode_notation=$episode_notation;
	}

	public function getNotation(){
		return $this->episode_notation;
	}

	//Duration
		public function setDuration($episode_duration){
		$this->episode_duration=$episode_duration;
	}

	public function getDuration(){
		return $this->episode_duration;
	}

	//Air_date
	public function setAir_date($episode_air_date){
		$this->episode_air_date=$episode_air_date;
	}

	public function getAir_date(){
		return $this->episode_air_date;
	}

	//Date_Update
	public function setDateUpdate($episode_date_update){
		$this->episode_date_update=$episode_date_update;
	}

	public function getDate_update(){
		return $this->episode_date_update;
	}
}