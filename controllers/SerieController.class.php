<?php
class SerieController extends baseView {
	

	public function serie($id)
	{
		$serie = new Serie();
		$season = new Season();
		$result;

		//On récupère les élements de la serie
		$serie->select_objet('serie_name','serie_overview','serie_nationality','serie_first_air_date','serie_image','serie_notation')
				->where('serie_id', $id);
		$result=$serie->execute_objet();

		//Recupération des genres
		//A FAIRE

		//On récupère la liste des saisons de la serie
		$season->select_objet('season_number')
				->where('season_id_serie', $id);
		$liste_season=$season->execute_objet();

		//On envoie la liste des saisons
		$this->assign('liste_season',$liste_season);

		//On envoie les variables et appel la view
		$this->assign('id_serie',$id);
		$this->assign('serie_result',$result);
		$this->render("serieShow");
	}

	public function saison($id,$nb1)
	{
		$serie = new Serie();
		$season = new Season();
		$episode = new Episode();
		$result;
		
		$serie->select_objet('serie_name')
				->where('serie_id', $id);
		$result=$serie->execute_objet();

		$name_serie=$result[0]->getName();
		
		//On récupère les éléments de la saison
		$season->select_objet('season_id','season_nb_episode','season_name','season_overview','season_image','season_notation','season_year_start')
				->where('season_id_serie', $id)
				->andwhere('season_number',$nb1);
		$result=$season->execute_objet();
		
		//Si la saison existe
		if(!empty($result))
		{
			//On récupère l'id de la saison
			$id_season=$result[0]->getId();
			//On récupère la liste des episode de la saison
			$episode->select_objet('episode_number')
					->where('episode_id_serie', $id)
					->andwhere('episode_id_season',$id_season);
			$liste_episode=$episode->execute_objet();
			
			//On envoie la liste des episodes
			$this->assign('liste_episode',$liste_episode);
		}

		//On envoie les variables et appel la view
		$this->assign('id_serie',$id);
		$this->assign('name_serie',$name_serie);
		$this->assign('number_season',$nb1);
		$this->assign('season_result',$result);
		$this->render("saisonShow");
	}

	public function episode($id,$nb1,$nb2)
	{
		$serie = new Serie();
		$season = new Season();
		$episode = new Episode();
		$comment = new Comment();
		$user = new User();
		$result;

		$serie->select_objet('serie_name')
				->where('serie_id', $id);
		$result=$serie->execute_objet();
		
		$serie_name=$result[0]->getName();

		//Si la serie existe :
		if(!empty($result))
		{
			//on récupère l'id de la season
			$season->select_objet('season_id')
					->where('season_id_serie', $id)
					->andwhere('season_number',$nb1);
			$result=$season->execute_objet();

			//Si la saison existe
			if(!empty($result))
			{	
				$id_saison=$result[0]->getId();
				
				//on récupère l'episode
				$episode->select_objet('episode_id','episode_name','episode_overview','episode_notation','episode_air_date')
						->where('episode_id_serie', $id)
						->andwhere('episode_id_season', $id_saison)
						->andwhere('episode_number', $nb2);
				$result=$episode->execute_objet();
				
				//Si l'episode existe
				if(!empty($result))
				{
					$id_episode=$result[0]->getId();

					$comment->select_objet('comment_id_user','comment_date_publication','comment_title','comment_content','comment_status')
						->where('comment_id_episode', $id_episode);
					$liste_comment=$comment->execute_objet();
					
					//Si un commentaire existe
					if(!empty($result))
					{
						foreach ($liste_comment as $value) {
							$user->select_objet('user_username')
								->where('user_id',$value->getId_user());
							$username=$user->execute_objet();

							$value->setId_user($username[0]->getUsername());
						}
					}

					//On envoie la liste des commentaires
					$this->assign('liste_comment',$liste_comment);
				}				
			}
		}

		//On envoie les variables et appel la view
		$this->assign('season_number',$nb1);
		$this->assign('episode_number',$nb2);
		$this->assign('serie_name',$serie_name);
		$this->assign('episode_result',$result);
		$this->render("episodeShow");
	}

	public function comment(){
		$comment = new Comment();

		//On defini toutes les variables
		$tab['comment_id_episode']=$_POST['id_episode'];
		$tab['comment_id_user']=$_POST['id_session'];
		$tab['comment_date_publication']='0000-00-00';

		//Verifications des contenus de title et comment
		$tab['comment_title']=trim(strip_tags($_POST['title_comment']));
		$tab['comment_content']=trim(strip_tags($_POST['content_comment']));

		$tab['comment_notation']=0;
		$tab['comment_status']=0;
		$tab['comment_highlighting']=0;
		
		//on insère
		$comment->insert($tab);
	}

	public function searchindex()
	{
		$this->render("serieIndex");
	}

	public function search()
	{
		$search=trim(strip_tags($_POST['search']));
		$serie = new Serie();
		$serie->select_objet('serie_id','serie_name','serie_image')
			->where('serie_name','LIKE',$search);
		$result=$serie->execute_objet();

		$this->assign('search_result',$result);
		$this->render("serieResult","empty");
	}
}