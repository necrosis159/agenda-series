<?php
/*LES SERIES*/
  
  //Retourne toutes les séries
  function get_all_series(){
    // Connection à la base de données
      $db = call_pdo();

      //Ajout de l'utilisteur et de la série dans la table des favoris
      $query = $db->prepare("SELECT * FROM `serie`");
      $query->execute(array());
      return $query->fetch();
  }

  //Recherche série par le nom
  function series_research($name) {

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
    $series = $db->query('SELECT * FROM serie WHERE `highlighting`=1 AND `status`=1');
    return $series;
   }

   //Retourne les séries mise en avant
   function series_get_online(){
    $db = call_pdo();
    $series = $db->query('SELECT * FROM serie WHERE `status`=1');
    return $series;
   }

   //Retourne les séries mise en avant
   function series_get_last_published(){
    $db = call_pdo();
    $series = $db->query('SELECT * FROM `serie` ORDER BY `date_publication` LIMIT 4');
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
    $seriesDetail = $db->query('SELECT * FROM season WHERE id_serie='.$idSerie);
    return $seriesDetail;
   }

   //Retourne les saisons d'une série
   function series_get_active_season($idSerie){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM season WHERE id_serie='.$idSerie.' AND `status`=1');
    return $seriesDetail;
   }

   //Retourne les saisons d'une série
   function series_get_season($idSerie, $id_Season){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM season WHERE id_serie='.$idSerie.' AND number='.$id_Season.' AND `status`=1');
    return $seriesDetail;
   }

    //Retourne l'ID de la saison d'une série par rapport à son numéro 
   function series_get_id_season($idSerie, $number_Season){
    $db = call_pdo();
    $seasonDetail = $db->query('SELECT id FROM season WHERE id_serie='.$idSerie.' AND number='.$number_Season);
    $id_season = $seasonDetail->fetch();
    return $id_season['id'];
   }

   //Retourne l'ID de l'episode d'une série par rapport à sa saison et son numéro 
   function series_get_id_episode($idSerie, $idSeason, $numberEpisode){
    $db = call_pdo();
    $EpisodeDetail = $db->query('SELECT id FROM episode WHERE id_serie='.$idSerie.' AND id_season='.$idSeason.' AND number='.$numberEpisode.'');
    $id_episode = $EpisodeDetail->fetch();
    return $id_episode['id'];
   }

   //Retourne toutes les episodes actives d'une série par l'id de la série et de la saison (croissant par date d'apparution)
   function series_get_active_episode($idSerie, $idSaison){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM episode WHERE id_season='.$idSaison.' AND id_serie='.$idSerie.' AND status="1"  ORDER BY release_date');
    return $seriesDetail;
   }

   //Retourne seulement l'id, le nom, number de toutes les episodes actives d'une série par l'id de la série et de la saison (croissant par date d'apparution)
   function series_get_active_episode_fast($idSerie, $idSaison){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT id, name, number FROM episode WHERE id_season='.$idSaison.' AND id_serie='.$idSerie.' AND status="1" ORDER BY release_date');
    return $seriesDetail;
   }
    //Retourne l'id d'un episode
    function series_get_episode_id_by_name($name){
        $db = call_pdo();
        $queryListComment = $db->prepare("SELECT id FROM `episode` WHERE `name`=:name");
        $queryListComment->execute(array("name"=>$name));


    }

   //Retourne toutes les commentaires d'un episode
   function series_get_comment($idEpisode){
    $db = call_pdo();
    
    $queryListComment = $db->prepare("SELECT * FROM `comment` WHERE `id_episode`=:idEpisode");
    $queryListComment->execute(array("idEpisode"=>$idEpisode));

    return  $queryListComment;
  }

   //Retourne les commentaires d'un episode avec un flag mise en avant
   function series_get_comment_highlight(){
    $db = call_pdo();
    
    $queryListComment = $db->prepare("SELECT * FROM `comment` WHERE `highlighting`=1");
    $queryListComment->execute();

    return  $queryListComment;
  }


  //Retourne l'id de la série avec le nom
  function series_get_id_by_name($name){
    $db = call_pdo();
    
    $query = $db->prepare("SELECT id FROM `serie` WHERE `name`=:name");
    $query->execute(array("name"=>$name));

    while($donnee = $query->fetch()){
      return $donnee['id'];
    }
  }

  //Retourne le nom de l'utilisateur de son ID
  function get_user_by_id($idUser){
    $db = call_pdo();

    $query = $db->prepare("SELECT * FROM `user` WHERE `id`= :idUser");
    $query->execute(array("idUser"=>$idUser));

    return $query->fetch();
  }

  //Ajoute un commentaire (Retourne 0 si l'ajout du commentaire est un echec sinon 1)
  function add_comment($idUser, $idEpisode, $title, $date, $comment, $notation, $status){
      $db = call_pdo();/*
      $query = $db->prepare("INSERT INTO `agendaserieovh`.`comment` (`id`, `id_episode`, `id_user`, `date_publication`, `title`, `content`, `notation`, `status`) VALUES (NULL, ?, , ?, ?, ?, ?, ?);");
      $query->execute(array($idEpisode, $idUser, $date, $title, $content, $notation, $status));*/
      $db->query("INSERT INTO `agendaseltserie`.`comment` (`id`, `id_episode`, `id_user`, `date_publication`, `title`, `content`, `notation`, `status`) VALUES (NULL, '".$idEpisode."', '".$idUser."', '2015-02-04', 'azdazdazd', '".$comment."', '5', '1');");
  }

  function add_favorite($idUser, $idSerie, $notation){
      // Connection à la base de données
      $db = call_pdo();

      //Ajout de l'utilisteur et de la série dans la table des favoris
      $query = $db->prepare("INSERT INTO `agendaserie`.`series_users` (`id_serie`, `id_user`, `notation`) VALUES (':id_serie', ':id_user', ':notation');");

      $query->execute(array("id_serie"=>$idSerie, "id_user"=>$idUser, "notation"=>$notation));
  }

  function get_series_name_by_id($id){
     // Connection à la base de données
      $db = call_pdo();

      //Ajout de l'utilisteur et de la série dans la table des favoris
      $query = $db->prepare("SELECT `name` FROM `serie` WHERE `id`=:id");
      $query->execute(array("id"=>$id));

      while ($donnee = $query->fetch()){
          return $donnee['name'];
      }
  }

/*FIN SERIES*/
?>