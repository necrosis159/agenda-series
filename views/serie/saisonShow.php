
<?php
if(!empty($season_result))
{	

	//Liste des episode
	
	?>
<div id="serie_detail">
		<div id="ban">
		</div>
		<div id="containerSerie">
			<div id="divLeft">
					<?php echo "<img src=".$season_result[0]->getImage()." alt=".$name_serie."/>"; ?>
			</div>
			<div id="divRight">

				<span id="title"> <?php echo $season_result[0]->getName();?> </span><br>
				<div id='subtitle'>
					<?php echo "Nombre d'épisode: ".$season_result[0]->getNbepisode()."<br>Date de publication:".$season_result[0]->getYearstart(); ?>
				</div>
				<h3>Description:</h3><br>
				<?php echo $season_result[0]->getOverview(); ?>
			</div>
			<div id="episode">
				<br>
				<h3>Episodes: </h3> <br>
				<ul class="list_episode">
					<?php 
						//Génération de la liste d'episode complete pour la saison
						$i=1;

						foreach ($liste_episode as $value) {
							$i++;
							echo '
								<li>
									<div id="name_episode"> <a href="/serie/'.$id_serie.'/Saison'.$number_season.'/Episode'.$value->getNumber().'">'.$value->getName().'</a> <span style="float: right;">'.$value->getAirDate().'</span></div>
									<p>'.mb_substr($value->getOverview(), 0, 100, "utf-8").'...</p>
								</li>
							 ';
						}
						if($i==1){
							echo 'Aucun épisode a été trouvé pour cette saison.';
						}
					
					?>
				</ul>
			</div>
		</div>
	</div>
	<?php
}
else
{
	header('Location:http://'.$_SERVER['HTTP_HOST'].'/404');
}?>