
<?php
if(!empty($season_result))
{	
	echo "<img src=/".$image_serie." alt=".$name_serie.' style="width : 50%"/><br>';
	echo "Saison ".$number_season."<br>";
	echo "Name : ".$season_result[0]->getName()."<br>";
	echo "Overview : ".$season_result[0]->getOverview().'<br>';
	echo "Nombre d'episode : ".$season_result[0]->getNb_episode().'<br>';
	echo "Notation : ".$season_result[0]->getNotation().'<br>';
	echo "Date de debut : ".$season_result[0]->getYear_start().'<br>';

	//Liste des episode
	foreach ($liste_episode as $value) {
		echo '<a href="Saison'.$number_season.'/Episode'.$value->getNumber().'">Episode '.$value->getNumber().'</a><br>';
	}
}
else
{
	header('Location:http://'.$_SERVER['HTTP_HOST'].'/404');
}?>