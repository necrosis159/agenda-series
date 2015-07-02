<?php

class Season extends baseModels{

	private $season_id='';
	private $season_id_serie;
	private $season_number;
	private $season_nb_episode;
	private $season_name;
	private $season_overview;
	private $season_image;
	private $season_year_start;
	private $season_date_update;

	public function __construct(){
		parent::__construct();

	}
	
	//Id
	public function setId($season_id){
		$this->season_id=$season_id;
	}

	public function getId(){
		return $this->season_id;
	}

	//Id_serie
	public function setId_serie($season_id_serie){
		$this->season_id_serie=$season_id_serie;
	}

	public function getId_serie(){
		return $this->season_id_serie;
	}

	//Number
	public function setNumber($season_number){
		$this->season_number=$season_number;
	}

	public function getNumber(){
		return $this->season_number;	
	}

	//Nb_episode
	public function setNb_episode($season_nb_episode){
		$this->season_nb_episode=$season_nb_episode;
	}

	public function getNb_episode(){
		return $this->season_nb_episode;	
	}

	//Name
	public function setName($season_name){
		$this->season_name=$season_name;
	}

	public function getName(){
		return $this->season_name;	
	}

	//Overview
	public function setOverview($season_overview){
		$this->season_overview=$season_overview;
	}

	public function getOverview(){
		return $this->season_overview;	
	}

	//Image
	public function setImage($season_image){
		$this->image=$season_image;
	}

	public function getImage(){
		return $this->season_image;	
	}

	//Year_start
	public function setYear_start($season_year_start){
		$this->season_year_start=$season_year_start;
	}

	public function getYear_start(){
		return $this->season_year_start;	
	}

	//Date_update
	public function setDate_update($season_date_update){
		$this->season_date_update=$season_date_update;
	}

	public function getDate_update(){
		return $this->season_date_update;
	}
}