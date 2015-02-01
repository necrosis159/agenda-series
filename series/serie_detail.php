<?php
	$main_folder = $_SERVER['DOCUMENT_ROOT'];
   include $main_folder.'./tpl/top.php';
   $id_Serie = $_GET['id'];
$_SESSION['id']=1;
   //Retourne toutes les détails de la série
   $series = series_get_detail($id_Serie);
	while ($donnees = $series->fetch()){
			$image = $donnees['image'];
			$short_description = $donnees['short_description']; 
			$description = $donnees['description'];
			$name = $donnees['name'];
			$nationality = $donnees['nationality'];
			$channel = $donnees['channel'];
			$yearStart = $donnees['yearStart'];
			$yearEnd = $donnees['yearEnd'];
			$nbseason = $donnees['nb_seasons'];
			$nbepisode = $donnees['nb_episodes'];
		}

	$series->closeCursor();

    //Retourne tous les commentaires de la série
	$list_comment = series_get_comment($id_Serie);

	//Retourne toutes les saisons de la série
	$series_seasons= series_get_all_seasons($id_Serie);

	//Ajoute la série dans les favoris de l'utilisateur connecté.
	$notation=3;
	if($_GET['addFavorite']==1){
		add_favorite($_SESSION['id'], $id_Serie, $notation);
	}
?>

<div class="wrap">
	<div id="serie_detail">
		<div id="ban">
			<?php echo "<img src='../images/series/ban_".$image."'>"; ?>
		</div>
		<div id="containerSerie">
			<div id="divLeft">
				<span id="title"> <?php echo $name;?> </span><br>
				<div id='subtitle'>
					<?php 
						echo $yearStart." - ".$yearEnd.'<br>'; 
					    echo $nbseason." saisons - ".$nbepisode." episodes <br>";
						echo "Nationalité: ".$nationality." - Chaîne: ".$channel;
					?>
				</div>
				<h3>Synopsis:</h3><br>
				<?php
					echo $short_description;
				?>

				<h3>Description:</h3><br>
				<?php
					echo $description;
				?>
				</div>

			<div id="divRight">
				<div id="user_options">
					<h2>Options:</h2>
					<?php echo "<a class='button' id='favorite' name='favorite' href='../../series/serie_detail.php?id=$id_Serie&addFavorite=1'>Favori</a>";?>
					<a class="button" href="#calendrier">Calendrier</a> <br>
				</div>
				<div id="seasons_list">
					<h2>Saisons:</h2>
					<?php 
						//Génération des liens de redirection
						$i=1;
						while($donnees = $series_seasons->fetch()){
							$i++;
							echo "<a href='../../series/season_detail.php?id=".$id_Serie."&saison=".$donnees['ID']."'>".$donnees['name']."</a><br>";
						}
						if($i==1){
							echo "Aucune saison a été trouvée pour cette série.";
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	$list_comment->closeCursor();
	$series_seasons->closeCursor();
	include $main_folder.'./tpl/footer.php';
?>