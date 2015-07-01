<?php

class Comment extends baseModels{

	private $id='';
	private $id_episode;
	private $id_user;
	private $date_publication;
	private $title;
	private $content;
	private $notation;
	private $status;
	private $highlighting;

	public function __construct(){
		parent::__construct();
		$prefixe="comment";

	}
	
	//Id
	public function setId($id){
		$this->id=$id;
	}

	public function getId(){
		return $this->id;	
	}

	//Id_episode
	public function setID_episode($id_episode){
		$this->id_episode=$id_episode;
	}

	public function getId_episode(){
		return $this->id_episode;	
	}
	
	//Id_user
	public function setId_user($id_user){
		$this->id_user=$id_user;
	}

	public function getId_user(){
		return $this->id_user;	
	}
	
	//Date_publication
	public function setDate_publication($date_publication){
		$this->date_publication=$date_publication;
	}

	public function getDate_publication(){
		return $this->date_publication;	
	}
	
	//Title
	public function setTitle($title){
		$this->title=$title;
	}

	public function getTitle(){
		return $this->title;	
	}
	
	//Content
	public function setContent($content){
		$this->content=$content;
	}

	public function getContent(){
		return $this->content;	
	}
	
	//Notation
	public function setNotation($notation){
		$this->notation=$notation;
	}

	public function getNotation(){
		return $this->notation;	
	}
	
	//Status
	public function setStatus($status){
		$this->status=$status;
	}

	public function getStatus(){
		return $this->status;	
	}
	
	//Highlighting
	public function setHighlighting($highlighting){
		$this->highlighting=$highlighting;
	}

	public function getHighlighting(){
		return $this->highlighting;	
	}

}