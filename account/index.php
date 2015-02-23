<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

$result = selectInfosUser($_SESSION['id'])->fetch();

$explode_birthdate = explode('-', $result['birthdate']);
$birthdate = $explode_birthdate[1] . '/' . $explode_birthdate[0] . '/' . $explode_birthdate[2];
$avatar = $result['avatar'];

$maxsize = ini_get("upload_max_filesize"); 
$maxsize_octet = 1024 * 1024 * str_replace("M", "", $maxsize);
      
//Création d'un tableau php avec les extensions valides
$extensions_valides = array('jpg', 'jpeg', 'png');
//chemin en relatif d'upload
//      $upload_directory = "./uploads";
$upload_directory = '../images/avatar';
$fonts_directory = "./fonts";
  
// Quand l'utilisateur envoie le formulaire
if (isset($_POST["submit"])) {
  //Est-ce que le fichier image existe
  if (isset($_FILES['image'])) {

    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
      if ($_FILES['image']['size'] > $maxsize_octet) {
        echo "Le fichier est trop gros";
        error_message("Le fichier est trop gros");
      } else {
//        if (isset($_POST['description']) && trim($_POST['description']) != "") {
          $error = 0;
          // Vérification de l'extension du fichier
          $parse_name = explode(".", $_FILES['image']['name']);
          $extension_upload = strtolower(end($parse_name));
          if (in_array($extension_upload, $extensions_valides)) {
            // Si le dossier d'upload n'existe pas on le crée
            if (!file_exists($upload_directory)) {
              mkdir($upload_directory);
            }
            // Création d'un nom unique pour le fichier
            $nom = md5(uniqid(rand(), true)) . "." . end($parse_name);
            // ici on fait tout
            // On transfert le fichier dans le répertoire d'upload
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_directory . "/" . $nom)) {
              // Création de l'image en fonction de l'extension
              if ($extension_upload == "png") {
                $image = imagecreatefrompng($upload_directory . "/" . $nom);
                // $image = imagecreatefrompng($_FILES['image']['tmp_name']);
              } else {
                $image = imagecreatefromjpeg($upload_directory . "/" . $nom);
                // $image = imagecreatefrompng($_FILES['image']['tmp_name']);
              }


              // Récup données formulaires
              // Texte à écrire sur l'image
              $texte = $_POST["description"];
              echo $texte;
              // Taile de la police
              if (is_numeric($_POST["font_size"])) {
                $font_size = $_POST["font_size"];
              } else {
                $error ++;
              }

              // Récupération de la police avec le style choisis
              $bold = "";
              $italic = "";
              if (isset($_POST["font_bold"]) && $_POST["font_bold"] == "on") {
                $bold .= "b";
              }
              if (isset($_POST["font_italic"]) && $_POST["font_italic"] == "on") {
                $italic .= "i";
              }

              $font = $fonts_directory . "/" . $_POST["font"] . $bold . $italic . ".ttf";

              // Couleur du texte
              $font_color = hexdec($_POST["font_color"]);

              // Cadre autour du texte
              $bbox = imageftbbox($font_size, 0, $font, $texte);

              // Abscisse du cadre
              switch ($_POST["font_position_x"]) {
                case 'gauche':
                  $x = $bbox[0] + (imagesx($image) * 0.05);
                  break;
                case 'milieu':
                  $x = $bbox[0] + (imagesx($image) / 2) - ($bbox[4] / 2) - 5;
                  break;
                case 'droite':
                  $x = imagesx($image) - ((imagesx($image) * 0.05) + $bbox[4]);
                  break;
                default:
                  $error ++;
                  break;
              }

              // Ordonnée du cadre
              switch ($_POST["font_position_y"]) {
                case 'haut':
                  $y = $bbox[0] + (imagesy($image) * 0.10);
                  break;
                case 'milieu':
                  $y = $bbox[1] + (imagesy($image) / 2) - ($bbox[5] / 2) - 5;
                  break;
                case 'bas':
                  $y = imagesy($image) - ((imagesy($image) * 0.10) + $bbox[3]);
                  ;
                  break;
                default:
                  $error ++;
                  break;
              }

              // Rotation du texte en degrés
              if (isset($_POST["rotation"]) && is_numeric($_POST["rotation"])) {
                $rotation = intval($_POST["rotation"]);
              } else {
                $rotation = 0;
              }

              // Tous les pramamètres sont bons, il n'y a pas d'erreur
              if ($error < 1) {
                // var_dump($bbox);
                putenv('GDFONTPATH=' . realpath('.'));
                imagettftext($image, $font_size, $rotation, $x, $y, $font_color, $font, $texte);
                imagepng($image, $upload_directory . "/" . $nom);
//                echo "<br/>Prévisualisation - ";
//                echo "<a href=\"download.php?file=" . $nom . "&root=" . $upload_directory . "/\">Télécharger</a>";
//                echo "<br/><br/>";
//                echo "<img src='" . $upload_directory . "/" . $nom . "' width='200px' height='200px'>";
                updateAvatar($_SESSION['id'], 'avatar/'.$nom);
                $newAvatarUrl = 'avatar/'.$nom;
                $error = -1;
              } else {
                error_message("Erreur de paramètres du texte");
              }
            } else {
              error_message("Transfert echec");
            }
          } else {
            error_message("Extension incorrecte");
          }
        //} 
//        else {
//          echo $upload_directory . "/" . $nom; 
//          updateAvatar();
//          valid_message('Avatar modifié');
//        }
      }
    } else {
      switch ($_FILES['image']['error']) {
        case UPLOAD_ERR_NO_FILE:
          error_message("Fichier manquant");
          break;
        case UPLOAD_ERR_INI_SIZE:
          error_message("Fichier dépassant la taille maximale autorisée par PHP");
          break;
        case UPLOAD_ERR_FORM_SIZE:
          error_message("Fichier dépassant la taille maximale autorisée par le formulaire");
          break;
        case UPLOAD_ERR_PARTIAL:
          error_message("Fichier transféré partiellement");
          break;
        default:
          error_message("Erreur inconnue ...");
          break;
      }
    }
  }
}

