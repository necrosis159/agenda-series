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
		$genre="";
		$genre_result=$serie->getGenreById($id);

		foreach ($genre_result as $value) {
			if($genre!="")
				$genre.=" - ".$value['genre_name'];
			else
				$genre=$value['genre_name'];
		}
		//Conversion date en fr
		foreach ($result as $value) {
			$value->setFirstAirDate($this->dateConvert($value->getFirstAirDate()));
		}

		//Compter les saisons et les episodes
		$nb_season=$serie->countSeasonByIdSerie($id);
		$nb_episode=$serie->countEpisodeByIdSerie($id);

		//On récupère la liste des saisons de la serie
		$liste_season=$season->getListeSeason($id);

		//On envoie la liste des saisons
		$this->assign('liste_season',$liste_season);

		//On envoie les variables et appel la view
		$this->assign('id_serie',$id);
		$this->assign('genre',$genre);
		$this->assign('nb_season',$nb_season);
		$this->assign('nb_episode',$nb_episode);
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
		
		//Conversion date en fr
		foreach ($result as $value) {
			$value->setYearStart($this->dateConvert($value->getYearStart()));
		}

		//Si la saison existe
		if(!empty($result))
		{
			//On récupère l'id de la saison
			$id_season=$result[0]->getId();

			//On récupère la liste des episode de la saison
			$liste_episode=$episode->getListeEpisode($id,$id_season);
			foreach ($liste_episode as $value) {
				if($value->getName()=="")
					$value->setName("Episode ".$value->getNumber());
			}
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

		$title=$name_serie." - Saison ".$nb1." - Episode ".$nb2;

		//Si la serie existe :
		if(!empty($name_serie))
		{
			//on récupère l'id de la season
			$result=$season->getIdSeasonByNb($id,$nb1);

			//Si la saison existe
			if(!empty($result))
			{	
				$id_season=$result[0]->getId();
				
				//On récupère la liste des episode de la saison
				$liste_episode=$episode->getListeEpisode($id,$id_season);

				//On envoie la liste des episodes
				$this->assign('liste_episode',$liste_episode);

				//on récupère l'episode
				$result=$episode->getElementEpisode($id,$id_season,$nb2);

				//Conversion date en fr
				foreach ($result as $value) {
					$value->setAirDate($this->dateConvert($value->getAirDate()));
				}			
			}
		}
		//On envoie les variables et appel la view
		$this->assign("title",$title);
		$this->assign('number_season',$nb1);
		$this->assign('number_episode',$nb2);
		$this->assign('id_serie',$id);
		$this->assign('episode_result',$result);
		$this->render("serie/episodeShow");
	}

	public function comment(){
		$comment = new Comment();

		//On defini toutes les variables
		$tab['comment_id_episode']=$_POST['id_episode'];
		$tab['comment_id_user']=$_SESSION['user_id'];
		//Date du jour
		$tab['comment_date_publication']=date("Y-m-d");

		//Verifications des contenus de title et comment
		$tab['comment_content']=trim(strip_tags(htmlspecialchars($_POST['content_comment'], ENT_QUOTES)));

		$tab['comment_status']=0;
		$tab['comment_highlighting']=0;

		//on insère
		$comment->insert($tab,"comment");
	}

	public function searchindex()
	{
		$this->render("serie/serieIndex");
	}

	public function getPageSerie()
	{
		$serie = new Serie();
		$query = $serie->getSeriePage($_POST['page']*5,5);

		foreach ($query as $serie) {
			echo "<li class='serie_user'><a href='/serie/".$serie->getId()."'><p>
			<span class='serie_txt_img'>".$serie->getName()."<br>Note : " . $serie->getNotation()."</span>
			</p><img src='".$serie->getImage()."' class='image_serie'></a>
            <span class='serie_title'>".$serie->getName()."</span></li>";
                
		}
	}

	public function getPageComment()
	{
		$comment = new Comment();
		$user = new User();
		$query = $comment->getCommentPage($_POST['page']*5,5,$_POST['id_episode']);

		//Si un commentaire existe
		if(!empty($query))
		{
			$user_avatar = [];
			foreach ($query as $value) {
				$user_avatar[$value->getId_user()] = 
				['name' => $user->getNameById($value->getId_user()),
				'avatar' => $user->getAvatarById($value->getId_user())];
			}
		}

		echo "<ul class='list_comment'>";
		foreach ($query as $value){
			echo "<li>";
						//Affiche le pseudo de la personne qui a poster le commentaire
			echo "<span id='username_comment'>".$user_avatar[$value->getId_User()]["name"]." <span>".$value->getDate_publication()."</span></span>"; 
			echo "<a href='' data-id='".$value->getId()."'><img id='signal_comment' src='/images/signal.png'></a>";
			echo "<p>".$value->getContent()."</p>";
			echo "<img id='avatar_comment' src='/images/avatar/".$user_avatar[$value->getId_User()]["avatar"]."'>";
			echo "</li>";
		}
		echo "</ul>";
	}

	public function ajaxSearchAllSeriesByName()
	{
		$model_serie = new Serie();
		$result = $model_serie->searchSeriesByName($_GET['term']);
		$data = array();

		if (!empty($result)) {
			foreach ($result as $serie) {
				$data[] = $serie['serie_name'];
			}
		}	

		echo json_encode($data);

	}

	public function ajaxRedirectionSerie()
	{
		$serie_name = $_GET["serie_name"];
        $model_serie = new Serie();
        $serie_id = $model_serie->getIdSerieByName($serie_name);

        echo $serie_id["serie_id"];
	}

	public function commentSignal()
	{
		$comment=new Comment();
		$data['comment_status']=2;
		$comment->_updateEditedComment($_POST["comment_id"],$data);
	}
}