
<?php
$_SESSION['Id']=1;
if(!empty($episode_result))
{	
	echo "Saison ".$season_number.' Episode '.$episode_number.'<br>';
	echo "Name : ".$episode_result[0]->getName().'<br>';
	echo "Overview : ".$episode_result[0]->getOverview().'<br>';
	echo "Notation : ".$episode_result[0]->getNotation().'<br>';
	echo "Date : ".$episode_result[0]->getAir_date().'<br>';

	//Ajouter un commentaire
?>
<input id="title_comment" type="text"></input>
<input id="content_comment" type="textarea"></input>
<input id="id_episode" type='hidden' value=<?php echo "'".$episode_result[0]->getId()."'" ?>><br>
<button id="submit_comment">Envoyer</button><br>


<?php	//Liste des Commentaire
	foreach ($liste_comment as $value) {
		echo $value->getId_user().' '.$value->getTitle().' '.$value->getDate_publication().'<br>';
		echo '     '.$value->getContent().'<br><br>';
	}
?>
<div id="test"><div>
<?php
}
else
{
	header('Location:http://'.$_SERVER['HTTP_HOST'].'/404');
}?>

<script src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/comment.js"></script>