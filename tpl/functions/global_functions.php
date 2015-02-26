<?php

   // Fonction de connection PDO
   function call_pdo() {
     try {
       $db = new PDO('mysql:host=localhost;dbname=agendaserie;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
     } catch (Exception $e) {
       die('Erreur : ' . $e->getMessage());
     }

     return $db;
   }

   // Requête de connexion
   function login($username) {

     // Connection à la base de données
     $db = call_pdo();

     $query = $db->prepare("SELECT id, username, password, status FROM user WHERE username = :username");
     $query->execute(array("username" => $username));

     return $query;
   }

   // Fonction de calcul de l'âge, date en paramètre au format mm/dd/yyyy
   function age($date) {
     $dna = strtotime($date);
     $now = time();

     $age = date('Y', $now) - date('Y', $dna);
     if (strcmp(date('md', $dna), date('md', $now)) > 0)
       $age--;

     return $age;
   }

   // Fonction d'erreur
   function error($err = '') {
     $mess = ($err != '') ? $err : 'Une erreur inconnue s\'est produite';
     exit('<div id="error"><p>' . $mess . '</p>
         <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div>');
   }

   // Fonction pour convertir le format d'une date en français
   function date_convert($date_en) {

      $split = explode("-", $date_en);
      $year = $split[0];
      $month = $split[1];
      $day = $split[2];
      $date_fr = "$day"."/"."$month"."/"."$year";

      return $date_fr;
   }

   // Fonction de vérification
   function check_record($id, $table) {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT * FROM " . $table . " WHERE id = " . $id);

      $query->execute();

      $result = $query->fetch();

      if(!$result) {
         header('Location: index.php');
      }
   }

   // Fonction de vérification d'un administrateur
   function check_admin($status) {
      if($status != 3) {

         header('Location: index.php');
      }
   }

   // Fonction de vérification d'un administrateur
   function check_id() {
      // à faire
   }

   // Fonction de récupération du dossier courant
   function get_directory() {

      $cur_dir = explode('\\', getcwd());
      $dir_name = $cur_dir[count($cur_dir) - 1];

      return $dir_name;
   }

   // Fonction de récupération de la page courante
   function get_page() {

      $page_name = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

      return $page_name;
   }

   // Fonction retourne un message de validation
   function error_message($message = 'Une erreur est survenue!') {

      $result = '<p class="wrong">' . $message . '</p>';

      echo $result;
   }

   // Fonction retourne un message de validation
   function valid_message($message = '') {

      $result = '<p class="right">' . $message . '</p>';

      echo $result;
   }

   // Fonction pour compter le nombre de lignes dans une table pour un utilisateur donné
   function row_count_by_id_user($idUser, $table) {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT COUNT(*) FROM " . $table ." WHERE id_user = " . $idUser);

      $query->execute();

      $result = $query->fetch();

      return $result;
   }
   
?>
