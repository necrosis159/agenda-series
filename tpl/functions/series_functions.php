<?php

   // Fonction de récupération de la liste des séries
   function get_series() {
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

   // Fonction de récupération de la liste des séries
   function get_categories() {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT * FROM category");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   function create_serie($name, $short_description, $description, $nationality, $channel, $year_start, $year_end, $image, $video, $rewrite, $category, $statut, $meta_keywords, $id_user, $highlight) {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare('INSERT into serie VALUES("", "' . ucfirst($name) . '", "' . $short_description . '", "' . $description . '", "' . $nationality . '", "' . $channel . '", "' . $year_start . '", "' . $year_end . '", 0, 0, "' . $image . '", "' . $video . '", "' . $rewrite . '", ' . $category . ', 1, "' . $meta_keywords . '", ' . $id_user . ', 0000-00-00, ' . $highlight . ')');

      $query->execute();

      return $result;
   }

   // Fonction de récupération de la liste des status
   function get_status() {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT * FROM status_article");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

?>
