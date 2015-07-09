<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agenda-Serie</title>
        <meta name="description" content="Ma description">
        <link type="text/css" rel="stylesheet" href="/css/styles.css" />
        <link type="text/css" rel="stylesheet" href="/css/menu.css" />
        <link type="text/css" rel="stylesheet" href="/css/series.css" />
        <link type="text/css" rel="stylesheet" href="/css/calendar.css" />
        <link type="text/css" rel="stylesheet" href="/css/jquery-ui.min.css" />
        <!--<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"/>-->
    </head>
    <body>
        <!-- start header -->
        <div class="header_bg">
            <div class="wrap">
                <div class="header">
                    <div class="logo">
                        <a href="/">
                            <img src="/images/home.jpg" alt=""/>
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
                            <li><a href="/calendar/show">Calendrier</a></li>
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
                                    <li><a href="/account/profile">Mon profil</a></li>
                                    <li><a href="/account/series">Mes séries</a></li>
                                    <li><a href="/account/calendar/show">Mon calendrier</a></li>
                                </ul>
                            </li>

                            <li><a href="/account/login">Connexion</a></li>
                            <li><a href="/account/register">Inscription</a></li>
                            <li><a href="/account/logout">Déconnexion</a></li>
                        </ul>
                    </div>

                    <div class="h_search">
                        <form method="POST" action="/global_search.php">
                            <input type="text" value="" name="search_text" id="global_search" placeholder="Rechercher une série, un utilisateur...">
                            <input type="submit" value="">
                        </form>
                    </div>
                    <div class="clear"> </div>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
        <?php include($view); ?>

    </body>
</html>
