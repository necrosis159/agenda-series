<?php

   // Fonction de création d'un épisode
   function create_episode($id_user, $serie, $name, $season, $episode, $description, $resume, $release_date, $duration) {
      // Connection à la base de données
      $db = call_pdo();

      // Ajout des nouveaux champs de l'épisode
      $query = $db->prepare('INSERT INTO episode VALUES ("" , "' . $name . '", "' . $season . '", "' . $serie . '", "' . $description . '", "' . $resume . '", "' . $release_date . '", "' . $duration . '", "' . $id_user . '", "' . $episode . '")');

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

   // Fonction de modification d'un épisode
   function update_episode($id, $name, $resume, $number) {
      // Connection à la base de données
      $db = call_pdo();

      // Ajout des nouveaux champs de l'épisode
      $query = $db->prepare('UPDATE episode SET name = "' . $name . '", resume = "' . $resume . '", number = "' . $number . '" WHERE id = ' . $id);

      // die(var_dump($query));

      $query->execute();

      return $query;
   }

   // Fonction de récupération de la liste des séries
   function series_list() {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT * FROM serie");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   // Fonction de récupération des saisons de la série concernée
   function seasons_list($id_serie) {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT * FROM season WHERE id_serie = " . $id_serie . "");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

?>
