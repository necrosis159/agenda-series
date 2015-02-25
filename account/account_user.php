<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

$id=user_id($_GET['username']);
$result = selectInfosUser($id)->fetch();
$avatar = $result['avatar'];
?>

<div id="profile_bloc">
  <div class="wrap">
    <h1 class="heading">Profil de <?php echo $result['username']; ?></h1>
    <div id="profile_avatar">
      <img src="../images/<?php echo $avatar; ?>" class="avatar_image">
    </div>
    <div id="profile_informations">
      <ul>
        <li><?php echo $result['username']; ?> inscrit depuis le <?php echo $result['creation_date']; ?></li>
        <li>Age : <?php echo age($result['birthdate']); ?></li>
        <li>Dernière connexion : <?php echo $result['last_login']; ?></li>
        <li>Nombre de séries suivies : <?php echo count(seriesUser($id)); ?></li>
        <li>Nombre d'articles postés : </li>
        <li>Nombre de commentaires rédigés : </li>
        <li>Nombre de notes attribuées : </li>
      </ul>
    </div>
  </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";
?>