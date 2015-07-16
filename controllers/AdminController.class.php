<?php

   class AdminController extends baseView {

      // Controller de la page de recherche de l'administrateur
      public function search() {

          if ((!isset($_SESSION['user_status'])) || ($_SESSION['user_status'] != 1)) {
              $this->redirect("index", "");
          }

          $content = null;
          $type = "";
          $title = "";
          $date = "";
          $oldTitle = "";
          $oldDate = "";
          $oldType = "";

          if (isset($_GET["type"]) && $_GET["type"] != "") {
              $type = $_GET["type"];
              $oldType = $_GET["type"];
          }

          if (isset($_GET["title"]) && $_GET["title"] != "") {
              $title = $_GET["title"];
              $oldTitle = $_GET["title"];
          }

          if (isset($_GET["date"]) && $_GET["date"] != "") {
              $date = $_GET["date"];
              $oldDate = $_GET["date"];
          }

          $admin = new Admin();

          if (isset($_GET["type"]) && $_GET["type"] != "") {
              $content = $admin->_searchContent($type, $title, $date);
          }

          $this->assign("oldTitle", $oldTitle);
          $this->assign("oldType", $oldType);
          $this->assign("oldDate", $oldDate);
          $this->assign("content", $content);
          $this->render("admin/search");
      }

      //  Controller de la page d'édition des commentaires
      public function editComment($idComment) {

          // Variable utilisée pour indiquer s'il y a eu une modification ou non
          $update = false;

          // On vérifie que l'utilisateur est bien un administrateur
          if ((!isset($_SESSION['user_status'])) || ($_SESSION['user_status'] != 1)) {
              $this->redirect("index", "");
          }

          $comment = new Comment();

          if (isset($_POST["submit"])) {
              $data_update = array("comment_title" => $_POST["title"], "comment_content" => $_POST["content"], "comment_status" => $_POST["status"]);
              $comment->_updateEditedComment($idComment, $data_update);
              $update = true;
          }

          // On récupère le contenu du commentaire
          $content = $comment->_getEditedComment($idComment);

          // On test l'existance du commentaire, s'il n'existe pas on redirige l'utilisateur vers l'accueil
          if (count($content) == 0) {
              $this->redirect("index", "");
          }

          $this->assign("update", $update);
          $this->assign("idComment", $idComment);
          $this->assign("data", $content[0]);
          $this->render("admin/editComment");
      }
   }

?>
