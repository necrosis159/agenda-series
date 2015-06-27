<?php

class Season extends baseModels{

	private $id='';
	private $id_serie;
	private $number;
	private $nb_episode;
	private $name;
	private $overview;
	private $status;
	private $notation;
	private $year_start;
	private $year_end;

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

	//Number
	public function setNumber($number){
		$this->number=$number;
	}

	public function getNumber(){
		return $this->number;	
	}

	//Nb_episode
	public function setNb_episode($nb_episode){
		$this->nb_episode=$nb_episode;
	}

	public function getNb_episode(){
		return $this->nb_episode;	
	}

	//Name
	public function setName($name){
		$this->name=$name;
	}

	public function getName(){
		return $this->name;	
	}

	//Overview
	public function setOverview($overview){
		$this->overview=$overview;
	}

	public function getOverview(){
		return $this->overview;	
	}

	//Status
	public function setStatus($status){
		$this->status=$status;
	}

	public function getStatus(){
		return $this->status;	
	}

	//Notation
	public function setNotation($notation){
		$this->notation=$notation;
	}

	public function getNotation(){
		return $this->notation;	
	}

	//Year_start
	public function setYear_start($year_start){
		$this->year_start=$year_start;
	}

	public function getYear_start(){
		return $this->year_start;	
	}

	//Year_end
	public function setYear_end($year_end){
		$this->year_end=$year_end;
	}

	public function getYear_end(){
		return $this->year_end;
	}
}