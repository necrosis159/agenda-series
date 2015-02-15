<?php
$main_folder = $_SERVER['DOCUMENT_ROOT'];
include $main_folder."/tpl/top.php";
$seriesHightlight = series_get_hightlight();
$seriesOnline = series_get_online();
?>

<!-- SERIES -->

<div id="series">
	<div id="search">
		<h2 class="heading">Rechercher votre série</h2> 
                <input class="serie_search" type="text" name="rechercheSerie" id="rechercheSerie" placeholder="Rechercher..."/>
	</div>
	<div id="listOfSeries"> 

		<div id='recherche'>
		</div>

		<div id="highlighting" style="clear:both;">
			<h2 class="heading">Mise en avant</h2>
			<?php
			while ($donnees = $seriesHightlight->fetch()){				
				echo "<span class='sticker'>";
				echo "<a href='../les-series/".$donnees['name']."'><img src=../images/series/vignette_".$donnees['image']."></a>";
				echo "</span>";
			}
			?>
		</div>	
		<div id="">
			<h2 class="heading">Les séries</h2>
		<?php		
			while ($donnees = $seriesOnline->fetch()){				
				echo "<span class='sticker'>";
				echo "<a href='../les-series/".$donnees['name']."'><img src=../images/series/vignette_".$donnees['image']."></a>";
				echo "</span>";
			}
			?>
		</div>
	</div>


</div>

<?php

   include $main_folder.'./tpl/footer.php';

?>