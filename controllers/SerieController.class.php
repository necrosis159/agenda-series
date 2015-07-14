<?php
class SerieController extends baseView {
	

	public function serie($name)
	{
		$serie = new Serie();
		$category = new Category();
		$season = new Season();
		$result;

		//On récupère les élements de la serie
		$serie->select('id','description','nationality','year_start','year_end','image','notation','id_category','status')
				->where('name', $name);
		$result=$serie->execute();

		//Si la serie existe
		if(!empty($result))
		{
			//On récupère l'id de la série
			$id=$result[0]->getId();

			//On récupère le nom de la category
			$category->select('category')
					->where('id',$result[0]->getId_category());
			$category=$category->execute();
			$category=$category[0]->getCategory();

			//On envoie le nom de la category (seulement si la serie existe)
			$this->assign('serie_category',$category);

			//On récupère la liste des saisons de la serie
			$season->select('number')
					->where('id_serie', $id);
			$liste_season=$season->execute();
			
			//On envoie la liste des saisons
			$this->assign('liste_season',$liste_season);
		}

		//On envoie les variables et appel la view
		$this->assign('name_serie',$name);
		$this->assign('serie_result',$result);
		$this->render("serieShow");
	}

	public function saison($name,$nb1)
	{
		$serie = new Serie();
		$category = new Category();
		$season = new Season();
		$episode = new Episode();
		$result;

		//On récupère l'id et l'image de la serie
		$serie->select('id','image')
				->where('name', $name);
		$result=$serie->execute();

		//Si la serie existe
		if(!empty($result))
		{
			$image=$result[0]->getImage();
			$id_serie=$result[0]->getId();
		
			//On récupère les éléments de la saison
			$season->select('id','nb_episode','name','overview','notation','year_start')
					->where('id_serie', $id_serie)
					->andwhere('number',$nb1);
			$result=$season->execute();

			//Si la saison existe
			if(!empty($result))
			{
				//On récupère l'id de la saison
				$id_season=$result[0]->getId();
				//On récupère la liste des episode de la saison
				$episode->select('number')
						->where('id_serie', $id_serie)
						->andwhere('id_season',$id_season);
				$liste_episode=$episode->execute();
				
				//On envoie la liste des episodes
				$this->assign('liste_episode',$liste_episode);
			}
			//on envoie l'image (seulement si la serie existe)
			$this->assign('image_serie',$image);

		}
		//On envoie les variables et appel la view
		$this->assign('name_serie',$name);
		$this->assign('number_season',$nb1);
		$this->assign('season_result',$result);
		$this->render("saisonShow");
	}

	public function episode($name,$nb1,$nb2)
	{
		$serie = new Serie();
		$category = new Category();
		$season = new Season();
		$episode = new Episode();
		$comment = new Comment();
		$user = new User();
		$result;

		//On récupère l'id de la serie
		$serie->select('id','image')
				->where('name', $name);
		$result=$serie->execute();
		
		//Si la serie existe :
		if(!empty($result))
		{
			$image=$result[0]->getImage();
			$id=$result[0]->getId();

			//on récupère l'id de la season
			$season->select('id')
					->where('id_serie', $id)
					->andwhere('number',$nb1);
			$result=$season->execute();

			//Si la saison existe
			if(!empty($result))
			{	
				$id_saison=$result[0]->getId();
				
				//on récupère l'episode
				$episode->select('id','overview','summary','notation','duration')
						->where('id_serie', $id)
						->andwhere('id_season', $id_saison)
						->andwhere('number', $nb2);
				$result=$episode->execute();
				
				//Si l'episode existe
				if(!empty($result))
				{
					$id_episode=$result[0]->getId();

					$comment->select('id_user','date_publication','title','content')
						->where('id_episode', $id_episode);
					$liste_comment=$comment->execute();
					
					//Si un commentaire existe
					if(!empty($result))
					{
						foreach ($liste_comment as$value) {
							$user->select('username')
								->where('id',$value->getId_user());
							$username=$user->execute();
							$value->setId_user($username[0]->getUsername());
						}
					}

					//On envoie la liste des commentaires
					$this->assign('liste_comment',$liste_comment);
				}				
			}
			//on envoie l'image (seulement si la serie existe)
			$this->assign('serie_image',$image);
		}

		//On envoie les variables et appel la view
		$this->assign('season_number',$nb1);
		$this->assign('episode_number',$nb2);
		$this->assign('serie_name',$name);
		$this->assign('episode_result',$result);
		$this->render("episodeShow");
	}

	public function comment(){
		$comment = new Comment();

		//On defini toutes les variables
		$comment->setid_episode($_POST['id_episode']);
		$comment->setid_user($_POST['id_session']);
		$comment->setdate_publication('0000-00-00');
		$comment->settitle($_POST['title_comment']);
		$comment->setcontent($_POST['content_comment']);
		$comment->setnotation(0);
		$comment->setstatus(0);
		$comment->sethighlighting(0);
		
		//on insère
		$comment->insert();
	}
}