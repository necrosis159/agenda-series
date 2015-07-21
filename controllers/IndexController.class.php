<?php
class indexController extends baseView {
	

	public function index()
	{
		$serie = new Serie();
		$comment = new Comment();
		$user = new User();

		$result = $serie->getSerieAllHighlight();
		$resultComment = $comment->getCommentAllHighlight();
		
		$serieInfo = [];
		foreach ($result as $value) {
			$serieInfo[$value->getId()] = 
			['seasonNB' => $serie->countSeasonByIdSerie($value->getId()),
			 'episodeNB' => $serie->countEpisodeByIdSerie($value->getId())];
		}

		$resultUser = [];
		foreach ($resultComment as $value) {
			$resultUser[$value->getId_user()] = 
			['avatar' => $user->getAvatarById($value->getId_user())];
		}

		$this->assign("serieHightlight", $result);
		$this->assign("serieInfo", $serieInfo);
		$this->assign("commentaireHightlight", $resultComment);
		$this->assign("userAvatar", $resultUser);
		$this->render("indexIndex");
	}
}