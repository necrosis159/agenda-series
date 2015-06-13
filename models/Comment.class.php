<?php

class Comment extends baseModels{

	public $id='';
	public $id_episode;
	public $id_user;
	public $date_publication;
	public $title;
	public $content;
	public $notation;
	public $status;
	public $highlighting;

	public function __construct(){
		parent::__construct();

	}

	//Pas besoin de faire tous les SET, la "baseModels" le fait deja
}