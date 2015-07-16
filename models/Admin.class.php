<?php

   class Admin extends baseModels {

      /********************* Déclarations ********************/
      private $var = 0;

      /********************* Fonctions **********************/

      public function __construct() {
          parent::__construct();
      }

      public function _searchContent($type, $title, $date) {
         // var_dump($title);

         $prefix = strtolower(substr($type, 0, 1));

<<<<<<< HEAD
         if($type == "serie") {
=======
         if($type == "default") {
            if($title == "" && $date == "") {
               $this->selectDistinct()
                        ->from(array("s" => "serie"), array("serie_id", "serie_name", "serie_first_air_date"))
                           ->from(array("e" => "episode"), array("episode_id", "episode_name", "episode_air_date"));
                           // ->where('s.serie_name', "LIKE", $title);
                           //    ->addWhere("OR", "s.first_air_date", "=", $date)
                           //       ->addWhere("OR", "c.comment_date_publication", "=", $date)
                                    // ->addWhere("AND", "s.serie_title", "LIKE", $title)
                                       // ->join(array("s" => "serie"), array(), "")
                                       //    ->join(array("c" => "comment"), array(), "");

               $result = $this->execute();
            }
            elseif($title != "") {
               $this->selectDistinct()
                  ->from(array("s" => "serie"), array("serie_id", "serie_name", "serie_first_air_date"))
                     ->where('s.serie_name', "LIKE", $title);
                           //    ->addWhere("OR", "s.first_air_date", "=", $date)
                           //       ->addWhere("OR", "c.comment_date_publication", "=", $date)
                                    // ->addWhere("AND", "s.serie_title", "LIKE", $title)
                                       // ->join(array("s" => "serie"), array(), "")
                                       //    ->join(array("c" => "comment"), array(), "");

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_first_air_date"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title);
                           //    ->addWhere("OR", "s.first_air_date", "=", $date)
                           //       ->addWhere("OR", "c.comment_date_publication", "=", $date)
                                    // ->addWhere("AND", "s.serie_title", "LIKE", $title)
                                       // ->join(array("s" => "serie"), array(), "")
                                       //    ->join(array("c" => "comment"), array(), "");

               $result = $this->execute();
            }
            else {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_first_air_date"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title)
                              ->addWhere("AND", "s.first_air_date", "=", $date)
                                 ->addWhere("AND", "e.air_date", "=", $date)
                                    ->addWhere("AND", "c.date_publication", "=", $date);
                           //       ->addWhere("OR", "c.comment_date_publication", "=", $date)
                                    // ->addWhere("AND", "s.serie_title", "LIKE", $title)
                                       // ->join(array("s" => "serie"), array(), "")
                                       //    ->join(array("c" => "comment"), array(), "");

               $result = $this->execute();
            }
            // elseif($date != "") {
            //    $prefix = strtolower(substr($type, 0, 1));
            //    $this->selectDistinct()
            //             ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_first_air_date"))
            //                ->where($prefix . '.serie_name', "LIKE", $title);
            //                //    ->addWhere("OR", "s.first_air_date", "=", $date)
            //                //       ->addWhere("OR", "c.comment_date_publication", "=", $date)
            //                         // ->addWhere("AND", "s.serie_title", "LIKE", $title)
            //                            // ->join(array("s" => "serie"), array(), "")
            //                            //    ->join(array("c" => "comment"), array(), "");
            //
            //    $result = $this->execute();
            // }
         }
         elseif($type == "serie") {
>>>>>>> origin/release
            if($title == "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_first_air_date"));

               $result = $this->execute();
            }
            elseif($title == "" && $date != "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_first_air_date"))
                           ->where($prefix . "." . $type . "_first_air_date", "=", $date);

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_first_air_date"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title);

               $result = $this->execute();
            }
            else {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_first_air_date"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title)
                              ->addWhere("AND", $prefix . "." . $type . "_first_air_date", "=", $date);

               $result = $this->execute();
            }
         }
         elseif($type == "episode") {
            if($title == "" && $date == "") {
               $this->selectDistinct()
<<<<<<< HEAD
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date", $type . "_number"))
                           ->where($type . "_name", "LIKE", "")
                              ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                 ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");
=======
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date"));
>>>>>>> origin/release

               $result = $this->execute();
            }
            elseif($title == "" && $date != "") {
               $this->selectDistinct()
<<<<<<< HEAD
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date", $type . "_number"))
                           ->where($prefix . "." . $type . "_air_date", "=", $date)
                              ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                 ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");
=======
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date"))
                           ->where($prefix . "." . $type . "_air_date", "=", $date);
>>>>>>> origin/release

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
<<<<<<< HEAD
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date", $type . "_number"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title)
                              ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                 ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");
=======
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title);
>>>>>>> origin/release

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
<<<<<<< HEAD
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date", $type . "_number"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title)
                              ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                 ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");
=======
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title);
>>>>>>> origin/release

               $result = $this->execute();
            }
         }
         elseif($type == "user") {
            if($title == "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_creation_date"));

               $result = $this->execute();
            }
            elseif($title == "" && $date != "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_creation_date"))
                           ->where($prefix . "." . $type . "_creation_date", "=", $date);

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_creation_date"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title);

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_creation_date"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title);

               $result = $this->execute();
            }
            else {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_creation_date"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title)
                              ->addWhere("AND", $prefix . "." . $type . "_creation_date", "=", $date);

               $result = $this->execute();
            }
         }
         elseif($type == "comment") {
            if($title == "" && $date == "") {
               $this->selectDistinct()
<<<<<<< HEAD
                        ->from(array($prefix => $type), array($type . "_id", $type . "_title", $type . "_date_publication"))
                           ->where($type . "_title", "LIKE", "")
                              ->join(array("e" => "episode"), array("episode_number"), "c.comment_id_episode = e.episode_id")
                                 ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                    ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");
=======
                        ->from(array($prefix => $type), array($type . "_id", $type . "_title", $type . "_date_publication"));
>>>>>>> origin/release

               $result = $this->execute();
            }
            elseif($title == "" && $date != "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_title", $type . "_date_publication"))
