<?php

   // Fonction de récupération de la liste des séries
   function get_series() {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT * FROM serie ORDER BY status");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   // Fonction de récupération des saisons de la série concernée
   function get_series_seasons($id_serie) {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT S.*, SE.name AS serie FROM season S, serie SE WHERE S.id_serie = " . $id_serie . " AND SE.id = " . $id_serie . " ORDER BY S.number");

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

   // Fonction de création d'une fiche de série
   function create_serie($name, $short_description, $description, $nationality, $channel, $year_start, $year_end, $image, $video, $rewrite, $category, $status, $meta_keywords, $id_user, $highlight) {

      // Connection à la base de données
      $db = call_pdo();

      // Récupération de la date actuelle
      $current_date = date('Y-m-d');

      $query = $db->prepare('INSERT INTO serie VALUES("", "' . ucfirst($name) . '", "' . $short_description . '", "' . $description . '", "' . $nationality . '", "' . $channel . '", "' . $year_start . '", "' . $year_end . '", "' . $image . '", "' . $video . '", 0, "' . $rewrite . '", ' . $category . ', ' . $status . ', "' . $meta_keywords . '", ' . $id_user . ', 0000-00-00, ' . $current_date . ', ' . $highlight . ')');

      $result = $query->execute();

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

   // Fonction de récupération d'une série en fonction de son ID
   function get_serie($id) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT * FROM serie WHERE id = " . $id);

      $query->execute();

      $result = $query->fetch();

      return $result;
   }

   // Fonction de mise à jour d'une série
   function update_serie($id_serie, $name, $short_description, $description, $nationality, $channel, $year_start, $year_end, $image, $video, $rewrite, $category, $status, $meta_keywords, $id_user, $highlight) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare('UPDATE serie SET name = "' . ucfirst($name) . '", short_description = "' . $short_description . '", description = "' . $description . '", nationality = "' . $nationality . '", channel = "' . $channel . '", year_start = "' . $year_start . '", year_end = "' . $year_end . '", image = "' . $image . '", video = "' . $video . '", rewrite = "' . $rewrite . '", id_category = ' . $category . ', meta_keywords = "' . $meta_keywords . '", author = ' . $id_user . ', status = ' . $status . ', release_date = "' . $year_start . '", highlighting = ' . $highlight . ' WHERE id = ' . $id_serie);

      $result = $query->execute();

      return $result;
   }

   // Fonction de suspension d'une série via son ID
   function suspend_serie($id) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("UPDATE serie SET status = 3 WHERE id = :id");

      $query->execute(array(':id' => $id));

      $query->closeCursor();
   }

   // Fonction de création d'une nouvelle saison d'une série
   function create_season($id_serie, $number, $name, $description, $status, $year_start, $year_end, $rewrite) {

      // Connection à la base de données
      $db = call_pdo();

      // Récupération de la date actuelle
      $current_date = date('Y-m-d');

      $query = $db->prepare('INSERT INTO season VALUES("", ' . $id_serie . ', ' . $number . ', "' . ucfirst($name) . '", "' . ucfirst($description) . '", ' . $status . ', 0, "' . $year_start . '", "' . $year_end . '", ' . $current_date . ', "' . $rewrite . '")');

      $result = $query->execute();

      return $result;
   }

   // Fonction de mise à jour d'une saison
   function update_season($id, $number, $name, $description, $status, $year_start, $year_end, $rewrite) {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare('UPDATE season SET number = ' . $number . ', name = "' . $name . '", description = "' . $description . '", status = ' . $status . ', year_start = "' . $year_start . '", year_end = "' . $year_end . '", rewrite = "' . $rewrite . '" WHERE id = ' . $id);
      // die(var_dump($query));

      $result = $query->execute();

      return $result;
   }

   // Fonction de suspension d'une saison via son ID
   function suspend_season($id) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("UPDATE season SET status = 3 WHERE id = :id");

      $query->execute(array(':id' => $id));

      $query->closeCursor();
   }

   // Fonction de récupération d'une série en fonction de son ID
   function get_season($id) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT S.*, SE.id AS id_serie, SE.name AS serie FROM season S, serie SE WHERE S.id = $id AND S.id_serie = SE.id");

      $query->execute();

      $result = $query->fetch();

      return $result;
   }

?>
