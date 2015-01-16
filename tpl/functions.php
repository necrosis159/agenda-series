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
function login($pseudo) {

  // Connection à la base de données
  $db = call_pdo();

  $query = $db->prepare("SELECT id, pseudo, password, status FROM user WHERE pseudo = :pseudo");
  $query->execute(array("pseudo" => $pseudo));

  return $query;
}

// Requête pour vérifier que l'adresse mail d'un utilisateur n'existe pas déjà en base lors de son inscription
function isEmailExists($email) {
  
  // Connection à la base de données
  $db = call_pdo();
  
  $query = $db->prepare("SELECT email FROM user where email = '".$email."'");
  $query->execute();
  
  return $query;
}

// Requête pour vérifier que pseudo d'un utilisateur n'existe pas déjà en base lors de son inscription
function isPseudoExists($pseudo) {
  
  // Connection à la base de données
  $db = call_pdo();
  
  $query = $db->prepare("SELECT pseudo FROM user where pseudo = '".$pseudo."'");
  $query->execute();
  
  return $query;
}

function addUser($gender, $name, $surname, $email, $pseudo, $password, $birthdate) {
  
  // Connection à la base de données
  $db = call_pdo();
  
  $query = $db->prepare("INSERT into user(gender, name, surname, email, pseudo, password, birthdate)
                         VALUES(".$gender.", '".ucfirst($name)."', '".ucfirst($surname)."', '".$email."', '".$pseudo."', '".md5($password)."', '".$birthdate."')");
  $query->execute();
  
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
function selectInfosUser() {

  // Connection à la base de données
  $db = call_pdo();

  $query = $db->prepare("SELECT * FROM user
                               WHERE id = '" . $_SESSION['id'] . "'
                               ORDER BY id");
  $query->execute();

  return $query;
}

// Requête pour récupérer les séries suivies d'un utilisateur
function seriesUser() {

  // Connection à la base de données
  $db = call_pdo();

  $query = $db->prepare("SELECT * FROM serie s, serie_user t, user u
                             WHERE u.id = t.id_user AND t.id_serie = s.id
                             AND u.id = :id
                             LIMIT 0,5
                             ");
  $query->execute(array("id" => $_SESSION['id']));

  return $query;
}

function searchSeries($name) {

  // Connection à la base de données
  $db = call_pdo();

  $query = $db->prepare("SELECT * FROM serie s
                       WHERE s.name LIKE :name
                       ");
  $query->execute(array("name" => "%" . $name . "%"));
  
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

// Fonction de récupération d'un commentaire via son ID
   function get_comment($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération du commentaire
      $query = $db->prepare("SELECT * FROM comment WHERE id_user = " . $id);

      $query->execute();

      $result = $query->fetch();

      return $result;
   }
   
// Fonction de récupération des derniers commentaires d'un utilisateur
function last_user_comments($id = '') {
  // Connection à la base de données
  $db = call_pdo();

  // Récupération des commentaires
      $query = $db->prepare("SELECT * FROM comment WHERE id_user = " . $id);

      $query->execute();

      $result = $query->fetchAll();

      return $result;
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

   // Fonction de vérification d'un utilisateur
   function check_user() {

   }

   // Fonction de récupération du dossier courant
   function get_directory() {

      $cur_dir = explode('\\', getcwd());
      $dir_name = $cur_dir[count($cur_dir) - 1];

      return $dir_name;
   }

   // Fonction de récupération de la page courante
   function get_page() {

      $cur_dir = explode('\\', getcwd());
      $dir_name = $cur_dir[count($cur_dir) - 1];

      return $dir_name;
   }

   //Retourne les séries mise en avant
   function series_get_hightlight(){
    $db = call_pdo();
    $series = $db->query('SELECT * FROM serie WHERE `highlighting`=1');
    return $series;
   }

   //Retourne les détails d'une série (par son ID)
   function series_get_detail($idSerie){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM serie WHERE id='.$idSerie.' ');
    return $seriesDetail;
   }

   //Retourne toutes les commentaires d'un episode
   function series_get_comment($idEpisode){
    $db = call_pdo();
    
    $queryListComment = $db->prepare("SELECT * FROM `comment` WHERE `idEpisode`=:idEpisode");
    $queryListComment->execute(array("idEpisode"=>$idEpisode));

    //$queryListComment = $db->query("SELECT * FROM `comment` WHERE `idEpisode`=".$idEpisode."");

    return  $queryListComment;
  }

?>
