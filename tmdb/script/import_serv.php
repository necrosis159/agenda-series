<?php

   /*
      Script d'import des séries populaires depuis l'API TMDB - v 1.0 stable
      Ludovic COURTIAL - Agenda-Serie.fr

      Features:
      - Import des séries
      - Import de chaque saison d'une série
      - Import de tous les épisodes d'une saison
      - Import des genres de chaque série et création des associations
      - Fonction de raccourcissement de la description de la série (N'est plus utilisée)
      - Fonction de parcours d'un tableau multi-dimensions
      - Détection des séries déjà présente en base de données
      - Détection des genres et des liaisons avec les séries déjà présentes en BDD
   */

   include('../tmdb-api.php');

   // Fonctions utilitaires

   // Fonction de connection PDO
   function call_pdo() {
     try {
        $db = new PDO('mysql:host=agendaseltserie.mysql.db;dbname=agendaseltserie;charset=utf8', 'agendaseltserie', 'yUzuP2ebraha', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
     } catch (Exception $e) {
       die('Erreur : ' . $e->getMessage());
     }

     return $db;
   }

   // Fonction in_array pour tableaux mutlidimentionnels
   function in_array_r($needle, $haystack, $strict = false) {
      foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
      }

      return false;
   }

   // Fonction de récupération du contenu de l'API directement via l'URL
   function url_get_contents($Url) {

      if (!function_exists('curl_init')) {
         die('CURL is not installed!');
      }

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $Url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $output = curl_exec($ch);
      curl_close($ch);

      return $output;
   }

   // Lancement du script
   $timestart = microtime(true);

   // Configuration des paramètres de l'API
   $apikey = "a91933d3f6ac9b2239697a64de547385";
   $tmdb = new TMDB($apikey, 'fr', false);

   // $shows = $tmdb->getTopRatedTVShow();

   // Création d'un tableau avec l'ID des séries que l'on souhaite récupérer
   $tabShows = array(1399, 1396, 40008, 1418, 37680, 61664, 41727, 47665, 1402, 1405, 44217, 61889, 60708, 60699, 62560, 48866);
   $shows = array();

   // On transforme chaque élément du tableau en objet TVShow et on l'ajoute dans un tableau
   foreach($tabShows as $tab) {
      array_push($shows, $tmdb->getTVShow($tab));
   }

   // Connection à la base de données
   $db = call_pdo();

   // Import des séries
   foreach($shows as $show) {

      $tvShow = $tmdb->getTVShow($show->getID());


      // On récupère tous les ID des séries de la base de données
      $query = $db->prepare('SELECT DISTINCT serie_id FROM serie');
      $query->execute();
      $dbShows = $query->fetchAll();

      // Si l'ID de la série n'existe pas déjà en base on passe à l'import
      if(!in_array_r($show->getID(), $dbShows)) {

         // On récupère les saisons de la série
         $seasons = $tvShow->getSeasons();

         // Test pour savoir si la série est en production ou non
         if($tvShow->getInProduction()) {
            // Vrai elle est en production
            $inProduction = 1;
         }
         else {
            // Faux elle n'est plus en production
            $inProduction = 0;
         }

         // Test pour savoir s'il existe une image
         if($tvShow->getPoster() != "") {
            // Si oui on créer le chemin complet de l'image avec le préfixe de l'API et le champ récupéré
            $imageTVShow = "http://image.tmdb.org/t/p/w500" . $tvShow->getPoster();
         }
         else {
            // Sinon on envoi un champ vide
            $imageTVShow = "";
         }

         // Ajout de la série en BDD
         $query = $db->prepare('INSERT INTO serie VALUES (' . $tvShow->getID() . ',
         "' . $tvShow->getName() . '",
          "' . addslashes($tvShow->getOverview()) . '",
           "' . $tvShow->getOriginalCountry() . '",
            "' . $tvShow->getFirstAirDate() . '",
             "' . $imageTVShow . '",
               "' . $tvShow->getVoteAverage() . '",
                 ' . $inProduction . ',
                   "",
                     "0000-00-00")');
         $query->execute();

         foreach($seasons as $season) {

            $tvSeason = $tmdb->getSeason($tvShow->getID(), $season->getSeasonNumber());

            // Dans l'API il existe dans "Special seasons" avec l'ID 0 qui ne servent à rien
            // à part fausser le nombre de saisons et d'épisodes d'un série, donc on ne les récupère pas
            if($tvSeason->getSeasonNumber() != 0) {

               $episodes = $tvSeason->getEpisodes();

               // Test pour savoir s'il existe une image
               if($tvSeason->getPoster() != "") {
                  $imageSeason = "http://image.tmdb.org/t/p/w500" . $tvSeason->getPoster();
               }
               else {
                  $imageSeason = "";
               }

               // Ajout des saisons de la série en BDD
               $query = $db->prepare('INSERT INTO season VALUES (' . $tvSeason->getID() . ',
               ' . $tvSeason->getTVShowID() . ',
                ' . $tvSeason->getSeasonNumber() . ',
                 ' . $tvSeason->getNumEpisodes() . ',
                  "' . $tvSeason->getName() . '",
                   "' . addslashes($tvSeason->getOverview()) . '",
                    "' . $imageSeason . '",
                      "' . $tvSeason->getAirDate() . '",
                       "0000-00-00")');

               $query->execute();

               foreach ($episodes as $episode) {
                  $tvEpisode = $tmdb->getEpisode($tvShow->getID(), $tvSeason->getSeasonNumber(), $episode->getEpisodeNumber());

                  // echo "<pre>";
                  //    // die(var_dump($shows));
                  //    var_dump($tvEpisode);
                  // echo "</pre>";

                  // Ajout des épisodes de la série en BDD
                  $query = $db->prepare('INSERT INTO episode VALUES (' . $tvEpisode->getID() . ',
                  ' . $tvEpisode->getTVShowID() . ',
                   ' . $tvSeason->getID() . ',
                   "' . $tvEpisode->getName() . '",
                     ' . $tvEpisode->getEpisodeNumber() . ',
                      "' . addslashes($tvEpisode->getOverview()) . '",
                        ' . $tvEpisode->getVoteAverage() . ',
                         "' . $tvEpisode->getAirDate() . '",
                           "0000-00-00")');

                  $query->execute();
               }
            }
         }

         // Import des genres des séries

         // On récupère tous les ID des séries de la base de données
         $query = $db->prepare('SELECT DISTINCT genre_id FROM genre');
         $query->execute();
         $dbGenres = $query->fetchAll();

         // On récupère les genres de la série
         $genresTVShow = $show->getGenres();

         // On vérifie que le tableau retourné n'est pas vide
         $empty = array_filter($genresTVShow);

         if(!empty($empty)) {
            for($i = 0; $i < count($genresTVShow); $i++) {

               // Si l'ID n'existe pas en BDD, on ajoute
               if(!in_array_r($genresTVShow[$i]['id'], $dbGenres)) {
                  $query = $db->prepare('INSERT INTO genre VALUES (' . $genresTVShow[$i]['id'] . ', "' . $genresTVShow[$i]['name'] . '")');
                  $query->execute();
               }
               else {
                  echo "<br>Le genre existe déjà dans la BDD!";
               }

               // On récupère toutes
               $query = $db->prepare('SELECT DISTINCT * FROM genre_serie WHERE gs_id_serie = ' . $show->getID() . ' AND gs_id_genre = ' . $genresTVShow[$i]['id']);
               $query->execute();
               $dbTest = $query->fetchAll();

               // Si le résultat est vide = cette liaison n'est pas présente en BDD donc on ajoute
               if(empty($dbTest)) {
                  $query = $db->prepare('INSERT INTO genre_serie VALUES (' . $genresTVShow[$i]['id'] . ', ' . $show->getID() . ')');
                  $query->execute();
               }
            }
         }
      }
      else {
         echo "<br>Existe deja dans la base de donnees!";
      }
   }

   // Fin du script
   $timeend = microtime(true);
   $time = $timeend - $timestart;
   $page_load_time = number_format($time, 3);

   // Affichage des statistiques
   echo "<br><br><b>Debut du script: " . date("H:i:s", $timestart);
   echo "<br>Fin du script: " . date("H:i:s", $timeend);
   echo "<br>Script execute en " . $page_load_time . " sec";

   echo "<br><br>- Fin du script -</b>";

?>
