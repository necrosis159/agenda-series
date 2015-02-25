<?php 
	//Inclue le header
	$main_folder = $_SERVER['DOCUMENT_ROOT'];
	include $main_folder.'./tpl/top.php';
	
	//Retourne l'id de la série avec le nom disponible sur l'URL
	$id_Serie = series_get_id_by_name($_GET['name']);
	
	$number_Season = $_GET['saison'];
	$id_Season = series_get_id_season($id_Serie, $number_Season);
	$series_seasons= series_get_season($id_Serie, $number_Season);
	while ($donnees = $series_seasons->fetch()){
		$nb_episode = $donnees['nb_episode'];
		$name_Season = $donnees['name'];
		$description_Season = $donnees['description'];
		$date_start_Season = $donnees['year_start'];
		$date_end_Season = $donnees['year_end'];
		$date_publication = $donnees['date_publication'];
	}
	$series_seasons->closeCursor();

	//Retourne les épisodes d'une saison
	//1er= Retourne juste l'ID et le nom. 2eme = Retourne toutes les colonnes
	$series_seasons_episodes_fast= series_get_active_episode_fast($id_Serie, $id_Season);
	$series_seasons_episodes= series_get_active_episode($id_Serie, $id_Season);

	//Retourne le nom de la série grâce à l'ID
	$serieName= get_series_name_by_id($id_Serie);

 ?>
 <!-- SEASON_DETAIL -->

<div class="wrap">
	<div id="serie_detail">
		<div id="ban">
			<?php 
				if(file_exists('../images/series/season_'.$id_Season.'.png')){echo "<img src='../../images/series/season_".$id_Season.".png'>";}else{echo "<img src='../../images/missing_picture.jpg'>";}
			?>
		</div>
		<div id="containerSerie">
			<div id="divLeft">
				<span id="title"> <?php echo $name_Season;?> </span><br>
				<div id='subtitle'>
					<?php echo $date_start_Season." - ".$date_end_Season."<br>Nombre d'épisode: ".$nb_episode."<br>Date de publication:".$date_publication; ?>
				</div>
				<h3>Description:</h3><br>
				<?php echo $description_Season; ?>
			</div>
			<div id="divRight">
				<div id="episode_easy_access">
				<h2>Accès rapide:</h2>
				<?php 
					//Génération de la liste des épisodes
					$i=1;
					while ($donnees = $series_seasons_episodes_fast->fetch()){
						echo $i++." - <a href='../../les-series/".$_GET['name']."/saison-".$number_Season."/episode-".$donnees['number']."'>".$donnees['name']."</a><br>";
					}
					if($i==1){
						echo '<p>Aucun épisode a été trouvé pour cette saison.</p>';
					}
				?>
				</div>
			</div>
			<div id="episode">
				<br>
				<h3>Episodes: </h3> <br>
				<ul class="list_episode">
					<?php 
						//Génération de la liste d'episode complete pour la saison
						$i=1;
						while ($donnees = $series_seasons_episodes->fetch()){
						echo'
							<li>
								<div id="name_episode"> <a href="../../les-series/'.$_GET['name'].'/saison-'.$number_Season.'/episode-'.$donnees['number'].'">'.$i++.' - '.$donnees['name'].'</a> ('.$donnees['duration'].') <span style="float: right;">'.$donnees['release_date'].'</span></div>
								<p>'.$donnees['description'].'</p>
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
</div>

 <?php
	 $series_seasons_episodes_fast->closeCursor();
	 $series_seasons_episodes->closeCursor();
	include $main_folder.'./tpl/footer.php';
?>