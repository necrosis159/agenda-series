<?php

   // Fonction de création d'un commentaire
   function create_comment($user, $serie, $season, $episode, $title, $content, $publication_date) {
      // Connection à la base de données
      $db = call_pdo();

      // Ajout des nouveaux champs du commentaire
      $query = $db->prepare('INSERT INTO comment VALUES ("' . $user . '", "' . $episode . '", "' . $season . '", "' . $serie . '", "' . $publication_date . '", "' . $title . '", "' . $content . '")');

      $query->execute();

      return $query;
   }

   // Fonction de récupération de tous les commentaires
   function get_comments() {
      // Connection à la base de données
      $db = call_pdo();

      // Récupération du commentaire || à modifier avec id du comment
      $query = $db->prepare("SELECT * FROM comment");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   // Fonction de récupération de tous les commentaires
   function get_comment($id = '') {
      // Connection à la base de données
      $db = call_pdo();


      // Récupération du commentaire d'un utilisateur
      $query = $db->prepare("SELECT C.*, U.username AS author, E.name AS episode, SA.name AS status FROM comment C, user U, episode E, status_article SA WHERE C.id = " . $id . " AND C.id_episode = E.id AND C.id_user = U.id AND C.status = SA.id");

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
      $query = $db->prepare("SELECT * FROM comment WHERE id_user = " . $id . " LIMIT 5");

      $query->execute();

      $result = $query->fetchAll();

      return $result;
   }

   // Fonction de suppression d'un commentaie
   function remove_comment($id) {
      // Connection à la base de données
      $db = call_pdo();

      // Mise à jour du statut
      $query = $db->prepare('UPDATE comment SET status = 4 WHERE id = ' . $id);

      $query->execute();

      return $query;
   }

   // Fonction de désactivation d'un commentaie
   function suspend_comment($id) {
      // Connection à la base de données
      $db = call_pdo();

      // Mise à jour du statut
      $query = $db->prepare('UPDATE comment SET status = 2 WHERE id = ' . $id);

      $query->execute();

      return $query;
   }

   // Fonction de réactivation d'un commentaie
   function unsuspend_comment($id) {
      // Connection à la base de données
      $db = call_pdo();

      // Mise à jour du statut
      $query = $db->prepare('UPDATE comment SET status = 3 WHERE id = ' . $id);

      $query->execute();

      return $query;
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

?>
