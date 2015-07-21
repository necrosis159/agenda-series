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

	//Retourne toutes les séries highlight
	public function getSerieAllHighlight(){
		$query = $this->selectObject('serie_id', 'serie_name', 'serie_image', 'serie_overview')
		->where('serie_highlighting', "=", "1")
		->executeObject();
		return $query;
	}

	//Retourne toutes les séries par 5
	public function getSeriePage($page,$number){
		$query= $this->selectObject('serie_id','serie_image','serie_name','serie_notation')
		->limit($page,$number)
		->executeObject();
		return $query;
	}

	public function getIdSerieByName($serie_name) {
		$query = $this->select()
		->from(array("serie"), array("serie_id"))
		->where("serie_name", "=", $serie_name)
		->execute();

		if(!empty($query))
			return $query[0];
	}

	public function getNameSerieById($id){
		$query = $this->selectObject('serie_name')
		->where('serie_id', "=", $id)
		->executeObject();
		return $query[0]->getName();
	}

	public function getElementSerie($id){

		$query = $this->selectObject('serie_name','serie_overview','serie_nationality','serie_first_air_date','serie_image','serie_notation')
		->where('serie_id','=', $id)
		->executeObject();
		return $query;
	}

	public function getLinkImageBySearch($search){
		$query = $this->selectObject('serie_id','serie_name','serie_image')
		->where('serie_name','LIKE',$search)
		->executeObject();
		return $query;
	}
	public function getGenreById($id){
		$query = $this->select()
		->from(array("u" => "serie"), array())
		->where("serie_id", "=", $id)
		->join(array("gs" => "genre_serie"), array(), "gs.gs_id_serie = u.serie_id")
		->join(array("g" => "genre"), array("genre_id","genre_name"), "g.genre_id = gs.gs_id_genre")
		->execute();

		return $query;
	}

	public function countSeasonByIdSerie($id){
		$query = $this->count()
		->from(array("season"))
		->where("season_id_serie", "=", $id)
		->execute();
		return $query[0]["COUNT(*)"];
	}

	public function countEpisodeByIdSerie($id){
		$query = $this->count()
		->from(array("episode"))
		->where("episode_id_serie", "=", $id)
		->execute();

		return $query[0]["COUNT(*)"];
	}

	public function searchSeriesByName($serie_name){
		$query = $this->select($serie_name)
		->from(array("serie"), array("serie_name"))
		->where("serie_name", "LIKE", $serie_name)
		->execute();
		return $query;
	}

	public function updateSerie($serie_id, $data){
		$this->update($data)
					->where("serie_id", "=", $serie_id)
						->executeObject();
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
