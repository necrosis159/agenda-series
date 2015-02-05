<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/top.php";

$result = selectInfosUser()->fetch();
if ($result['avatar'] == '') {
  if ($result['gender'] == '1') {
    $avatar = 'avatar_woman.png';
  } else {
    $avatar = 'avatar_man.png';
  }
}

$explode_birthdate = explode('-', $result['birthdate']);
$birthdate = $explode_birthdate[1] . '/' . $explode_birthdate[0] . '/' . $explode_birthdate[2];
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
                <li><?php echo $result['pseudo']; ?> inscrit depuis le <?php echo $result['creation_date']; ?></li>
                <li>Age : <?php echo age($result['birthdate']); ?></li>
                <li>Dernière connexion : <?php echo $result['last_login']; ?></li>
                <li>Nombre de séries suivies : <?php echo count(seriesUser()); ?></li>
                <li>Nombre d'articles postés : </li>
                <li>Nombre de commentaires rédigés : </li>
                <li>Nombre de notes attribuées : </li>
            </ul>
        </div>
        <div id="create_logo">
            <h1> Créateur Logo </h1>
            <p>
                Uploadez votre image et insérez du texte avec les fonctionnalités ci-dessous. <br/>
                Vous pourrez télécharger votre image lorsque vous aurez terminé :) .
            </p>
            <br/>
            Format d'image accepté : jpeg et png.<br/>
            <!--32M-->
            <?php $maxsize = ini_get("upload_max_filesize"); ?>
            <!--32*1024*1024-->
            <?php $maxsize_octet = 1024 * 1024 * str_replace("M", "", $maxsize); ?>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="image"><span id="red">*</span>
                <br/>
                Limite : <?php echo $maxsize; ?>o<br/>
                <br/>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxsize_octet; ?>">
                <div id="font_bloc">
                    <fieldset id="police">
                        <legend>Police</legend>
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
                        <textarea name="description" placeholder="Texte à écrire sur l'image"><?php if (isset($_POST["description"])) echo $_POST["description"] ?></textarea>
                        <span id="red">*</span>
                        <br><br>
                        Ajouter votre logo sur l'image: jpeg et png 
                        <input type="file" name="image_logo">
                        <br/>
                        Limite : <?php echo $maxsize; ?>o<br/>
                        <br/>
                        Position du logo:
                        <select name="logo_position_y">
                            <option value="haut">Haut</option>
                            <option value="milieu">Milieu</option>
                            <option value="bas">Bas</option>
                        </select>
                        <select name="logo_position_x">
                            <option value="gauche">Gauche</option>
                            <option value="milieu">Milieu</option>
                            <option value="droite">Droite</option>
                        </select>
                </div>
                <br/>
                <span id="red">* champs obligatoires</span>
                <br/><br/>
                <input type="submit" name="submit" value="Voir">
                <br/>
            </form>
            </fieldset>


            <?php
            //Création d'un tableau php avec les extensions valides
            $extensions_valides = array('jpg', 'jpeg', 'png');
            //chemin en relatif d'upload
            $upload_directory = "./uploads";
            $fonts_directory = "./fonts";

            if (isset($_POST["submit"])) {
              // var_dump($_POST);
              //Est-ce que le fichier image existe
              if (isset($_FILES['image'])) {

                if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                  if ($_FILES['image']['size'] > $maxsize_octet) {
                    echo "Le fichier est trop gros";
                  } else {
                    if (isset($_POST['description'])) {
                      $error = 0;
                      if (trim($_POST['description']) == "")
                        echo "<span style='color:#FF9900;'>Champs de texte vide!</span>";
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
                          // echo "Transfert réussi<br/>";
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
                            //Chemin en relatif d'upload
                            $upload_directory_logo = "./uploads/logos";

                            if (isset($_FILES['image_logo'])) {

                              if ($_FILES['image_logo']['error'] == UPLOAD_ERR_OK) {
                                if ($_FILES['image']['size'] > $maxsize_octet) {
                                  echo "Le fichier est trop gros";
                                } else {
                                  // Vérification de l'extension du fichier
                                  $parse_name = explode(".", $_FILES['image_logo']['name']);
                                  $extension_upload = strtolower(end($parse_name));
                                  if (in_array($extension_upload, $extensions_valides)) {
                                    // Si le dossier d'upload n'existe pas on le crée
                                    if (!file_exists($upload_directory_logo)) {
                                      mkdir($upload_directory_logo);
                                    }
                                    // Création d'un nom unique pour le fichier
                                    $nom_logo = md5(uniqid(rand(), true)) . "." . end($parse_name);
                                    // On transfert le fichier dans le répertoire d'upload
                                    if (move_uploaded_file($_FILES['image_logo']['tmp_name'], $upload_directory_logo . "/" . $nom_logo)) {
                                      // Création de l'image en fonction de l'extension
                                      if ($extension_upload == "png") {
                                        $image_logo = imagecreatefrompng($upload_directory_logo . "/" . $nom_logo);
                                      } else {
                                        $image_logo = imagecreatefromjpeg($upload_directory_logo . "/" . $nom_logo);
                                      }
                                      //Connaitre la taille de l'image et du logo

                                      $x_image_logo = imagesx($image_logo);
                                      $y_image_logo = imagesy($image_logo);
                                      $x_image = imagesx($image);
                                      $y_image = imagesy($image);

                                      //Définition de la taille du logo
                                      $width = $y_image * 0.25;

                                      //Recupere la taille du logo et fixe les nouvelles tailles
                                      $size = GetimageSize($upload_directory_logo . "/" . $nom_logo);
                                      $height = round($width * $size[1] / $size[0]);

                                      //Genere la nouvelle image
                                      $image_logo_resize = ImageCreateTrueColor($width, $height);
                                      ImageCopyResampled($image_logo_resize, $image_logo, 0, 0, 0, 0, $width, $height, $x_image_logo, $y_image_logo);

                                      //Positionnement du logo

                                      switch ($_POST["logo_position_y"]) {
                                        case "haut":
                                          $imageFinal_y = 0;
                                          break;

                                        case "milieu":
                                          $imageFinal_y = ($y_image / 2) - ($height / 2);
                                          break;

                                        case "bas":
                                          $imageFinal_y = $y_image - $height;
                                          break;
                                        default:
                                          $imageFinal_y = 0;
                                          break;
                                      }
                                      switch ($_POST["logo_position_x"]) {
                                        case "gauche":
                                          $imageFinal_x = 0;
                                          break;
                                        case "droite":
                                          $imageFinal_x = $x_image - $width;
                                          break;
                                        case "milieu":
                                          $imageFinal_x = ($x_image / 2) - ($width / 2);
                                          break;
                                        default:
                                          $imageFinal_x = 0;
                                          break;
                                      }

                                      $black = imagecolorallocate($image_logo_resize, 0, 0, 0);
                                      imagecolortransparent($image_logo_resize, $black);
                                      imagecopymerge($image, $image_logo_resize, $imageFinal_x, $imageFinal_y, 0, 0, $width, $height, 100);
                                      imagepng($image_logo_resize, $upload_directory_logo . "/" . $nom_logo);
                                    }
                                  }
                                }
                              } else {
                                switch ($_FILES['image_logo']['error']) {
                                  case UPLOAD_ERR_NO_FILE:
                                    echo "Fichier manquant<br>";
                                    break;
                                  case UPLOAD_ERR_INI_SIZE:
                                    echo "Fichier dépassant la taille maximale autorisée par PHP<br>";
                                    break;
                                  case UPLOAD_ERR_FORM_SIZE:
                                    echo "Fichier dépassant la taille maximale autorisée par le formulaire<br>";
                                    break;
                                  case UPLOAD_ERR_PARTIAL:
                                    echo "Fichier transféré partiellement<br>";
                                    break;
                                  default:
                                    echo "Erreur inconnue ... <br>";
                                    break;
                                }
                              }
                            }
                            // var_dump($bbox);
                            putenv('GDFONTPATH=' . realpath('.'));
                            imagettftext($image, $font_size, $rotation, $x, $y, $font_color, $font, $texte);
                            imagepng($image, $upload_directory . "/" . $nom);
                            echo "<fieldset id='image'>";
                            echo "<legend>Image</legend>";
                            echo "<h3>Prévisualisation</h3>";
                            // echo "<a href=\"download.php?file=".$nom."&root=".$upload_directory."/\">Télécharger</a>";
                            echo "<a href='" . $upload_directory . "/" . $nom . "' download='monLogo.png'>Télécharger</a>";
                            echo "<br/><br/>";
                            echo "<img src='" . $upload_directory . "/" . $nom . "' width='75%' height='75%'>";
                            echo "<br/>";
                            echo "</fieldset>";
                          } else {
                            echo "Erreur de paramètres du texte";
                          }
                        } else {
                          echo "Transfert echec";
                        }
                      } else {
                        echo "Extension incorrecte<br>";
                      }
                    }
                  }
                } else {
                  switch ($_FILES['image']['error']) {
                    case UPLOAD_ERR_NO_FILE:
                      echo "Fichier manquant<br>";
                      break;
                    case UPLOAD_ERR_INI_SIZE:
                      echo "Fichier dépassant la taille maximale autorisée par PHP<br>";
                      break;
                    case UPLOAD_ERR_FORM_SIZE:
                      echo "Fichier dépassant la taille maximale autorisée par le formulaire<br>";
                      break;
                    case UPLOAD_ERR_PARTIAL:
                      echo "Fichier transféré partiellement<br>";
                      break;
                    default:
                      echo "Erreur inconnue ... <br>";
                      break;
                  }
                }
              }
            }
            ?>
        </div>
    </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/tpl/footer.php";
?>