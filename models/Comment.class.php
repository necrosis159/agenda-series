<?php

class Comment extends baseModels{

	private $comment_id='';
	private $comment_id_episode;
	private $comment_id_user;
	private $comment_date_publication;
	private $comment_title;
	private $comment_content;
	private $comment_notation;
	private $comment_status;
	private $comment_highlighting;

	public function __construct(){
		parent::__construct();

	}

	public function getElementComment($id_episode){
		$query = $this->selectObjet('comment_id_user','comment_date_publication','comment_title','comment_content','comment_status')
				->where('comment_id_episode', "=", $id_episode)
				->executeObjet();
		return $query;
	}
	
	//Id
	public function setId($comment_id){
		$this->comment_id=$comment_id;
	}

	public function getId(){
		return $this->comment_id;	
	}

	//Id_episode
	public function setId_episode($comment_id_episode){
		$this->comment_id_episode=$comment_id_episode;
	}

	public function getId_episode(){
		return $this->comment_id_episode;	
	}
	
	//Id_user
	public function setId_user($comment_id_user){
		$this->comment_id_user=$comment_id_user;
	}

	public function getId_user(){
		return $this->comment_id_user;	
	}
	
	//Date_publication
	public function setDate_publication($comment_date_publication){
		$this->comment_date_publication=$comment_date_publication;
	}

	public function getDate_publication(){
		return $this->comment_date_publication;	
	}
	
	//Title
	public function setTitle($comment_title){
		$this->comment_title=$comment_title;
	}

	public function getTitle(){
		return $this->comment_title;	
	}
	
	//Content
	public function setContent($comment_content){
		$this->comment_content=$comment_content;
	}

	public function getContent(){
		return $this->comment_content;	
	}
	
	//Notation
	public function setNotation($comment_notation){
		$this->comment_notation=$comment_notation;
	}

	public function getNotation(){
		return $this->comment_notation;	
	}
	
	//Status
	public function setStatus($comment_status){
		$this->comment_status=$comment_status;
	}

	public function getStatus(){
		return $this->comment_status;	
	}
	
	//Highlighting
	public function setHighlighting($comment_highlighting){
		$this->comment_highlighting=$comment_highlighting;
	}

	public function getHighlighting(){
		return $this->comment_highlighting;	
	}

}