<?php
include "tpl/top.php";
include "tpl/menu_account.php";
?>
<section id="my_series">
  <section id="user_add_series">
    <h1>Ajouter une série</h1>
    <div id="search_series">
        <form class="ajax" action="" method="get">
            <input type="text" name="q" id="q" placeholder="Rechercher..."/>
            <input type="submit" value="">
        </form>
      <div id="results"></div>
    </div>
  </section>
  <section id="user_series">
    <h1>Mes séries</h1>
    <?php
    $query = $db->prepare("SELECT * FROM series s, series_users t, users u
                             WHERE u.id = t.id_user AND t.id_serie = s.id
                             AND u.id = :id
                             LIMIT 0,5
                             ");
      $query->execute(array("id"=>$id));
      foreach ($query as $data) {
        echo "<div class='serie_user'>";
        echo "<img src='images/".$data['image']."'class='image_serie'>";
        echo "</div>";
      }
      $query->closeCursor();
    ?>
  </section>
</section>