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

     $query = $db->prepare("SELECT s.id as serie_id, s.name as serie_name, s.image as serie_image, u.id as user_id, t.id_serie, t.id_user
                                FROM serie s, serie_user t, user u
                                WHERE u.id = t.id_user AND t.id_serie = s.id
                                AND u.id = :id_user
                                LIMIT 0,10
                                ");
     $query->execute(array("id_user" => $_SESSION['id']));
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

   // Fonction de création d'un épisode
   function create_episode($serie, $name, $number, $resume, $release_date) {
      // Connection à la base de données
      $db = call_pdo();

      // Ajout des nouveaux champs de l'épisode
      $query = $db->prepare('INSERT INTO episode VALUES ( , "' . $serie . '", "' . $name . '", "' . $number . '", "' . $resume . '", "' . $release_date . '")');

      $query->execute();

      return $query;
   }

   // Fonction de suppression d'un épisode
   function delete_episode($id) {
      // Connection à la base de données
      $db = call_pdo();

      // Suppression de l'épisode
      $query = $db->prepare('DELETE FROM episode WHERE id = ' . $id);

      $query->execute();

      return $query;
   }

   // Fonction de récupération d'un article/épisode via son ID
   function get_episode($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération de l'épisode
      $query = $db->prepare("SELECT E.*, S.name serie_name FROM episode E, serie S WHERE E.id = " . $id . " AND E.id_serie = S.id");

      $query->execute();

      $result = $query->fetch();

      return $result;
   }

   // Fonction de récupération des articles d'un utilisateur
   function user_episodes($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération des épisodes avec l'ID de l'auteur
      $query = $db->prepare("SELECT E.*, S.name serie_name FROM episode E, serie S WHERE E.id_user = " . $id . " AND E.id_serie = S.id");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   // Fonction de modification d'un épisode
   function update_episode($id, $name, $resume, $number) {
      // Connection à la base de données
      $db = call_pdo();

      // Ajout des nouveaux champs de l'épisode
      $query = $db->prepare('UPDATE episode SET name = "' . $name . '", resume = "' . $resume . '", number = "' . $number . '" WHERE id = ' . $id);

      // die(var_dump($query));

      $query->execute();

      return $query;
   }

   // Fonction de création d'un commentaire
   function create_comment($user, $serie, $season, $episode, $title, $content, $publication_date) {
      // Connection à la base de données
      $db = call_pdo();

      // Ajout des nouveaux champs du commentaire
      $query = $db->prepare('INSERT INTO comment VALUES ("' . $user . '", "' . $episode . '", "' . $season . '", "' . $serie . '", "' . $publication_date . '", "' . $title . '", "' . $content . '")');

      $query->execute();

      return $query;
   }

   // Fonction de suppression d'un commentaie
   function delete_comment($id) {
      // Connection à la base de données
      $db = call_pdo();

      // Suppression de l'épisode
      $query = $db->prepare('DELETE FROM comment WHERE id = ' . $id);

      $query->execute();

      return $query;
   }

   // Fonction de récupération d'un commentaire via son ID
   function get_comment($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération du commentaire || à modifier avec id du comment
      $query = $db->prepare("SELECT * FROM comment WHERE id_user = " . $id);

      $query->execute();

      $result = $query->fetch();

      return $result;
   }

   // Fonction de récupération des commentaires d'un utilisateur via son ID
   function user_comments($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération des commentaires
      $query = $db->prepare("SELECT * FROM comment WHERE id_user = " . $id);

      $query->execute();

      $result = $query->fetchAll();

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

   // Fonction de modification d'un commentaire
   function update_comment($id, $name, $content) {
      // Connection à la base de données
      $db = call_pdo();

      // Mise à jour des nouveaux champs du commentaire
      $query = $db->prepare('UPDATE comment SET name = "' . $name . '", content = "' . $content . '" WHERE id = ' . $id);

      $query->execute();

      return $query;
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

   // Fonction de récupération des utilisateurs du site
   function users_list() {
      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT * FROM user");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   // Fonction de récupération de la liste des séries
   function series_list() {
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

/*LES SERIES*/

   //Retourne les séries mise en avant
   function series_get_hightlight(){
    $db = call_pdo();
    $series = $db->query('SELECT * FROM serie WHERE `highlighting`=1');
    return $series;
   }

   //Retourne les détails d'une série (par son ID)
   function series_get_detail($idSerie){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM serie WHERE id='.$idSerie);
    return $seriesDetail;
   }

   //Retourne la liste des saisons d'une série (par son ID)
   function series_get_all_seasons($idSerie){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM seasons WHERE idSerie='.$idSerie);
    return $seriesDetail;
   }

   //Retourne la saison par son ID
   function series_get_season($idSaison){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM seasons WHERE ID='.$idSaison);
    return $seriesDetail;
   }

   //Retourne toutes les episodes d'une série par l'id de la série et de la saison (croissant par date d'apparution)
   function series_get_all_episode($idSerie, $idSaison){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT * FROM episodes WHERE id_season='.$idSaison.' AND id_serie='.$idSerie.'  ORDER BY release_date');
    return $seriesDetail;
   }

   //Retourne seulement l'id et le nom de toutes les episodes d'une série par l'id de la série et de la saison (croissant par date d'apparution)
   function series_get_all_episode_fast($idSerie, $idSaison){
    $db = call_pdo();
    $seriesDetail = $db->query('SELECT id, name FROM episodes WHERE id_season='.$idSaison.' AND id_serie='.$idSerie.'  ORDER BY release_date');
    return $seriesDetail;
   }

   //Retourne toutes les commentaires d'un episode
   function series_get_comment($idEpisode){
    $db = call_pdo();
    
    $queryListComment = $db->prepare("SELECT * FROM `comment` WHERE `id_episode`=:idEpisode");
    $queryListComment->execute(array("idEpisode"=>$idEpisode));

    //$queryListComment = $db->query("SELECT * FROM `comment` WHERE `idEpisode`=".$idEpisode."");

    return  $queryListComment;
  }

  //Retourne le nom de l'utilisateur de son ID
  function get_user_by_id($idUser){
    $db = call_pdo();

    $query = $db->prepare("SELECT * FROM `user` WHERE `ID`= :idUser");
    $query->execute(array("idUser"=>$idUser));

    return $query->fetch();
  }

  //Ajoute un commentaire (Retourne 0 si l'ajout du commentaire est un echec sinon 1)
  function add_comment($idUser, $idEpisode, $idSeason, $idSerie, $date, $comment, $notation){
      $db = call_pdo(); 
       /*$query = $db->query("INSERT INTO `agendaserie`.`comment` (`id`, `id_user`, `id_episode`, `id_season`, `id_serie`, `date_publication`, `content`, `notation`) 
      VALUES (NULL, '1', '1', '1', '1', '2015-01-07', 'Ceciestun test', '1');");*/
      $query = $db->prepare("INSERT INTO `agendaserie`.`comment` (`id`, `id_user`, `id_episode`, `id_season`, `id_serie`, `date_publication`, `content`, `notation`) VALUES (NULL, ':id_user', ':id_episode', ':id_season', ':id_serie', ':date_publication', ':content', ':notation');");
      $query->execute(array("id_user"=>$idUser, 'id_episode'=>$idEpisode, 'id_season'=>$idSeason, 'id_serie'=>$idSerie, 'date_publication'=>$date, 'content'=>$comment, 'notation'=>$notation));
      return $query->fetch();
  }

  function add_favorite($idUser, $idSerie, $notation){
      // Connection à la base de données
      $db = call_pdo();

      //Ajout de l'utilisteur et de la série dans la table des favoris
      $query = $db->prepare("INSERT INTO `agendaserie`.`series_users` (`id_serie`, `id_user`, `notation`) VALUES (':id_serie', ':id_user', ':notation');");

      $query->execute(array("id_serie"=>$idSerie, "id_user"=>$idUser, "notation"=>$notation));
  }

/*FIN SERIES*/


?>
