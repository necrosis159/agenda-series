<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";
?>
<div class="wrap">
  <section id="my_series">
    <section id="user_add_series">
      <h5 class="heading">Ajouter une série</h5>
      <div class="search_series">
        <form class="ajax" action="" method="get">
          <input type="text" name="q" id="q" value="" placeholder="Rechercher..." autocomplete="off">
          <input type="button" class="button" value="Ajouter" id="add_serie_button">
        </form>
      </div>
      <div id="results_bloc">
        <div id="results"></div>
      </div>
  </section>
    <section id="user_series">
      <h5 class="heading">Mes séries</h5>
        <div id="series_follow">
          <?php
          $data = seriesUser($id);
          if(count($data)): ?>
            <ul>
        <?php foreach ($data as $value) : ?>
              <li class='serie_user'>
                <span class="serie_delete" serie_id="<?php echo $value['serie_id'] ?>"><img src="../images/serie_delete.png"></span>
                <a href="#"><p><span class="serie_txt_img"><?php echo $value['serie_short_description'] ?></span></p><img src='../images/<?php echo $value['serie_image']; ?>' class='image_serie'></a>
                <span class="serie_title"><?php echo $value['serie_name']; ?></span>
              </li>
        <?php endforeach; ?>
            </ul>
    <?php else :
            echo "Vous ne suivez actuellement aucune série";
          endif;
          ?>
        </div>
      </section>
  </section>
  
</div>
<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";
?>