<?php

   // Fonction de connection PDO
   function call_pdo() {
     try {
       $db = new PDO('mysql:host=agendaseltserie.mysql.db;dbname=agendaseltserie;charset=utf8', 'agendaseltserie', 'yUzuP2ebraha', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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

      return $result;
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

      $cur_dir = explode('/', getcwd());
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

      $result = '<p class="wrong"><img class="message_icons" src="/images/error.png" title="Echec" alt="Echec" align="middle"> &nbsp; ' . $message . '</p>';

      echo $result;
   }

   // Fonction retourne un message de validation
   function valid_message($message = '') {

      $result = '<p class="right"><img class="message_icons" src="/images/valid.png" title="Réussi" alt="Réussi" align="middle"> &nbsp; ' . $message . '</p>';

      echo $result;
   }

   // Fonction de calcul de la pagination
   function pagination($rows, $table, $current_page) {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare('SELECT COUNT(*) AS total FROM ' . $table); // Nous récupérons le contenu de la requête.
      $query->execute(array('total'));

      $result = $query->fetch(PDO::FETCH_ASSOC); // On range le retour sous la forme d'un tableau.

      $total = $result['total']; // On récupère le total pour le placer dans la variable $total.

      // Nous allons maintenant compter le nombre de pages.
      $pages_number = ceil($total / $rows);

      return $pages_number;
   }

   // Fonction de récupération des données de la pagination
   function pagination_data($rows, $current_page, $pages_number, $table, $status_table = '') {

      if($current_page > $pages_number) // Si la valeur de $current_page (le numéro de la page) est plus grande que $pages_number.
      {
         $current_page = $pages_number;
      }

      $first_entries = ($current_page - 1) * $rows; // On calcul la première entrée à lire

      // Connection à la base de données
      $db = call_pdo();

      // Découpage de la requête avec test de l'existance d'un statut
      $query = 'SELECT T.*';

      // Test du statut pour le SELECT
      if($status_table != "") {
         $query .= ', OT.name AS status_name';
      }
      $query .= ' FROM ' . $table . ' T';

      // Test du statut pour le FROM et condition dans le WHERE
      if($status_table != "") {
         $query .= ', ' . $status_table . ' OT WHERE T.status = OT.id';
      }
      $query .= ' ORDER BY T.id LIMIT ' . $first_entries . ', ' . $rows;

      $query = $db->prepare($query);

      $query->execute();

      $data = $query->fetchAll();

      return $data;
   }

   // Fonction pour compter le nombre de lignes dans une table
   function row_count($table) {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT COUNT(id) FROM " . $table);

      $query->execute();

      $result = $query->fetch();

      return $result;
   }

   // Fonction de vérification de nouveau contenu dans une table
   function new_content($table) {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT COUNT(id) FROM " . $table . " WHERE status = 0");

      $query->execute();

      $result = $query->fetch();

      return $result;
   }

?>