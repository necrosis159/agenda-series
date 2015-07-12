<script src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/comment.js"></script>

<div class="wrap">
	<div id="serie_detail">
		<div id="containerSerie">
			<div id="divLeft">
				<span id="title"> <?php echo $episode_result[0]->getName();?> </span><br>
				<div id='subtitle'>
					<?php echo "Date de sortie: ".$episode_result[0]->getAirDate()."<br> Note: ".$episode_result[0]->getNotation();


					?>
				</div>
				<h3>Description:</h3><br>
				<?php echo $episode_result[0]->getOverview(); ?>
			</div>
			<div id="divRight">
				<div id="episode_easy_access">
				<h2>Autres épisode:</h2>
				<?php 
					//Génération de la liste des épisodes
					$i=1;
					foreach ($liste_episode as $value) {
						$i++;
						echo '<a href="/serie/'.$id_serie.'/Saison'.$number_season.'/Episode'.$value->getNumber().'">Episode '.$value->getNumber().'</a><br>';
					}
					if($i==1){
						echo 'Aucun épisode a été trouvé pour cette saison.';
					}
				?>
				</div>
			</div>
		</div>
		<?php if(isset($_SESSION['user_id'])){ ?>
		<div class="sendComment">
			<h3>Ajouter votre commentaire:</h3><br>
			<ul class='list_comment'>
				<li> 
					<span id='username_comment'><?php echo "PSEUDO"; ?></span>
					<p id='commentZone'>
						<textarea id="content_comment" name="comment" placeholder="Entrer votre commentaire!"></textarea>
						<img style='margin-top: 34px;' id="submit_comment" src="/images/icone-write.png">
						<span id="results"></span>
						<input type="hidden" id='id_user' value="<?php echo $_SESSION['user_id']; ?>">
						<input type="hidden" id='title' value="<?php echo $title; ?>">
						<input id="id_episode" type='hidden' value=<?php echo "'".$episode_result[0]->getId()."'" ?>><br>
					</p>
					<?php echo "<img id='avatar_comment' src='/images/'>"; ?>
				</li>
			</ul>
		</div>
		<?php } ?>

		<div class="containerComment">
			<h3>Liste de commentaire:</h3> <br>
			<?php
				echo "<ul class='list_comment'>";
				$i=0;
				foreach ($liste_comment as $value){
						echo "<li>";
						//Affiche le pseudo de la personne qui a poster le commentaire
						echo "<span id='username_comment'><a href=\"../../../account/".$value->getId_User()."\">".$user_avatar[$value->getId_User()]["name"]."</a> <span>".$value->getDate_publication()."</span></span>"; 
						echo "<p>".$value->getContent()."</p>";
						echo "<img id='avatar_comment' src='../../../images/".$user_avatar[$value->getId_User()]["avatar"]."'>";
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