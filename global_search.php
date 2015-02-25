<?php
  include './tpl/top.php';
?>
  
<div id="gs_series">
  <div class="wrap">
    <?php
      if(isset($_POST['search_text'])) :
        $search = $_POST['search_text'];

        $dataSeries = gs_get_series($search);
        $dataUsers = gs_get_user($search);
      
    ?>
    <h1 class="heading">Résultat Séries</h1>
    <?php if(count($dataSeries) > 0) : ?>
      <?php foreach ($dataSeries as $series) : ?>
      <div class="gs_row">
        <div class="gs_image">
          <a href="les-series/<?php echo $series['rewrite']; ?>"><p><span class="gs_text_img"><?php echo $series['short_description']; ?></span></p><img src="images/<?php echo $series['image']; ?>" height="200px" width="150px"></a>
        </div>
        <div class="gs_description">
          <?php echo $series['name'].' Note : '. $series['notation']; ?>
          <br/>
          <?php
          $data = getNbFollowersSeries($series['id']);
          echo $data[0] . ' utilisateurs suivent cette série.';
          ?>
          <p>
            <?php echo $series['description']; ?>
          </p>
        </div>
      </div>
      <?php endforeach; 
     else: ?>
    Aucun résultat pour "<?php echo $search; ?>" dans les séries.
    <?php endif; ?>
  </div>
</div>

<div id="gs_user">
  <div class="wrap">
    <h1 class="heading">Résultat Utilisateurs</h1>
    <?php if(count($dataUsers) > 0) : ?>
    <?php foreach ($dataUsers as $user) : ?>
      <div class="gs_row">
        <div class="gs_image">
          <a href="account/<?php echo $user['username']; ?>"><img src="images/<?php echo $user['avatar']; ?>" height="150px" width="150px"></a>
        </div>
        <div class="gs_description">
          <?php echo $user['username']; ?>
          <br/>
          <p>Abonné à <?php echo count(seriesUser($user['id'])); ?> séries.</p>
        </div>
      </div>
    <?php endforeach; ?>
    <?php else: ?>
      Aucun résultat pour "<?php echo $search; ?>" dans les utilisateurs.
    <?php endif; 
       else: 
         error_message("Vous n'avez rien recherché");
        endif; ?>
  </div>
</div>

<?php
  include './tpl/footer.php'
?>
