<?php
$main_folder = $_SERVER['DOCUMENT_ROOT'];
include $main_folder."/tpl/top.php";
$seriesHightlight = series_get_hightlight();

?>

<!-- SERIES -->

<div id="series">
	<div id="search">
		<h2 class="heading">Rechercher votre série</h2> 
                <input class="serie_search" type="text" name="rechercheSerie" id="rechercheSerie" placeholder="Rechercher..."/>
	</div>
	<div id="listOfSeries"> 
		<div id="highlighting">
			<h2 class="heading">Mise en avant</h2>
			<?php
			while ($donnees = $seriesHightlight->fetch()){
				$test= $donnees['image'];
				echo "<div class='sticker'>";
				echo "<a href='../series/serie_detail.php?id=".$donnees['ID']."'><img src=../images/series/vignette_".$test."></a>";
				echo "</div>";
			}
			?>
		</div>
		<div id='recherche'>
			<h2 class="heading">Recherche</h2>
			<div id="results">
				<p>Vous n'avez rien rechercher!</p>
			</div>
		</div>
	</div>


</div>

<?php

   include $main_folder.'./tpl/footer.php';

?>