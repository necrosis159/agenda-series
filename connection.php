<?php
include ("tpl/top.php");
?>

<div id='connection_bloc'>

    <?php
    if ($id == 0) {
        ?>
        <div id="connection">
            <fieldset>
                <legend>Connexion</legend>
                <form method="post" action="connection.php">
                    <div class="row_form">
                        <label for="pseudo">Pseudo *</label>
                        <div class="input_connection">
                            <input name="pseudo" type="text" id="pseudo" tabindex="1"><br />
                        </div>
                    </div>
                    <div class="row_form">
                        <label for="password">Mot de Passe *</label>
                        <div class="input_connection">
                            <input type="password" name="password" id="password" tabindex="2">
                        </div>
                        <input type="submit" value="Connexion" />
                    </div>
                </form>
                <a href="./register.php">Pas encore inscrit ?</a>
            </fieldset>
            <?php
            if (!isset($_POST['pseudo'])) {
                $message = '';
            } else {
                $message = '';
                if (empty($_POST['pseudo']) || empty($_POST['password'])) {
                    $message = '<p>une erreur s\'est produite pendant votre identification.
				Vous devez remplir tous les champs</p>
				<p>Cliquez <a href="./connection.php">ici</a> pour revenir</p>';
                } else {
                    $query = $db->prepare("SELECT id, pseudo, password
		        FROM users WHERE pseudo = :pseudo");
                    $query->execute(array("pseudo" => $_POST["pseudo"]));
                    // $query->execute();
                    $data = $query->fetch();
                    if ($data['password'] == $_POST['password']) {
                        $_SESSION['pseudo'] = $data['pseudo'];
                        // $_SESSION['level'] = $data['membre_rang'];
                        $_SESSION['id'] = $data['id'];
                        echo '<script language="Javascript">
                            document.location.replace("index.php");
                            </script>';
                    } else {
                        $message = '<p>Une erreur s\'est produite 
				    pendant votre identification.<br /> Le mot de passe ou le pseudo 
			        entré n\'est pas correcte.</p>';
                    }
                    $query->CloseCursor();
                }
            }
//            $page = htmlspecialchars($_POST['page']);
//            echo 'Cliquez <a href="' . $page . '">ici</a> pour revenir à la page précédente';
        } else {
            $message = "Vous êtes déjà connecté";
        }
        echo $message;
        ?>
    </div>
</div>

