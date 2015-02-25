<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

$id=user_id($_GET['username']);
$result = selectInfosUser($id)->fetch();
?>
<div class="wrap">
  <section id="my_series">
    <section id="user_series">
      <h5 class="heading">Séries de <?php echo $result['username']; ?></h5>
        <div id="series_follow">
          <?php
          $data = seriesUser($id);
          if(count($data)): ?>
            <ul>
        <?php foreach ($data as $value) : ?>
              <li class='serie_user'>
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