<?php
if(!empty($serie_result))
{
	
?>
		<div id="serie_detail">
		<div id="ban">
			</div>
		<div id="containerSerie">
			<div id="divLeft">
				<?php echo "<img src=".$serie_result[0]->getImage()." alt=".$serie_result[0]->getName()." style='width : 80%'/>"; ?>
		

				</div>

			<div id="divRight">
								<span id="title"> <?php echo $serie_result[0]->getName();?> </span><br>
				<div id='subtitle'>
					<?php 
						echo $serie_result[0]->getFirst_air_date()."<br>"; 
					    echo " 5 saisons - 5 episodes <br>";
						echo "Nationalité: ".$serie_result[0]->getNationality()."<br>";
						echo "Note: ".$serie_result[0]->getNotation();
					?>
				</div>
				<h3>Synopsis:</h3><br>
				<?php
					echo $serie_result[0]->getOverview();
				?>

				<h3>Description:</h3><br>
				<?php
					echo "Description";
				?>
				<div id="user_options">
					<h2>Options:</h2>
					<?php echo "<a class='button' id='favorite' name='favorite' href='../../series/serie_detail.php?id=&addFavorite=1'>Favori</a>";?>
					<a class="button" href="#calendrier">Calendrier</a> <br>
				</div>
				<div id="seasons_list">
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
<?php
}
else
{
	header('Location:/404');
}?>