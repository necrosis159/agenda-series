<?php

class Episode extends baseModels{

	private $id='';
	private $id_serie;
	private $id_saison;
	private $name;
	private $number;
	private $overview;
	private $status;
	private $summary;
	private $notation;
	private $duration;
	private $air_date;
	private $prefixe="episode";

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

	//Id_serie
		public function setId_serie($id_serie){
		$this->id_serie=$id_serie;
	}

	public function getId_serie(){
		return $this->id_serie;
	}

	//Id_saison
		public function setId_saison($id_saison){
		$this->id_saison=$id_saison;
	}

	public function getId_saison(){
		return $this->id_saison;
	}

	//Name
		public function setName($name){
		$this->name=$name;
	}

	public function getName(){
		return $this->name;
	}

	//Number
		public function setNumber($number){
		$this->number=$number;
	}

	public function getNumber(){
		return $this->number;
	}

	//Overview
		public function setOverview($overview){
		$this->overview=$overview;
	}

	public function getOverview(){
		return $this->overview;
	}

	//Status
		public function setSatus($status){
		$this->status=$status;
	}

	public function getStatus(){
		return $this->status;
	}

	//Summary
		public function setSummary($summary){
		$this->summary=$summary;
	}

	public function getSummary(){
		return $this->summary;
	}

	//Notation
		public function setNotation($notation){
		$this->notation=$notation;
	}

	public function getNotation(){
		return $this->notation;
	}

	//Duration
		public function setDuration($duration){
		$this->duration=$duration;
	}

	public function getDuration(){
		return $this->duration;
	}

	//Air_date
	public function setAir_date($air_date){
		$this->air_date=$air_date;
	}

	public function getAir_date(){
		return $this->air_date;
	}
}