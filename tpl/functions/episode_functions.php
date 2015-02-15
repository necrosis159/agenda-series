<?php

// Fonction de création d'un épisode
function create_episode($serie, $season, $name, $number, $description, $status, $summary, $release_date, $duration, $id_user) {
   // Connection à la base de données
   $db = call_pdo();

   // Récupération de la date actuelle
   $current_date = date('Y-m-d');

   // Ajout des nouveaux champs de l'épisode
   $query = $db->prepare('INSERT INTO episode VALUES ("", ' . $serie . ', ' . $season . ', "' . $name . '", ' . $number . ', "' . $description . '", ' . $status . ', "' . $summary . '", 0, "' . $duration . '", "' . $rewrite . '", "' . $release_date . '", "' . $current_date . '", "' . $current_date . '", ' . $id_user . ')');

   $query->execute();

   return $query;
}

// Fonction de suppression d'un épisode
function delete_episode($id) {
   // Connection à la base de données
   $db = call_pdo();

   // Suppression de l'épisode
   $query = $db->prepare('DELETE FROM episode WHERE id = ' . $id);

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
   function user_episodes($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération des épisodes avec l'ID de l'auteur
      $query = $db->prepare("SELECT E.*, S.name serie_name FROM episode E, serie S WHERE E.last_contributor = " . $id . " AND E.id_serie = S.id");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   function get_proposals() {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération des données des épisode en attente de validation
      $query = $db->prepare('SELECT ME.*, SE.id AS id_serie, SE.name AS serie, S.number AS season, E.name AS episode FROM moderation_episode ME, status_article SA, episode E, season S, serie SE WHERE ME.status = SA.id AND ME.id_episode = E.id AND E.id_season = S.id AND S.id_serie = SE.id AND ME.status = 0 ORDER BY ME.date_publication');

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

?>
