<?php 
	//Inclue le header
	$main_folder = $_SERVER['DOCUMENT_ROOT'];
	include $main_folder.'./tpl/top.php';

	//Retourne la serie et la saison présent dans le lien
	$id_Serie = $_GET['id'];
	$id_Season = $_GET['saison'];
	$series_seasons= series_get_season($id_Season);
	while ($donnees = $series_seasons->fetch()){
		$number_Season = $donnees['number'];
		$name_Season = $donnees['name'];
		$description_Season = $donnees['description'];
		$date_start_Season = $donnees['dateStart']; 
		$date_end_Season = $donnees['dateEnd'];
	}
	$series_seasons->closeCursor();

	//Retourne les épisodes d'une saison
	//1er= Retourne juste l'ID et le nom. 2eme = Retourne toutes les colonnes
	$series_seasons_episodes_fast= series_get_all_episode_fast($id_Season, $id_Serie);
	$series_seasons_episodes= series_get_all_episode($id_Season, $id_Serie);
 ?>
 <!-- SEASON_DETAIL -->

<div class="wrap">
	<div id="serie_detail">
		<div id="ban">
			<?php 
				$ban_picture = '../images/series/season_'.$id_Season.'.png';
				if(file_exists($ban_picture)){echo "<img src='$ban_picture'>";}else{echo "<img src='../images/misssing_picture.jpg'>";}
			?>
		</div>
		<div id="containerSerie">
			<div id="divLeft">
				<span id="title"> <?php echo $name_Season;?> </span><br>
				<div id='subtitle'>
					<?php echo $date_start_Season." - ".$date_end_Season."<br>"."Nombre d'épisode: ".$number_Season; ?>
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
						echo $i++." - <a href='../../series/episode_detail.php?id=".$id_Serie."&saison=".id_Season."&episode=".$donnees['id']."'>".$donnees['name']."</a><br>";
					}
					if($i==1){
						echo '<p>Aucun épisode trouvé pour cette saison.</p>';
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
								<div id="name_episode"> <a href="../../series/episode_detail.php?id='.$id_Serie.'&saison='.$id_Season.'&episode='.$donnees['id'].'">'.$i++.' - '.$donnees['name'].'</a> ('.$donnees['duration'].') <span style="float: right;">'.$donnees['release_date'].'</span></div>
								<p>'.$donnees['description'].'</p>
							</li>
						';
					}
						if($i==1){
							echo 'Aucun épisode trouvé pour cette saison.';
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