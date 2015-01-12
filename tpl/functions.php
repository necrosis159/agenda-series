<?php
// Requête pour récupérer toutes les lignes de la bdd
function selectAllUsers($db) {
    $query = $db->prepare("SELECT * FROM users
                           ORDER BY id
                           LIMIT 0,1
                           ");
    $query->execute();
    $date = array();
    while ($data = $query->fetch()) {
        echo $data['name'] . " " . $data['surname']." ".$data['birthdate'];
        $date = explode('-', $data["birthdate"]);
        // var_dump($date);
        $ddnExplode = $date["1"]."/".$date["2"]."/".$date["0"];
        echo "Age : ".age($ddnExplode);
        echo "<br/>"; 
    }
    $query->closeCursor();
}

// Fonction de calcul de l'âge, date en paramètre au format mm/dd/yyyy
function age($date) {
      $dna = strtotime($date);
      $now = time();
       
      $age = date('Y',$now)-date('Y',$dna);
      if(strcmp(date('md', $dna),date('md', $now))>0) $age--;
     
      return $age;
} 

function error($err='') {
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('<div id="error"><p>'.$mess.'</p>
   <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div>');
}
?>