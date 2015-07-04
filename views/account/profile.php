<?php if(!empty($message)) echo $message; ?>
<script type="text/javascript" src="/js/account/account.js"></script>
<div id="profile_bloc">
    <div class="wrap">
        <h1 class="heading">Mon Profil</h1>
        <div id="profile_user">
            <div id="profile_avatar">
                <img src="/images/<?php echo $result["user_avatar"]; ?>" class="avatar_image">
                <div id='avatar_modify'>
                    <a href='#' class="button">Modifier l'Avatar</a>
                </div>
            </div>
            <div id="profile_informations">
                <h1 class="heading"><?php echo $result['user_username']; ?></h1>
                <ul>
                    <li>Inscription le <?php echo $result['user_creation_date']; ?></li>
                    <li>Age : <?php echo $age; ?> ans</li>
                    <li>Dernière connexion : <?php echo $result['user_last_login']; ?></li>
                    <li>Nombre de séries suivies : <?php echo $nb_series_follow; ?></li>
                    <li>Nombre de commentaires postés : <?php echo $nb_comments_posted;   ?></li>
                </ul>
                <a href='/account/edit' class="button">Modifier les informations</a>
            </div>
        </div>
        <div id="create_logo" style="display: none;">
            <h1> Avatar </h1>
            <br/>

            <!--Sélection de l'image-->
            <p>
                1) Sélectionnez une image.
            </p>
            Format d'image accepté : jpeg et png.<br/>

            <form method="post" enctype="multipart/form-data" action="/account/profile">
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
