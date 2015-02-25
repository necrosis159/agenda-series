<?php

   // Fonction de création d'un épisode
   function create_episode($id_user, $id_serie, $id_season, $name, $number, $rewrite, $status, $short_description, $summary) {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération de la date actuelle
      $current_date = date('Y-m-d');

      // Ajout des nouveaux champs de l'épisode
      $query = $db->prepare('INSERT INTO episode VALUES ("", ' . $id_serie . ', ' . $id_season . ', "' . $name . '", ' . $number . ', "' . $short_description . '", ' . $status . ', "' . $summary . '", 0, 0, "' . $rewrite . '", 0000-00-00, "' . $current_date . '", "' . $current_date . '", ' . $id_user . ')');

      $query->execute();


      return $query;
   }

   // Fonction de récupération d'un article/épisode via son ID
   function get_episode($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération de l'épisode
      $query = $db->prepare("SELECT E.*, S.name serie_name FROM episode E, serie S WHERE E.id = " . $id . " AND E.id_serie = S.id");

      $query->execute();

      $result = $query->fetch();

      return $result;
   }

   // Fonction de récupération des articles d'un utilisateur
   function get_user_proposals($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération des épisodes avec l'ID de l'auteur
      $query = $db->prepare("SELECT ME.*, SE.name AS serie, S.number AS season, E.name AS episode FROM moderation_episode ME, status_article SA, episode E, season S, serie SE WHERE ME.status = SA.id AND ME.id_episode = E.id AND E.id_season = S.id AND S.id_serie = SE.id AND ME.author = " . $id);

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   function get_proposals() {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération des données des épisode en attente de validation
      $query = $db->prepare('SELECT ME.*, SE.id AS id_serie, SE.name AS serie, S.number AS season, E.name AS episode FROM moderation_episode ME, status_article SA, episode E, season S, serie SE WHERE ME.status = SA.id AND ME.id_episode = E.id AND E.id_season = S.id AND S.id_serie = SE.id ORDER BY ME.date_publication');

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   // Fonction de récupération d'un article/épisode via son ID
   function get_proposal($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération de l'épisode
      $query = $db->prepare("SELECT ME.*, SE.name AS serie, S.number AS season, E.name AS episode FROM moderation_episode ME, status_article SA, episode E, season S, serie SE WHERE ME.status = SA.id AND ME.id_episode = E.id AND E.id_season = S.id AND S.id_serie = SE.id AND ME.id = " . $id);

      $query->execute();

      $result = $query->fetch();

      return $result;
   }

   // Fonction de modification d'un épisode
   function validate_proposal($id, $id_episode, $name, $summary, $release_date) {
      // Connection à la base de données
      $db = call_pdo();

      // On désactive l'ancien contenu de l'épisode
      $query = $db->prepare('UPDATE moderation_episode SET status = 2 WHERE id = ' . $id_episode . ' AND status = 4');

      $query->execute();

      // Mise à jour des champs par l'administrateur et changement du statut de l'article
      $query = $db->prepare('UPDATE moderation_episode SET name = "' . $name . '", summary = "' . $summary . '", release_date = "' . $release_date . '", status = 4 WHERE id = ' . $id);

      $query->execute();

      // Mise à jour des champs de l'épisode
      $query = $db->prepare('UPDATE episode SET name = "' . $name . '", summary = "' . $summary . '", release_date = "' . $release_date . '" WHERE id = ' . $id_episode);

      $query->execute();

      return $query;
   }

   // Fonction de modification d'un épisode
   function reject_proposal($id) {
      // Connection à la base de données
      $db = call_pdo();

      // Ajout des nouveaux champs de l'épisode
      $query = $db->prepare('UPDATE moderation_episode SET status = 5 WHERE id = ' . $id);

      $query->execute();

      return $query;
   }

   // Fonction de récupération des épisodes d'une saison
   function get_season_episodes($id_season = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération des épisodes
      $query = $db->prepare("SELECT DISTINCT * FROM episode WHERE id_season = " . $id_season);

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   // Fonction de suspension d'une série via son ID
   function suspend_episode($id) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("UPDATE episode SET status = 3 WHERE id = :id");

      $query->execute(array(':id' => $id));

      $query->closeCursor();
   }

   // Fonction de mise à jour d'un épisode
   function update_episode($id, $name, $number, $rewrite, $status, $short_description, $summary) {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération de la date actuelle
      $current_date = date('Y-m-d');

      // Ajout des nouveaux champs de l'épisode
      $query = $db->prepare('UPDATE episode SET name = "' . $name . '", number = ' . $number . ', description = "' . $short_description . '", status = ' . $status . ', summary = "' . $summary . '", rewrite = "' . $rewrite . '", last_modification = ' . $current_date . ' WHERE id = ' . $id);

      $query->execute();

      return $query;
   }

   // Fonction de mise à jour d'un épisode
   function update_user_episode($id, $name, $number, $rewrite, $status, $short_description, $summary) {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération de la date actuelle
      $current_date = date('Y-m-d');

      // Ajout des nouveaux champs de l'épisode
      $query = $db->prepare('UPDATE episode SET name = "' . $name . '", number = ' . $number . ', description = "' . $short_description . '", status = ' . $status . ', summary = "' . $summary . '", rewrite = "' . $rewrite . '", last_modification = ' . $current_date . ' WHERE id = ' . $id);

      $query->execute();

      return $query;
   }

   // Fonction de mise à jour d'un épisode
   function update_proposal($id, $release_date, $name, $summary) {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération de la date actuelle
      $current_date = date('Y-m-d');

      // Ajout des nouveaux champs de l'épisode
      $query = $db->prepare('UPDATE moderation_episode SET name = "' . $name . '", status = 0, summary = "' . $summary . '", release_date =  "' . $release_date . '", date_publication = "' . $current_date . '" WHERE id = ' . $id);

      $query->execute();

      return $query;
   }

   function get_awaiting_proposals() {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération des données des épisode en attente de validation
      $query = $db->prepare('SELECT ME.*, SE.id AS id_serie, SE.name AS serie, S.number AS season, E.name AS episode FROM moderation_episode ME, status_article SA, episode E, season S, serie SE WHERE ME.status = 0 AND ME.id_episode = E.id AND E.id_season = S.id AND S.id_serie = SE.id ORDER BY ME.date_publication');

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

?>
