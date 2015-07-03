<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mon titre</title>
        <meta name="description" content="Ma description">
        <link type="text/css" rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/css/styles.css" />
        <link type="text/css" rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/css/menu.css" />
        <link type="text/css" rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/css/series.css" />
    </head>
    <body>
        <!-- start header -->
        <div class="header_bg">
            <div class="wrap">
                <div class="header">
                    <div class="logo">
                        <a href="/">
                            <img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/images/home.jpg" alt=""/>
                            <h1> A S </h1>
                            <div class="clear"> </div>
                        </a>
                    </div>
                    <div class="text">
                        <p>Toute l'actualité des séries TV</p>
                    </div>
                    <div class="clear"> </div>
                </div>
            </div>
        </div>

        <?php $page_name = ""; ?>

        <!-- start header -->
        <div class="header_btm">
            <div class="">
                <!-- Menu pour res < 768px -->
                <div id="page">
                    <nav role="navigation" id="navigation">
                        <ul>
                            <li <?php if ($page_name == "index.php"): ?> class="active" <?php endif; ?>><a href="/">Accueil</a></li>
                            <li><a href="#">Les séries</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Calendrier</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Compte</a></li>
                            <li><a href="#">Gestion</a></li>
                        </ul>
                    </nav>
                </div>

                <!-- Menu pour res > 768px -->
                <div class="header_sub">

                    <div class="h_menu">
                        <ul>
                            <li <?php if ($page_name == "index.php"): ?> class="active" <?php endif; ?>><a href="/">Accueil</a></li>
                            <li><a href="#">Les séries</a></li>
                            <li><a href="#">Calendrier</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Gestion</a>
                                <ul id="gestion_menu">
                                    <li><a href="#">Tableau de bord</a></li>
                                    <li><a href="#">Mes articles</a></li>
                                    <li><a href="#">Mes commentaires</a></li>
                                    <li><a href="#">Administration</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Compte</a>
                                <ul id="account_menu">
                                    <li><a href="#">Mon profil</a></li>
                                    <li><a href="#">Mes séries</a></li>
                                    <li><a href="#">Mon calendrier</a></li>
                                    <li><a href="#">Mes informations</a></li>
                                </ul>
                            </li>

                            <li><a href="/account/login">Connexion</a></li>
                            <li><a href="/account/register">Inscription</a></li>
                            <li><a href="/account/logout">Déconnexion</a></li>
                        </ul>
                    </div>

                    <div class="h_search">
                        <form method="POST" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/global_search.php">
                            <input type="text" value="" name="search_text" id="global_search" placeholder="Rechercher une série, un utilisateur...">
                            <input type="submit" value="">
                        </form>
                    </div>
                    <div class="clear"> </div>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
        <?php include($view); ?>

    </body>
</html>