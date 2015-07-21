<?php
if(!empty($serie_result))
{

	?>
	<div id="serie_detail">
		<div id="containerSerie">
			<div id="divLeftSerie">
				<?php if($serie_result[0]->getImage()!="")
					echo "<img src='". $serie_result[0]->getImage()."' alt=".$serie_result[0]->getName()."/>";
				else
					echo "<img src='/images/No_Image_Available' alt=".$serie_result[0]->getName()."/>";?>
			</div>

			<div id="divRightSerie">
				<span id="title"><?php echo $serie_result[0]->getName();?></span><br>
				<div id='subtitle'>
					<?php
					echo "Date : ".$serie_result[0]->getFirstAirDate()."<br>";

					echo $nb_season." saisons -";

					echo $nb_episode." episodes <br>";

					if($serie_result[0]->getNationality()!="")
						echo "Nationalité: ".$serie_result[0]->getNationality()."<br>";
					if($serie_result[0]->getNotation()!="")
						echo "Note: ";
					for($i= 1; $i <= $serie_result[0]->getNotation(); $i++) {
						echo '<img style="width: 2.5%;" src="../../../images/star.png" />';
					}
					if(strpos($serie_result[0]->getNotation(), '.')) {
						echo '<img style="width: 2.5%;" src="../../../images/half_star.png" />';
						$i++;
					}
					while($i <= 10) {
						echo '<img style="width: 2.5%;" src="../../../images/blank_star.png" />';
						$i++;
					}
					echo "<br>";
					if($genre!="")
						echo "Genre: ".$genre;
					else
						echo "Aucun Genre";
					?>
				</div>
				<h3>Description:</h3><br>
				<?php
				if($serie_result[0]->getOverview()!="")
					echo $serie_result[0]->getOverview();
				else
					echo "Aucun description disponible";
				?>
				<br>
				<br>
				<div id="user_options">
					<h2>Options:</h2>
					<?php if (isset($_SESSION["user_id"])) echo "<a class='button' id='favorite' name='favorite' href=''>Favori</a>";?>
					<a class="button" href="/calendar/show">Calendrier</a> <br><br>
					<h2>Saisons:</h2>
					<?php
						//Génération des liens de redirection
					$i=1;
					foreach ($liste_season as $value) {
						$i++;
						echo '<a href="/serie/'.$id_serie.'/Saison'.$value->getNumber().'">Saison '.$value->getNumber().'</a><br>';
					}
					if($i==1){
						echo "Aucune saison a été trouvée pour cette série.";
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="/js/serie/serie.js"></script>
	<?php
}
else
{
	header('Location:/404');
}?>
