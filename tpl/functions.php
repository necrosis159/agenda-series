<?php
   // Fonction de connection PDO
   function call_pdo() {
      try {
         $db = new PDO('mysql:host=localhost;dbname=agendaserie', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }
      catch (Exception $e) {
         die('Erreur : ' . $e->getMessage());
      }

      return $db;
   }

   // Requête pour récupérer tous les utilisateurs
   function selectAllUsers($db) {

      // Connection à la base de données
      $db = call_pdo();

      $query = $db->prepare("SELECT * FROM user ORDER BY id LIMIT 0,1");
      $query->execute();

      $date = array();

      while ($data = $query->fetch()) {
        echo $data['name'] . " " . $data['surname']." ".$data['birthdate'];
        $date = explode('-', $data["birthdate"]);
        $ddnExplode = $date["1"]."/".$date["2"]."/".$date["0"];
        echo "Age : ".age($ddnExplode);
        echo "<br/>";
      }

      $query->closeCursor();
   }
   
    function selectInfosUser() {
        
        // Connection à la base de données
        $db = call_pdo();
        
        $query = $db->prepare("SELECT * FROM user
                               WHERE id = '".$_SESSION['id']."'
                               ORDER BY id");
        $query->execute();
        
        return $query;
    }
    
    function seriesUser() {
        
        // Connection à la base de données
        $db = call_pdo();
        
        $query = $db->prepare("SELECT * FROM serie s, serie_user t, user u
                             WHERE u.id = t.id_user AND t.id_serie = s.id
                             AND u.id = :id
                             LIMIT 0,5
                             ");
        $query->execute(array("id"=>$_SESSION['id']));
        
        return $query;
    }

   // Fonction de calcul de l'âge, date en paramètre au format mm/dd/yyyy
   function age($date) {
      $dna = strtotime($date);
      $now = time();

      $age = date('Y',$now)-date('Y',$dna);
      if(strcmp(date('md', $dna),date('md', $now))>0) $age--;

      return $age;
   }

   // Fonction d'erreur
   function error($err = '') {
      $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
      exit('<div id="error"><p>'.$mess.'</p>
      <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div>');
   }

   // Fonction de récupération des derniers commentaires d'un utilisateur
   function last_user_comments($id = '') {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération des commentaires
      $query = $db->prepare("SELECT * FROM comment WHERE id_user = '" . $id . "' ORDER BY date_publication");

      $query->execute();

      return $query;
   }

?>
