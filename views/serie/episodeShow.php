<?php
if(!empty($episode_result))
{?>
<div class="wrap">
	<div id="serie_detail">
		<div id="containerSerie">
			<div id="divLeft">
				<span id="title"> <?php echo $episode_result[0]->getName();?> </span><br>
				<div id='subtitle'>
					<?php echo "Date : ".$episode_result[0]->getAirDate()."<br> Note: ".$episode_result[0]->getNotation();


					?>
				</div>
				<h3>Description:</h3><br>
				<?php if($episode_result[0]->getOverview()!="")
				echo $episode_result[0]->getOverview();
					else
						echo "Aucun description disponible";
				?>
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
					<span id='username_comment'><?php echo $_SESSION["user_username"]; ?></span>
					<p id='commentZone'>
						<textarea id="content_comment" name="comment" placeholder="Entrer votre commentaire!"></textarea>
						<img style='margin-top: 34px;' id="submit_comment" src="/images/icone-write.png">
						<span id="results"></span>
						<input id="id_episode" type='hidden' value=<?php echo "'".$episode_result[0]->getId()."'" ?>><br>
					</p>
					<?php echo "<img id='avatar_comment' src='/images/".$_SESSION['user_avatar']."'>"; ?>
				</li>
			</ul>
		</div>
		<?php } ?>

		<div class="containerComment">
			<h3>Liste de commentaire:</h3> <br>
			<div id="listeComment"></div>
			<div id="showMore"><button> Voir plus </button></div>
		</div>
	</div>
</div>

<script type="text/javascript" src="/js/serie/comment.js"></script>
<?php
}
else
{
	header('Location:/404');
}?>