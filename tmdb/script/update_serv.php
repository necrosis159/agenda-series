#!/usr/local/bin/php.ORIG.5_4
<?php

   /*
      Script de mise à jour des séries enregistrées dans la base de données d'Agenda-Serie - beta
      Ludovic COURTIAL - Agenda-Serie.fr

      Features:
      - Détection des séries ayant subie des modifications sur l'API
      - Détection des changements ne concernant que le langage 'fr'
      - Détection des statuts de modification et des champs concernés
      - Contournement d'erreur liées à l'API (champs vide, case de tableau supplémentaire etc..)
   */

   $path = dirname(dirname(__FILE__));
   define('ROOT',dirname($path));

   require ROOT.'/tmdb/tmdb-api.php';

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

   // Lancement du script
   $timestart = microtime(true);

   // Configuration des paramètres de l'API
   $apikey = "a91933d3f6ac9b2239697a64de547385";
   $tmdb = new TMDB($apikey, 'fr', false);

   // Connection à la base de données
   $db = call_pdo();

   // On récupère tous les ID des séries de la base de données
   $query = $db->prepare('SELECT DISTINCT serie_id FROM serie');
   $query->execute();
   $shows = $query->fetchAll();

   // On parcours chaque série de la base de données
   foreach($shows as $show) {

      // On récupère les modifications de l'API
      $changes = $tmdb->getChangedTVShow($show['serie_id']);

      // On vérifie que le tableau des changements de l'API existe (correction d'un bug API)
      if(isset($changes["changes"])) {
         // On vérifie que le tableau retourné n'est pas vide
         $empty = array_filter($changes["changes"]);
         $changes = $changes["changes"];
      }
      // S'il n'existe pas on retourne un tableau vide pour le test
      else {
         $empty = array();
      }

      if(!empty($empty)) {

         echo "<br>Nouveaux changements pour la serie : " . $show['serie_id'];

         // On test si la clée du changement concerne une saison
         for($i = 0; $i < count($changes); $i++) {

            if($changes[$i]['key'] == "season") {
               echo "<br>Changement dans la saison";

               for($j = 0; $j < count($changes[$i]['items']); $j++) {

                  // On récupère l'ID de la saison concernée
                  $idSeason = $changes[$i]['items'][$j]['value']['season_id'];

                  // On récupère les changements sur la saison
                  $season = $tmdb->getChangedSeason($idSeason);

                  // On vérifie que le tableau des changements de l'API existe (correction d'un bug API)
                  if(isset($season["changes"])) {
                     // On vérifie que le tableau retourné n'est pas vide
                     $empty = array_filter($season["changes"]);
                     $season = $season["changes"];
                  }
                  // S'il n'existe pas on retourne un tableau vide pour le test
                  else {
                     $empty = array();
                  }

                  if(!empty($empty)) {

                     for($s = 0; $s < count($season); $s++) {

                        // Changement des informartions de la saison
                        if(isset($season[$s]['items'][0]['iso_639_1']) && $season[$s]['items'][0]['iso_639_1'] == "fr") {

                           if($season[$s]['key'] == "name" || $season[$s]['key'] == "overview" || $season[$s]['key'] == "images") {

                              echo "<br>Modification du champ : " . $season[$s]['key'];

                              if(isset($season[0]['items'][0]['value'])) {
                                 $value = $season[0]['items'][0]['value'];
                              }
                              else {
                                 $value = $season[0]['items'][1]['value'];
                              }

                              $query = $db->prepare('UPDATE season SET season_date_update = "' . date('Y-m-d') . '", season_' . $season[$s]['key'] . ' = "' . $value . '" WHERE season_id = ' . $idSeason);
                              $query->execute();

                              echo "<br><u>Le champ '" . $season[$s]['key'] . "' a ete modifie avec succes! ID Saison : " . $idSeason . "</u><br>";
                           }
                           else {
                              echo "<br>Changement autre!";
                           }

                           if($season[$s]['key'] == "episode") {

                              for($e = 0; $e < count($season[$s]['items']); $e++) {

                                 // On récupère l'ID de l'épisode concerné
                                 $idEpisode = $season[$s]['items'][$e]['value']['episode_id'];

                                 // On récupère les changements sur l'épisode
                                 $episode = $tmdb->getChangedEpisode($idEpisode);

                                 // On vérifie que le tableau des changements de l'API existe (correction d'un bug API)
                                 if(isset($episode["changes"])) {
                                    // On vérifie que le tableau retourné n'est pas vide
                                    $empty = array_filter($episode["changes"]);
                                    $episode = $episode["changes"];
                                 }
                                 // S'il n'existe pas on retourne un tableau vide pour le test
                                 else {
                                    $empty = array();
                                 }

                                 if(!empty($empty)) {

                                             // echo "<pre>";
                                             //    // var_dump($changes[$i]['items'][0]['value']);
                                             //    die(var_dump($episode[$e]));
                                             // echo "</pre>";
                                    for($e = 0; $e < count($episode); $e++) {


                                          if($episode[$e]['key'] == "name" || $episode[$e]['key'] == "overview" || $episode[$e]['key'] == "notation") {
                                             echo "<br>Modification du champ : " . $episode[$e]['key'];


                                             if(isset($episode[$e]['items'][0]['value'])) {
                                                $value = $episode[$e]['items'][0]['value'];
                                             }
                                             else {
                                                $value = $episode[$e]['items'][1]['value'];
                                             }

                                             if($episode[$e]['items'][0]['action'] == "updated" || $episode[$e]['items'][0]['action'] == "added") {
                                                $query = $db->prepare('UPDATE episode SET episode_date_update = "' . date('Y-m-d') . '", episode_' . $episode[$e]['key'] . ' = "' . $value . '" WHERE episode_id = ' . $idEpisode);
                                                $query->execute();

                                                echo "<br><u>Le champ '" . $episode[$e]['key'] . "' a ete modifie avec succes! ID Episode : " . $idEpisode . "</u><br>";
                                             }
                                             else {
                                                $query = $db->prepare('UPDATE episode SET episode_' . $episode[$e]['key'] . ' = "" WHERE episode_id = ' . $idEpisode);
                                                $query->execute();

                                                echo "<br><u>Le champ '" . $episode[$e]['key'] . "' est maintenant vide! ID Episode : " . $idEpisode . "</u><br>";
                                             }
                                          }
                                          else {
                                             echo "<br><b>Erreur de l'API!</b>";
                                          }
                                    }
                                 }
                              }
                           }
                        }
                        else {
                           echo "<br>Changement dans une langue etrangere.";
                        }
                     }
                  }
                  else {
                     echo "<br><b>Erreur de l'API!</b>";
                  }
               }
            }
            // if($changes[$i]['key'] == "genres") {
            //    echo "<br>Modification du genre.";
            // }

            // Changement des informartions de la série
            if(isset($changes[$i]['items'][0]['iso_639_1']) && $changes[$i]['items'][0]['iso_639_1'] == "fr") {

               if($changes[$i]['key'] == "name" || $changes[$i]['key'] == "overview" || $changes[$i]['key'] == "images") {

                  echo "<br>Modification du champ : " . $changes[$i]['key'];

                  $query = $db->prepare('UPDATE serie SET serie_date_update = "' . date('Y-m-d') . '", serie_' . $changes[$i]['key'] . ' = "' . $changes[$i]['items'][0]['value'] . '" WHERE serie_id = ' . $show['id']);
                  $query->execute();

                  echo "<br><u>Le champ '" . $changes[$i]['key'] . "' a ete modifie avec succes! ID Serie : " . $show['serie_id'] . "</u><br>";
               }
               else {
                  echo "<br>Changement autre!";
               }
            }
            else {
               echo "<br>Changement dans une langue etrangere.";
            }
         }
      }
      else {
         echo "<br>Pas de changements pour la serie : " . $show['serie_id'];
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
