<?php
if (!empty($message)) echo $message;
?>
<div class="wrap">
    <h5 class="heading">Connexion</h5>
    <div id='connection_bloc'>
        <form method="post" action="/account/check-login" id="article_form">
            <input type="hidden" name="page" value="<?php if (!empty($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER']; ?>">
            <label for="username">Pseudo
                <input name="username" class="input_form" type="text" id="username" tabindex="1">
            </label>
            <label for="password">Mot de Passe
                <input type="password" name="password" id="password" tabindex="2">
            </label>
            <div id="connection_btn_bloc">
                <input class="button" type="submit" value="Connexion">
                <a href="/account/register" class="button">S'inscrire</a>
            </div>
        </form>
    </div>
</div>
