<?php

   function addUser($gender, $name, $surname, $email, $username, $password, $birthdate) {

     // Connection à la base de données
     $db = call_pdo();

     // Ajout d'un avatar par défaut en fonction du genre de l'utilisateur
      if ($gender == 1) {
        $avatar = 'avatar/avatar_woman.png';
      } else {
        $avatar = 'avatar/avatar_man.png';
      }

     $query = $db->prepare("INSERT into user(gender, name, surname, avatar, email, username, password, birthdate)
                            VALUES(".$gender.", '".ucfirst($name)."', '".ucfirst($surname)."', '".$avatar."', '".$email."', '".$username."', '".md5($password)."', '".$birthdate."')");
     $query->execute();
   }

   // Requête pour vérifier que l'adresse mail d'un utilisateur n'existe pas déjà en base lors de son inscription
   function isEmailExists($email) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT email FROM user where email = '".$email."'");
      $query->execute();

      return $query;
   }

   // Requête pour vérifier que username d'un utilisateur n'existe pas déjà en base lors de son inscription
   function isUsernameExists($username) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT username FROM user where username = '".$username."'");
      $query->execute();

      return $query;
   }
// Requête pour vérifier que l'adresse mail d'un utilisateur n'existe pas déjà en base lors de son inscription
   function isEmailExistsWhenUpdate($id, $email) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT email FROM user where email = '".$email."' and id != " . $id);
      $query->execute();

      return $query;
   }

   // Requête pour récupérer tous les utilisateurs
   function selectAllUsers($db) {

     // Connection à la base de données
     $db = call_pdo();

     $query = $db->prepare("SELECT * FROM user ORDER BY id LIMIT 0,1");
     $query->execute();

     $date = array();

     while ($data = $query->fetch()) {
       echo $data['name'] . " " . $data['surname'] . " " . $data['birthdate'];
       $date = explode('-', $data["birthdate"]);
       $ddnExplode = $date["1"] . "/" . $date["2"] . "/" . $date["0"];
       echo "Age : " . age($ddnExplode);
       echo "<br/>";
     }

     $query->closeCursor();
   }

   // Requête pour récupérer les informations sur un utilisateur
   function selectInfosUser($id) {

     // Connection à la base de données
     $db = call_pdo();

     $query = $db->prepare("SELECT * FROM user
                                  WHERE id = '" . $id . "'
                                  ORDER BY id");
     $query->execute();

     return $query;
   }

   // Requête pour récupérer les séries suivies d'un utilisateur
   function seriesUser($id) {

     // Connection à la base de données
     $db = call_pdo();

     $query = $db->prepare("SELECT s.id as serie_id, s.name as serie_name, s.image as serie_image, u.id as user_id, t.id_serie, t.id_user
                                FROM serie s, serie_user t, user u
                                WHERE u.id = t.id_user AND t.id_serie = s.id
                                AND u.id = :id_user
                                LIMIT 0,10
                                ");
     $query->execute(array("id_user" => $id));
     $result = $query->fetchAll();

     return $result;
   }

   // Affiche dans le résultat de la recherche les séries que l'utilisateur recherche et qu'il ne suit pas déjà
   function searchSeries($name, $id) {

     // Connection à la base de données
     $db = call_pdo();

     $query = $db->prepare("SELECT * FROM serie s
                          WHERE s.name LIKE :name
                          AND s.id NOT IN ( SELECT id_serie
                                            FROM serie_user
                                            WHERE id_user = :id)
                          ");
     $query->execute(array("name" => $name . "%", "id" => $id));

     return $query;
   }

   // Ajoute un suivi de série pour l'utilisateur
   function addSerieToUser($serie_name, $id){

     // Connection à la base de données
     $db = call_pdo();

     $query = $db->prepare("SELECT id
                           FROM serie
                           WHERE name = :name
                          ");
     $query->execute(array("name" => $serie_name));
     $data = $query->fetch();
     $id_serie = $data['id'];
     if ($id_serie != NULL) {
       $query = $db->prepare("INSERT INTO serie_user (id_serie, id_user) VALUES(:id_serie, :id)
                            ");
       $query->execute(array(':id_serie' => $id_serie, 'id' => $id));
       $query->closeCursor();

     }
   }

   function deleteSerieFollow($id_user, $id_serie) {
     // Connection à la base de données
     $db = call_pdo();

     $query = $db->prepare("DELETE
                           FROM serie_user
                           WHERE id_user = :id_user
                           AND id_serie = :id_serie
                           ");
     $query->execute(array(':id_user' => $id_user, ':id_serie' => $id_serie));

     $query->closeCursor();
   }

   // Fonction de récupération des derniers articles d'un utilisateur
   function last_user_articles($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération des articles
      $query = $db->prepare("SELECT E.*, S.name AS serie_name FROM episode E, serie S GROUP BY id HAVING E.last_contributor = " . $id . " LIMIT 5");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   // Fonction de suppression d'un utilisateurs via son ID
   function suspend_user($id) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("UPDATE user SET status = 3 WHERE id = :id");

      $query->execute(array(':id' => $id));

      $query->closeCursor();
   }

   // Requête pour modifier les informations d'un utilisateur à partir de l'interface d'administration
   function admin_update_user($id, $name, $surname, $gender, $birthdate, $presentation, $username, $password, $email, $status) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare('UPDATE user SET name = "' . $name . '", surname = "' . $surname . '", gender = "' . $gender . '", birthdate = "' . $birthdate . '", presentation = "' . $presentation . '", username = "' . $username . '", password = "' . md5($password) . '", email = "' . $email . '", status = "' . $status . '" WHERE id = ' . $id);
      $query->execute();

      return $query;
   }

   // Requête pour modifier les informations d'un utilisateur
   function update_user($id, $gender, $name, $surname, $password, $email) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare('UPDATE user SET name = "' . $name . '", surname = "' . $surname . '", gender = "' . $gender . '", password = "' . md5($password) . '", email = "' . '" WHERE id = ' . $id);
      $query->execute();


   }

   // Fonction de récupération des utilisateurs du site
   function get_users() {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT SU.name FROM user U, status_user SU WHERE U.status = SU.id");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   // Fonction de récupération d'un utilisateur
   function get_user($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération de l'utilisateur via son ID
      $query = $db->prepare("SELECT U.*, SU.name AS status_name FROM user U, status_user SU WHERE U.id = " . $id . " AND U.status = SU.id GROUP BY U.id");

      $query->execute();

      $result = $query->fetch();

      return $result;
   }

   function check_user_admin($id_status) {
      $result = false;

      if($id_status == 2) {
         $result = true;
      }

      return $result;
   }

   function updateLastLogin($id) {
     $db = call_pdo();
     $currentDate = date("Y-m-d H:i:s");
     $query = $db->prepare("UPDATE user SET last_login = '".$currentDate."' WHERE id = ".$id);
     $query->execute();
   }

   function admin_add_user($presentation, $gender, $name, $surname, $email, $username, $password, $birthdate) {

      // Connection à la base de données
      $db = call_pdo();

      // Ajout d'un avatar par défaut en fonction du genre de l'utilisateur
      if ($gender == 1) {
         $avatar = 'avatar/avatar_woman.png';
      } else {
         $avatar = 'avatar/avatar_man.png';
      }

      $query = $db->prepare("INSERT into user(presentation, gender, name, surname, avatar, email, username, password, birthdate)
      VALUES('" . $presentation . "', " . $gender . ", '" . ucfirst($name) . "', '" . ucfirst($surname) . "', '" . $avatar . "', '" . $email . "', '" . $username . "', '" . md5($password) . "', '" . $birthdate . "')");
      $query->execute();

      return $query;
   }

?>
