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

         if($type == "serie") {
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
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date", $type . "_number"))
                           ->where($type . "_name", "LIKE", "")
                              ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                 ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");

               $result = $this->execute();
            }
            elseif($title == "" && $date != "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date", $type . "_number"))
                           ->where($prefix . "." . $type . "_air_date", "=", $date)
                              ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                 ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date", $type . "_number"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title)
                              ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                 ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_name", $type . "_air_date", $type . "_number"))
                           ->where($prefix . '.' . $type . '_name', "LIKE", $title)
                              ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                 ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");

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
                        ->from(array($prefix => $type), array($type . "_id", $type . "_title", $type . "_date_publication"))
                           ->where($type . "_title", "LIKE", "")
                              ->join(array("e" => "episode"), array("episode_number"), "c.comment_id_episode = e.episode_id")
                                 ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                    ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");

               $result = $this->execute();
            }
            elseif($title == "" && $date != "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_title", $type . "_date_publication"))
                           ->where($prefix . "." . $type . "_date_publication", "=", $date)
                              ->join(array("e" => "episode"), array("episode_number"), "c.comment_id_episode = e.episode_id")
                                 ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                    ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_title", $type . "_date_publication"))
                           ->where($prefix . '.' . $type . '_title', "LIKE", $title)
                              ->join(array("e" => "episode"), array("episode_number"), "c.comment_id_episode = e.episode_id")
                                 ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                    ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");

               $result = $this->execute();
            }
            elseif($title != "" && $date == "") {
               $this->selectDistinct()
                        ->from(array($prefix => $type), array($type . "_id", $type . "_title", $type . "_date_publication"))
                           ->where($prefix . '.' . $type . '_title', "LIKE", $title)
                              ->join(array("e" => "episode"), array("episode_number"), "c.comment_id_episode = e.episode_id")
                                 ->join(array("se" => "season"), array("season_number"), "e.episode_id_season = se.season_id")
                                    ->join(array("s" => "serie"), array("serie_name", "serie_id"), "se.season_id_serie = s.serie_id");

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

      public function _searchUser($id, $username) {

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

         return $result;
      }
  }
?>
