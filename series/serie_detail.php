<?php
	$main_folder = $_SERVER['DOCUMENT_ROOT'];
   include $main_folder.'./tpl/top.php';
   $idSerie = $_GET['id'];

   //Retourne toutes les détails de la série
   $series = series_get_detail($idSerie);

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
?>
<!-- SERIES_DETAIL -->
<div id="serie_detail">
	<div id="ban">
		<?php echo "<img src='../images/series/ban_".$image."'></a>"; ?>
	</div>
	<div id="containerSerie">
		<div id="divLeft">
			<span id="title"> <?php echo $name;?> </span><br>
			<div id='subtitle'>
				<?php echo $yearStart." - ".$yearEnd; ?> <br>
				<?php echo $nbseason." saisons - ".$nbepisode." episodes <br>";
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
			<a class="button" href="#favori">Favori</a>
			<a class="button" href="#calendrier">Calendrier</a>
			<a class="button" href="#favori">Favori</a>
		</div>
	</div>
	<div class="sendComment">
		<h2 id="title">Commentaire:</h2>
		<textarea id="comment" name="comment" placeholder="Entrer votre commentaire!"></textarea>
		<img id="send_comment" src="../images/icone-write.png">
		<div id="results"></div>
		<div ></div>
	</div>
	<div class="listComment">
		<h2 id="title">Liste de commentaire:</h2>
		<?php 
			$list_comment = series_get_comment($idSerie);
			while ($donnees = $list_comment->fetch()){
				echo "<div>";
				echo $donnees['comment'];
				echo "</div>";
			}
		 ?>
	</div>
</div>

<?php

   include $main_folder.'./tpl/footer.php';

?>