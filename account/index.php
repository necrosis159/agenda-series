<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

$result = selectInfosUser()->fetch();
if ($result['avatar'] == '') {
    if ($result['gender'] == '1') {
        $avatar = 'avatar_woman.png';
    } else {
        $avatar = 'avatar_man.png';
    }
}

$explode_birthdate = explode('-', $result['birthdate']);
$birthdate = $explode_birthdate[1].'/'.$explode_birthdate[0].'/'.$explode_birthdate[2];
?>

<div class="wrap">
    <div id="profile_bloc">
        <h1 class="heading">Mon Profil</h1>
        <div id="profile_avatar">
            <img src="../images/<?php echo $avatar; ?>" class="avatar_image">
            <div id='avatar_modify'>
                <a href='#' class="button">Modifier l'Avatar</a>
            </div>
        </div>
        <div id="profile_informations">
            <ul>
                <li><?php echo $result['pseudo']; ?> inscrit depuis le <?php echo $result['creation_date']; ?></li>
                <li>Age : <?php echo age($result['birthdate']); ?></li>
                <li>Dernière connexion : <?php echo $result['last_login']; ?></li>
                <li>Nombre de séries suivies : <?php echo count(seriesUser()); ?></li>
                <li>Nombre d'articles postés : </li>
                <li>Nombre de commentaires rédigés : </li>
                <li>Nombre de notes attribuées : </li>
            </ul>
        </div>
        <h1 class='heading'></h1>
    </div>
</div>