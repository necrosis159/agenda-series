<?php
	$main_folder = $_SERVER['DOCUMENT_ROOT'];
	include $main_folder.'./tpl/top.php';
   	//Retourne l'id de la série avec le nom disponible sur l'URL
	$id_Serie = series_get_id_by_name($_GET['name']);
	$id_Season = $_GET['saison'];
	$id_Episode = $_GET['episode'];

	if(!empty($_SESSION['id']))
	$idUser=$_SESSION['id'];
	$series_seasons_episodes= series_get_active_episode($id_Season, $id_Serie);
	while ($donnees = $series_seasons_episodes->fetch()){
			$name_Episode = $donnees['name'];
			$description_Episode = $donnees['description'];
			$resume_Episode = $donnees['summary'];
			$release_date_Episode = $donnees['release_date'];
			$duration_Episode = $donnees['duration'];
	}
	$series_seasons_episodes->closeCursor();

	 //Retourne tous les commentaires de la série
	$list_comment = series_get_comment($id_Episode);

	//Retourne les épisodes d'une saison
	$series_seasons_episodes_fast= series_get_active_episode_fast($id_Season, $id_Serie);
?>

<!-- EPISODE_DETAIL -->
<div class="wrap">
	<div id="serie_detail">
		<div id="ban">
			<?php 
				$ban_picture = '../images/series/episode_'.$id_Episode.'.png';
				if(file_exists($ban_picture)){echo "<img src='$main_folder/images/series/episode_".$id_Episode.".png'>";}else{echo "<img src='../images/misssing_picture.jpg'>";}
			?>
		</div>
		<div id="containerSerie">
			<div id="divLeft">
				<span id="title"> <?php echo $name_Episode;?> </span><br>
				<div id='subtitle'>
					<?php echo $release_date_Episode."<br>"."Duration: ".$duration_Episode; ?>
				</div>
				<h3>Description:</h3><br>
				<?php echo $description_Episode; ?>
				<h3>Resumé:</h3><br>
				<?php echo $description_Episode; ?>
			</div>
			<div id="divRight">
				<div id="episode_easy_access">
				<h2>Autres épisode:</h2>
				<?php 
					//Génération de la liste des épisodes
					$i=1;
					while ($donnees = $series_seasons_episodes_fast->fetch()){
						echo $i++." - <a href='../../".$_GET['name']."/saison-".$_GET['saison']."/episode-".$donnees['number']."'>".$donnees['name']."</a><br>";
					}
					if($i==1){
						echo '<p>Aucun épisode trouvé pour cette saison.</p>';
					}
				?>
				</div>
			</div>
		</div>
		<?php if(isset($idUser)){ ?>
		<div class="sendComment">
			<h3>Ajouter votre commentaire:</h3><br>
			<ul class='list_comment'>
				<li> 
					<span id='username_comment'><?php echo get_user_by_id($_SESSION['id'])['username']; ?></span>
					<p id='commentZone'>
						<textarea id="comment" name="comment" placeholder="Entrer votre commentaire!"></textarea>
						<img style='margin-top: 34px;' id="send_comment" src="../images/icone-write.png">
						<span id="results"></span>
						<input type="hidden" id='id_user' value="<?php echo $_SESSION['id']; ?>">
						<input type="hidden" id='id_episode' value="<?php echo $id_Episode; ?>">
					</p>
					<?php echo "<img id='avatar_comment' src='$main_folder/images/avatar/".get_user_by_id($_SESSION['id'])['avatar']."'>"; ?>
				</li>
			</ul>
		</div>
		<?php } ?>

		<div class="containerComment">
			<h3>Liste de commentaire:</h3> <br>
			<?php
				echo "<ul class='list_comment'>";
				$i=0;
				while ($donnees = $list_comment->fetch()){
						echo "<li>";
						//Affiche le pseudo de la personne qui a poster le commentaire
						echo "<span id='username_comment'>".get_user_by_id($donnees['id_user'])['username']." <span>".$donnees['date_publication']."</span></span>"; 
						echo "<p>".$donnees['content']."</p>";
						echo "<img id='avatar_comment' src='$main_folder/images/avatar/".get_user_by_id($donnees['id_user'])['avatar']."'>";
						echo "</li>";
						$i++;
				}
				//S'il n'y a pas de commentaire, alors j'avertie l'internaute
				if($i==0){ echo "Il n'y pas encore de commentaire pour cette épisode!";}
				echo "</ul>";
			 ?>
		</div>
	</div>
</div>
<?php
	$list_comment->closeCursor();
	include $main_folder.'./tpl/footer.php';
?>