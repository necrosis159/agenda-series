<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/functions.php";
$serie_name = $_GET['serie'];
addSerieToUser($serie_name, $_SESSION['id']);

$data = seriesUser();
if (count($data)):
  ?>
  <ul>
  <?php foreach ($data as $value) : ?>
      <li class='serie_user'>
        <span class="serie_delete" serie_id="<?php echo $value['serie_id'] ?>"><img src="../images/serie_delete.png"></span>
        <img src='../images/<?php echo $value['serie_image']; ?>' class='image_serie'> 
        <span onclick="deleteSerieFollow()" class="serie_title"><?php echo $value['serie_name']; ?></span>
      </li>
  <?php endforeach; ?>
  </ul>
<?php
else :
  echo "Vous ne suivez actuellement aucune série";
endif;
?>
