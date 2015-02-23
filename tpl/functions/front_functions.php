<?php
/*LES SERIES*/

  //Retourne toutes les séries
  function series_get_all_series($name) {

  // Connection à la base de données
  $db = call_pdo();

  $query = $db->prepare("SELECT * FROM serie s
                       WHERE s.name LIKE :name
                       ");
  $query->execute(array("name" => "%" . $name . "%"));
  
  return $query;
}

   //Retourne les séries mise en avant
   function series_get_hightlight(){
    $db = call_pdo();
    $series = $db->query('SELECT * FROM serie WHERE `highlighting`=1');
    return $series;
   }

   //Retourne les détails d'une série (par son ID)
   function series_get_detail($idSerie){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM serie WHERE id='.$idSerie);
    return $seriesDetail;
   }

   //Retourne la liste des saisons d'une série (par son ID)
   function series_get_all_seasons($idSerie){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM seasons WHERE idSerie='.$idSerie);
    return $seriesDetail;
   }

   //Retourne la saison par son ID
   function series_get_season($idSaison){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM seasons WHERE ID='.$idSaison);
    return $seriesDetail;
   }

   //Retourne toutes les episodes d'une série par l'id de la série et de la saison (croissant par date d'apparution)
   function series_get_all_episode($idSerie, $idSaison){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM episodes WHERE id_season='.$idSaison.' AND id_serie='.$idSerie.'  ORDER BY release_date');
    return $seriesDetail;
   }

   //Retourne seulement l'id et le nom de toutes les episodes d'une série par l'id de la série et de la saison (croissant par date d'apparution)
   function series_get_all_episode_fast($idSerie, $idSaison){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT id, name FROM episodes WHERE id_season='.$idSaison.' AND id_serie='.$idSerie.'  ORDER BY release_date');
    return $seriesDetail;
   }

   //Retourne toutes les commentaires d'un episode
   function series_get_comment($idEpisode){
    $db = call_pdo();
    
    $queryListComment = $db->prepare("SELECT * FROM `comment` WHERE `id_episode`=:idEpisode");
    $queryListComment->execute(array("idEpisode"=>$idEpisode));

    //$queryListComment = $db->query("SELECT * FROM `comment` WHERE `idEpisode`=".$idEpisode."");

    return  $queryListComment;
  }

  //Retourne le nom de l'utilisateur de son ID
  function get_user_by_id($idUser){
    $db = call_pdo();

    $query = $db->prepare("SELECT * FROM `user` WHERE `ID`= :idUser");
    $query->execute(array("idUser"=>$idUser));

    return $query->fetch();
  }

  //Ajoute un commentaire (Retourne 0 si l'ajout du commentaire est un echec sinon 1)
  function add_comment($idUser, $idEpisode, $idSeason, $idSerie, $date, $comment, $notation){
      $db = call_pdo();
       $query = $db->query("INSERT INTO `agendaserie`.`comment` (`id`, `id_user`, `id_episode`, `id_season`, `id_serie`, `date_publication`, `content`, `notation`) 
      VALUES (NULL, '".$idUser."', '".$idEpisode."', '".$idSeason."', '".$idSerie."', '".$date."', '".$comment."', '".$$notation."');");

     /* $query = $db->prepare("INSERT INTO `agendaserie`.`comment` (`id`, `id_user`, `id_episode`, `id_season`, `id_serie`, `date_publication`, `content`, `notation`) VALUES (NULL, ':id_user', ':id_episode', ':id_season', ':id_serie', ':date_publication', ':content', ':notation');");
      $query->execute(array("id_user"=>$idUser, 'id_episode'=>$idEpisode, 'id_season'=>$idSeason, 'id_serie'=>$idSerie, 'date_publication'=>$date, 'content'=>$comment, 'notation'=>$notation));
      *///return $query->fetch();
  }

  function add_favorite($idUser, $idSerie, $notation){
      // Connection à la base de données
      $db = call_pdo();

      //Ajout de l'utilisteur et de la série dans la table des favoris
      $query = $db->prepare("INSERT INTO `agendaserie`.`series_users` (`id_serie`, `id_user`, `notation`) VALUES (':id_serie', ':id_user', ':notation');");

      $query->execute(array("id_serie"=>$idSerie, "id_user"=>$idUser, "notation"=>$notation));
  }

/*FIN SERIES*/
?>