if(isset($error) && $error == -1) {
  valid_message('Avatar modifié');
}
if(isset($newAvatarUrl)) {
  $avatar = $newAvatarUrl;
}
?>

<div id="profile_bloc">
  <div class="wrap">
    <h1 class="heading">Mon Profil</h1>
    <div id="profile_avatar">
      <img src="../images/<?php echo $avatar; ?>" class="avatar_image">
      <div id='avatar_modify'>
        <a href='#' class="button">Modifier l'Avatar</a>
      </div>
    </div>
    <div id="profile_informations">
      <ul>
        <li><?php echo $result['username']; ?> inscrit depuis le <?php echo $result['creation_date']; ?></li>
        <li>Age : <?php echo age($result['birthdate']); ?></li>
        <li>Dernière connexion : <?php echo $result['last_login']; ?></li>
        <li>Nombre de séries suivies : <?php echo count(seriesUser($id)); ?></li>
        <li>Nombre d'articles postés : </li>
        <li>Nombre de commentaires rédigés : </li>
        <li>Nombre de notes attribuées : </li>
      </ul>
    </div>
    
    <div id="create_logo" style="display:none;">
      <h1> Avatar </h1>
      <br/>

      <!--Sélection de l'image-->
      <p>
        1) Sélectionnez une image.
      </p>
      Format d'image accepté : jpeg et png.<br/>
      
      <form method="post" enctype="multipart/form-data" action="index.php">
        <input class="button" type="file" name="image">
        <br/>
        Taille maximale de l'image : <?php echo $maxsize; ?>o<br/>
        <br/><br/>
        
        <input type="button" class="button" id="show_text_options" value="Ajouter du texte">
        <br/><br/>
        <p id='create_logo_ou'>OU</p>
        
        <!--Ajout et personnalisation du texte-->
        <div id="font_bloc" style="display: none;">
          <p>2) Ajoutez du texte et personnalisez le.</p>
          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxsize_octet; ?>">
          Police <br/><br/>
          <select name="font">
            <option value="arial">Arial</option>
            <option value="calibri">Calibri</option>
            <option value="times">Times New Roman</option>
            <option value="verdana">Verdana</option>
          </select>
          <select name="font_size">
            <?php
            if (isset($_POST["font_size"])) {
              echo "<option value=" . $_POST["font_size"] . " selected='selected'>" . $_POST["font_size"] . "</option>";
            }
            for ($i = 20; $i <= 70; $i = $i + 2) {
              if (!isset($_POST["font_size"]) && $i == 30) {
                echo "<option value=" . $i . " selected='selected'>" . $i . "</option>";
              } else {
                echo "<option value=" . $i . ">" . $i . "</option>";
              }
            }
            ?>
          </select>
          <input type="color" name="font_color" value="<?php if (isset($_POST["font_color"])) echo $_POST["font_color"] ?>">
          <br/><br/>
          Position :
          <select name="font_position_y">
            <?php
            if (isset($_POST["font_position_y"])) {
              echo "<option value=" . $_POST["font_position_y"] . " selected='selected'>" . ucfirst($_POST["font_position_y"]) . "</option>";
            }
            ?>
            <option value="haut">Haut</option>
            <option value="milieu">Milieu</option>
            <option value="bas">Bas</option>
          </select>
          <select name="font_position_x">
            <?php
            if (isset($_POST["font_position_x"])) {
              echo "<option value=" . $_POST["font_position_x"] . " selected='selected'>" . ucfirst($_POST["font_position_x"]) . "</option>";
            }
            ?>
            <option value="gauche">Gauche</option>
            <option value="milieu">Milieu</option>
            <option value="droite">Droite</option>
          </select><br/><br/>
          <label for="font_bold"><b>Gras</b></label> 
          <input type="checkbox" name="font_bold" id="font_bold" <?php if (isset($_POST["font_bold"])) echo "checked" ?> > 
          &nbsp;
          <label for="font_italic"><i>Italique</i></label> 
          <input type="checkbox" name="font_italic" id="font_italic" <?php if (isset($_POST["font_bold"])) echo "checked" ?> >
          <br><br>
          Rotation : <input type="number" name="rotation" step="5" value="<?php if (isset($_POST["rotation"])) echo $_POST["rotation"] ?>"> degrés<br/><br/>
          <textarea class="yo" id="yo" name="description" placeholder="Texte à écrire sur l'image"><?php if (isset($_POST["description"])) echo $_POST["description"] ?></textarea>
        </div>
        <br/><br/>
        <input type="submit" id="logo_submit" class="button" name="submit" value="Télécharger l'image">
        <br/>
      </form>
    </div>
  </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";
?>