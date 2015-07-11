<?php
if(!empty($serie_result))
{	
	echo "<img src=/".$serie_result[0]->getImage()." alt=".$serie_result[0]->getName().' style="width : 50%"/><br>';
	echo $serie_result[0]->getName().'<br>';
	echo $serie_result[0]->getOverview().'<br>';
	echo $serie_result[0]->getNationality().'<br>';
	echo $serie_result[0]->getNotation().'<br>';
	echo $serie_result[0]->getStatus().'<br>';

	//Liste des saisons
	foreach ($liste_season as $value) {
		echo '<a href="'.$id_serie.'/Saison'.$value->getNumber().'">Saison '.$value->getNumber().'</a><br>';
	}

}?>