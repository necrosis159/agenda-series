<?php
class SerieController extends baseView {
	

	public function serie($id)
	{
		$serie = new Serie();
		$season = new Season();
		$result;

		//On récupère les élements de la serie
		$result=$serie->getElementSerie($id);

		//Recupération des genres
		//A FAIRE

		//On récupère la liste des saisons de la serie
		$liste_season=$season->getListeSeason($id);

		//On envoie la liste des saisons
		$this->assign('liste_season',$liste_season);

		//On envoie les variables et appel la view
		$this->assign('id_serie',$id);
		$this->assign('serie_result',$result);
		$this->render("serie/serieShow");
	}

	public function saison($id,$nb1)
	{
		$serie = new Serie();
		$season = new Season();
		$episode = new Episode();
		$result;

		//On récupère le nom de la serie
		$name_serie=$serie->getNameSerieById($id);
		
		//On récupère les éléments de la saison
		$result=$season->getElementSeason($id,$nb1);
		
		//Si la saison existe
		if(!empty($result))
		{
			//On récupère l'id de la saison
			$id_season=$result[0]->getId();

			//On récupère la liste des episode de la saison
			$liste_episode=$episode->getListeEpisode($id,$id_season);
			
			//On envoie la liste des episodes
			$this->assign('liste_episode',$liste_episode);
		}

		//On envoie les variables et appel la view
		$this->assign('id_serie',$id);
		$this->assign('name_serie',$name_serie);
		$this->assign('number_season',$nb1);
		$this->assign('season_result',$result);
		$this->render("serie/saisonShow");
	}

	public function episode($id,$nb1,$nb2)
	{
		$serie = new Serie();
		$season = new Season();
		$episode = new Episode();
		$comment = new Comment();
		$user = new User();
		$result;

		//On récupère le nom de la serie
		$name_serie=$serie->getNameSerieById($id);

		//Si la serie existe :
		if(!empty($name_serie))
		{
			//on récupère l'id de la season
			$result=$season->getIdSeasonByNb($id,$nb1);

			//Si la saison existe
			if(!empty($result))
			{	
				$id_saison=$result[0]->getId();
				
				//on récupère l'episode
				$result=$episode->getElementEpisode($id,$id_saison,$nb2);

				//Si l'episode existe
				if(!empty($result))
				{
					$id_episode=$result[0]->getId();

					$liste_comment=$comment->getElementComment($id_episode);
					
					//Si un commentaire existe
					if(!empty($result))
					{
						foreach ($liste_comment as $value) {
							
							$username=$user->getNameById($value->getId_user());

							$value->setId_user($username);
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
		$this->assign('serie_name',$name_serie);
		$this->assign('episode_result',$result);
		$this->render("serie/episodeShow");
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
		$this->render("serie/serieIndex");
	}

	public function search()
	{
		$search=trim(strip_tags($_POST['search']));
		$serie = new Serie();

		$result=$serie->getLinkImageBySearch($search);

		$this->assign('search_result',$result);

		$this->render("serie/serieResult","empty");
	}
}