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
   
   // Fonction de récupération des séries via l'entrée de la recherche globale
   function gs_get_series($search) {
     $db = call_pdo();
     
     $query = $db->prepare("SELECT id, name, short_description, description, image, notation FROM serie WHERE name LIKE :name LIMIT 0,5");
     $query->execute(array("name" => "%".$search . "%"));
     
     $result = $query->fetchAll();
     
     return $result;
   }
   
   // Fonction de récupération du nombre d'utilisateurs qui suivent une série
   function getNbFollowersSeries($idSerie) {
     $db = call_pdo();
     
     $query = $db->prepare("SELECT COUNT(*) FROM serie_user WHERE id_serie = :idSerie");
     $query->execute(array("idSerie" => $idSerie));
     
     $result = $query->fetch();
     
     return $result;
   }

?>
