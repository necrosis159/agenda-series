<?php

class Serie extends baseModels{

	private $id='';
	private $name;
	private $short_description;
	private $description;
	private $nationality;
	private $year_start;
	private $year_end;
	private $image;
	private $video;
	private $notation;
	private $id_category;
	private $status;
	private $meta_keywords;
	private $air_date;
	private $highlighting;

	public function __construct(){
		parent::__construct();

	}

	//ID
		public function setId($id){
		$this->id=$id;
	}

	public function getId(){
		return $this->id;
	}

	//Name
	public function setName($name){
		$this->name=$name;
	}

	public function getName(){
		return $this->name;	
	}

	//Short_description
		public function setShort_description($short_description){
		$this->short_description=$short_description;
	}

	public function getShort_description(){
		return $this->short_description;	
	}

	//Description
		public function setDescription($description){
		$this->description=$description;
	}

	public function getDescription(){
		return $this->description;	
	}

	//Nationality
		public function setNationality($nationality){
		$this->nationality=$nationality;
	}

	public function getNationality(){
		return $this->nationality;	
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

	//Image
		public function setImage($image){
		$this->image=$image;
	}

	public function getImage(){
		return $this->image;	
	}

	//Video
		public function setVideo($video){
		$this->video=$video;
	}

	public function getVideo(){
		return $this->video;	
	}

	//Notation
	public function setNotation($notation){
		$this->notation=$notation;
	}

	public function getNotation(){
		return $this->notation;	
	}

	//Id_category
		public function setId_category($id_category){
		$this->id_category=$id_category;
	}

	public function getId_category(){
		return $this->id_category;	
	}

	//Status
		public function setStatus($status){
		$this->status=$status;
	}

	public function getStatus(){
		return $this->status;	
	}

	//Meta_keywords
		public function setMeta_keywords($meta_keywords){
		$this->meta_keywords=$meta_keywords;
	}

	public function getMeta_keywords(){
		return $this->meta_keywords;	
	}

	//Air_date
	public function setAir_date($air_date){
		$this->air_date=$air_date;
	}

	public function getAir_date(){
		return $this->air_date;
	}

	//Highlighting
	public function setHighlighting($highlighting){
		$this->highlighting=$highlighting;
	}

	public function getHighlighting(){
		return $this->highlighting;
	}
}