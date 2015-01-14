<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";
?>
<section id="my_series">
    <section id="user_add_series">
        <div class="wrap">
            <h1>Ajouter une série</h1>
            <div id="search_series">
                <form class="ajax" action="" method="get">
                    <input type="text" name="q" id="q" placeholder="Rechercher..."/>
                    <input type="submit" value="">
                </form>
            </div>
              <div id="results"></div>
        </div>
    </section>
  <section id="user_series">
    <h1>Mes séries</h1>
    <?php
    $result = seriesUser();
    
      foreach ($result as $data) {
        echo "<div class='serie_user'>";
        echo "<img src='../images/".$data['image']."'class='image_serie'>";
        echo "</div>";
      }
      $result->closeCursor();
    ?>
  </section>
</section>