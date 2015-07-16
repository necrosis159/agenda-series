<?php
if(!empty($serie_result))
{	
	echo "<img src=/".$serie_result[0]->getImage()." alt=".$name_serie.' style="width : 50%"/><br>';
	echo $serie_result[0]->getName().'<br>';
	echo $serie_result[0]->getDescription().'<br>';
	echo $serie_result[0]->getNationality().'<br>';
	echo $serie_result[0]->getYear_start().'<br>';
	echo $serie_result[0]->getYear_end().'<br>';
	echo $serie_result[0]->getNotation().'<br>';
	echo $serie_category.'<br>';
	echo $serie_result[0]->getStatus().'<br>';

	//Liste des saisons
	foreach ($liste_season as $value) {
		echo '<a href="'.$name_serie.'/Saison'.$value->getNumber().'">Saison '.$value->getNumber().'</a><br>';
	}

}
else
{
	header('Location:/404');
}?>