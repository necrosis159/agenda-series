<?php
	$main_folder = $_SERVER['DOCUMENT_ROOT'];
   include $main_folder.'./tpl/top.php';
   $id_Serie = $_GET['id'];
   $id_Season = $_GET['saison'];
   $id_Episode = $_GET['episode'];

   $series_seasons_episodes= series_get_all_episode($id_Season, $id_Serie);
	while ($donnees = $series_seasons_episodes->fetch()){
			$name_Episode = $donnees['name'];
			$description_Episode = $donnees['description'];
			$resume_Episode = $donnees['resume'];
			$release_date_Episode = $donnees['release_date'];
			$duration_Episode = $donnees['duration'];
	}
	$series_seasons_episodes->closeCursor();

	 //Retourne tous les commentaires de la série
	$list_comment = series_get_comment($id_Serie);
?>

<!-- EPISODE_DETAIL -->
<div class="wrap">
	<div id="serie_detail">
		<div id="ban">
			<?php 
				$ban_picture = '../images/series/episode_'.$id_Episode.'.png';
				if(file_exists($ban_picture)){echo "<img src='../images/series/episode_".$id_Episode.".png'>";}else{echo "<img src='../images/misssing_picture.jpg'>";}
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
				<div id="user_options">
					<h2>Options:</h2>
					<a class="button" href="#favori">Favori</a>
					<a class="button" href="#calendrier">Calendrier</a>
					<a class="button" href="#favori">Favori</a>
				</div>
			</div>
		</div>
		<?php if(isset($_SESSION['id'])){ ?>
		<div class="sendComment">
			<h3>Ajouter votre commentaire:</h3><br>
			<ul class='list_comment'>
				<li> 
					<span id='username_comment'><?php echo get_user_by_id($_SESSION['id'])['pseudo']; ?></span>
					<p>
						<textarea id="comment" name="comment" placeholder="Entrer votre commentaire!"></textarea>
						<img style='margin-top: 34px;' id="send_comment" src="../images/icone-write.png">
						<span id="results"></span>
					</p>
				</li>
			</ul>
		</div>
		<?php } ?>

		<div class="listComment">
			<h3>Liste de commentaire:</h3> <br>
			<?php
				echo "<ul class='list_comment'>";
				while ($donnees = $list_comment->fetch()){
						echo "<li>";
						//Affiche le pseudo de la personne qui a poster le commentaire
						echo "<span id='username_comment'>".get_user_by_id($donnees['id_user'])['pseudo']."</span>"; 
						echo "<p>".$donnees['content']."</p>";
						echo "<img id='avatar_comment' src='../images/avatar/".get_user_by_id($donnees['id_user'])['avatar']."'>";
						echo "</li>";
				}
				echo "</ul>";
			 ?>
		</div>
	</div>
</div>
<?php
	$list_comment->closeCursor();
	include $main_folder.'./tpl/footer.php';
?>