<?php

   /*
      Script de mise à jour des séries enregistrées dans la base de données d'Agenda-Serie - beta unstable
      Ludovic COURTIAL - Agenda-Serie.fr

      Features:
      - Détection des séries ayant subie des modifications sur l'API
      - Détection des changements ne concernant que le langage 'fr'
      - Détection des statuts de modification et des champs concernés
      - Contournement d'erreur liées à l'API (champs vide, case de tableau supplémentaire etc..)
   */

   include('../tmdb-api.php');

   // Fonctions utilitaires

   // Fonction de connection PDO
   function call_pdo() {
     try {
       $db = new PDO('mysql:host=localhost;dbname=agenda;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
     } catch (Exception $e) {
       die('Erreur : ' . $e->getMessage());
     }

     return $db;
   }

   // Fonction de description courte
   // function truncate($str, $length = 300, $trailing = '...') {
   //    // take off chars for the trailing
   //    $length -= mb_strlen($trailing);
   //
   //    if(mb_strlen($str) == 0) {
   //       $result = "";
   //    }
   //    else if (mb_strlen($str) > $length)
   //    {
   //       // string exceeded length, truncate and add trailing dots
   //       return mb_substr($str, 0, $length) . $trailing;
   //    }
   //    else {
   //       // string was already short enough, return the string
   //       $result = $str;
   //    }
   //
   //    return $result;
   // }

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

      // echo "<pre>";
      //    var_dump($show);
      //    // die(var_dump($changes[$i]));
      // echo "</pre>";

      // On récupère les modifications de l'API
      $changes = $tmdb->getChangedTVShow($show['serie_id']);
      // $changes = $tmdb->getChangedTVShow(40075);

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
                        }
                        else {
                           echo "<br>Changement dans une langue etrangere.";
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

                                 if($episode[0]['key'] == "name" || $episode[0]['key'] == "overview" || $episode[0]['key'] == "notation") {
                                    echo "<br>Modification du champ : " . $episode[0]['key'];

                                    if(isset($episode[0]['items'][0]['value'])) {
                                       $value = $episode[0]['items'][0]['value'];
                                    }
                                    else {
                                       $value = $episode[0]['items'][1]['value'];
                                    }

                                    if($episode[0]['items'][0]['action'] == "updated" || $episode[0]['items'][0]['action'] == "added") {
                                       $query = $db->prepare('UPDATE episode SET episode_date_update = "' . date('Y-m-d') . '", episode_' . $episode[0]['key'] . ' = "' . $value . '" WHERE episode_id = ' . $idEpisode);
                                       $query->execute();

                                       echo "<br><u>Le champ '" . $episode[0]['key'] . "' a ete modifie avec succes! ID Episode : " . $idEpisode . "</u><br>";
                                    }
                                    else {
                                       $query = $db->prepare('UPDATE episode SET episode_' . $episode[0]['key'] . ' = "" WHERE episode_id = ' . $idEpisode);
                                       $query->execute();

                                       echo "<br><u>Le champ '" . $episode[0]['key'] . "' est maintenant vide! ID Episode : " . $idEpisode . "</u><br>";
                                    }
                                 }
                              }
                              else {
                                 echo "<br><b>Erreur de l'API!</b>";
                              }
                           }
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

                  // echo "<pre>";
                  //    var_dump($changes[$i]['items'][0]['value']);
                  //    die(var_dump($changes[$i]));
                  // echo "</pre>";

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
