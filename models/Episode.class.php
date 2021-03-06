<?php

class Episode extends baseModels{

	private $episode_id='';
	private $episode_id_serie;
	private $episode_id_season;
	private $episode_name;
	private $episode_number;
	private $episode_overview;
	private $episode_notation;
	private $episode_air_date;
	private $episode_date_update;

	public function __construct(){
		parent::__construct();
	}

	public function getListeEpisode($id,$id_season){
		$query = $this->selectObject('episode_number', 'episode_id', 'episode_name','episode_overview','episode_notation','episode_air_date')
				->where('episode_id_serie',"=", $id)
				->andwhere('episode_id_season',"=",$id_season)
				->order('episode_number')
				->executeObject();
		return $query;
	}

	public function getElementEpisode($id,$id_season,$nb2){
		$query = $this->selectObject('episode_id', 'episode_name','episode_overview','episode_notation','episode_air_date', 'episode_number')
				->where('episode_id_serie', "=", $id)
				->andwhere('episode_id_season', "=", $id_season)
				->andwhere('episode_number', "=", $nb2)
				->executeObject();
		return $query;
	}
	public function airDate($id_serie) {
		$date = date('Y-m-d');
        $nextweek = date('Y-m-d', strtotime($date .' +7 day'));
        $query = $this->select()
                ->from(array("e" => "episode"), array("episode_number", "episode_air_date", "episode_name"))
                ->where('e.episode_air_date', ">=", $date)
                ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                ->join(array("s" => "serie"), array("serie_name, serie_id"), "se.season_id_serie = s.serie_id")
            	->addWhere("AND",'e.episode_air_date', "<=", $nextweek)
            	->addWhere("AND","serie_id", "=", $id_serie)

				->execute();
                return $query;
	}
	//Id
		public function setId($episode_id){
		$this->episode_id=$episode_id;
	}

	public function getId(){
		return $this->episode_id;
	}

	//Id_serie
		public function setIDSerie($episode_id_serie){
		$this->episode_id_serie=$episode_id_serie;
	}

	public function getIDSerie(){
		return $this->episode_id_serie;
	}

	//Id_saison
		public function setIDSeason($episode_id_season){
		$this->episode_id_season=$episode_id_season;
	}

	public function getIDSeason(){
		return $this->episode_id_season;
	}

	//Name
		public function setName($episode_name){
		$this->episode_name=$episode_name;
	}

	public function getName(){
		//echo "<script>alert('".$this->episode_name."');</script>";
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

	//Air_date
	public function setAirDate($episode_air_date){
		$this->episode_air_date=$episode_air_date;
	}

	public function getAirDate(){
		return $this->episode_air_date;
	}

	//Date_Update
	public function setDateUpdate($episode_date_update){
		$this->episode_date_update=$episode_date_update;
	}

	public function getDateUpdate(){
		return $this->episode_date_update;
	}
}