<<<<<<< HEAD
                           ->where($prefix . "." . $type . "_date_publication", "=", $date)
                              ->join(array("e" => "episode"), array("episode_number"), "c.comment_id_episode = e.episode_id")
                                 ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                    ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");
=======
                           ->where($prefix . "." . $type . "_date_publication", "=", $date);
>>>>>>> origin/release

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_title", $type . "_date_publication"))
<<<<<<< HEAD
                           ->where($prefix . '.' . $type . '_title', "LIKE", $title)
                              ->join(array("e" => "episode"), array("episode_number"), "c.comment_id_episode = e.episode_id")
                                 ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                    ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");
=======
                           ->where($prefix . '.' . $type . '_title', "LIKE", $title);
>>>>>>> origin/release

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_title", $type . "_date_publication"))
<<<<<<< HEAD
                           ->where($prefix . '.' . $type . '_title', "LIKE", $title)
                              ->join(array("e" => "episode"), array("episode_number"), "c.comment_id_episode = e.episode_id")
                                 ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                    ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");
=======
                           ->where($prefix . '.' . $type . '_title', "LIKE", $title);
>>>>>>> origin/release

               $result = $this->execute();
            }
            else {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_title", $type . "_date_publication"))
                           ->where($prefix . '.' . $type . '_title', "LIKE", $title)
                              ->addWhere("AND", $prefix . "." . $type . "_date_publication", "=", $date);

               $result = $this->execute();
            }
         }

         // die(var_dump($result));

         return $result;
      }

<<<<<<< HEAD
      public function _searchUser($id, $username) {
=======
      // // Fonction de calcul de la pagination
      // function pagination($rows, $table, $current_page) {
      //
      //   $this->selectDistinct()
      //            ->from(array(substr($table, 1) => $table), array("*"));
      //   ->prepare('SELECT COUNT(*) AS total FROM ' . $table); // Nous récupérons le contenu de la requête.
      //   $this->execute();
      //
      //   $result = $this->fetch(PDO::FETCH_ASSOC); // On range le retour sous la forme d'un tableau.
      //   $total = $result['total']; // On récupère le total pour le placer dans la variable $total.
      //
      //   // Nous allons maintenant compter le nombre de pages.
      //   $pages_number = ceil($total / $rows);
      //
      //   return $pages_number;
      // }
      //
      // // Fonction de récupération des données de la pagination
      // function pagination_data($rows, $current_page, $pages_number, $table, $status_table = '') {
      //   if($current_page > $pages_number) // Si la valeur de $current_page (le numéro de la page) est plus grande que $pages_number.
      //   {
      //      $current_page = $pages_number;
      //   }
      //   $first_entries = ($current_page - 1) * $rows; // On calcul la première entrée à lire
      //   // Connection à la base de données
      //   $db = call_pdo();
      //   // Découpage de la requête avec test de l'existance d'un statut
      //   $query = 'SELECT T.*';
      //   // Test du statut pour le SELECT
      //   if($status_table != "") {
      //      $query .= ', OT.name AS status_name';
      //   }
      //   $query .= ' FROM ' . $table . ' T';
      //   // Test du statut pour le FROM et condition dans le WHERE
      //   if($status_table != "") {
      //      $query .= ', ' . $status_table . ' OT WHERE T.status = OT.id';
      //   }
      //   $query .= ' ORDER BY T.id LIMIT ' . $first_entries . ', ' . $rows;
      //   $query = $db->prepare($query);
      //   $query->execute();
      //   $data = $query->fetchAll();
      //   return $data;
      // }
      //
      // // Fonction pour compter le nombre de lignes dans une table
      // function row_count($table) {
      //   // Connection à la base de données
      //   $db = call_pdo();
      //   $query = $db->prepare("SELECT COUNT(id) FROM " . $table);
      //   $query->execute();
      //   $result = $query->fetch();
      //   return $result;
      // }
   public function _searchUser($id, $username) {
>>>>>>> origin/release

            if($id == "" && $username == "") {
               $this->selectDistinct()
                        ->from(array('user'), array("user_id", "user_username"));

               $result = $this->execute();
            }
            elseif($id == "" && $username != "") {
               $this->selectDistinct()
                        ->from(array('user'), array("user_id", "user_username"))
                           ->where("user_username", "LIKE", $username);

               $result = $this->execute();
            }
            elseif($id != "" && $username == "") {
               $this->selectDistinct()
                        ->from(array('user'), array("user_id", "user_username"))
                           ->where('user_id', "=", $id);

               $result = $this->execute();
            }
            else {
               $this->selectDistinct()
                        ->from(array('user'), array("user_id", "user_username"))
                           ->where('user_id', "=", $id)
                              ->addWhere("AND",'user_username', "LIKE", $username);

               $result = $this->execute();
            }
<<<<<<< HEAD

=======
            
>>>>>>> origin/release
         return $result;
      }
  }
?>
