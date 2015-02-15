<?php 
session_start();
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/global_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/user_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/series_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/comment_functions.php';
   include $_SERVER['DOCUMENT_ROOT'] . '/tpl/functions/front_functions.php';
$name = $_GET["q"];
$result = searchSeries($name, $_SESSION['id']);

//while($data  = $result->fetch()) {
//  echo "<div class='serie_user'>";
//  echo "<img src='../images/".$data['image']."' class='image_serie'>";
//  echo "</div>";
//}
?>
<form action="" method="POST">
  <ul id="search_series_list">
  <?php
  $data = $result->fetchAll();
    if(count($data) > 0) {
      foreach($data as $serie) { 
  ?>
        <li class="serie_add"><?php echo $serie['name']; ?></li>
  <?php 
      } 
    } else {
  ?>
      <li class="serie_add">Pas de résultat</li>
  <?php    
    }
  ?>
  </ul>
</form>

<?php
$result->closeCursor();
?>
