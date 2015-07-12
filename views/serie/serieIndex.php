<script src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/search.js"></script>

<div id="series">
	<div id="search">
		<h2 class="heading">Rechercher votre série</h2> 
                <input style="height: 40px;" class="serie_search" type="textarea" name="rechercheSerie" id="search" placeholder="Rechercher..."/>
                <button id="search_submit">Envoyer</button><br>
	</div>
	<div id="listOfSeries"> 

		<div id="search_result"></div>

		<div id="highlighting" style="clear:both;">
			<h2 class="heading">Mise en avant</h2>
			
		</div>	
		<div id="">
			<h2 class="heading">Les séries</h2>
		<?php		
			foreach ($lesSeries as $serie) {
				echo "<span class='sticker'>";
				echo "<a href='/serie/".$serie->getId()."'><img src='".$serie->getImage()."'></a>";
				echo "</span>";
			}
		?>
		</div>
	</div>


</div>