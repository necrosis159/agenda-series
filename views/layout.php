<!DOCTYPE html>
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
              <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64723668-1', 'auto');
  ga('send', 'pageview');

</script>
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
                            <li><a href="/serie">Les séries</a></li>
                            <li><a href="/calendar/show">Calendrier</a></li>
                            <li><a href="#">Contact</a></li>
                            <?php if(isset($_SESSION['user_id'])) {?><li><a href="#">Gestion</a>
                                <ul id="gestion_menu">
                                    <li><a href="/admin/search">Recherche</a></li>
                                    <!-- <li><a href="#">Administration</a></li> -->
                                </ul>
                            </li>
                            <li><a href="#">Compte</a>
                                <ul id="account_menu">
                                    <li><a href="/account/profile">Mon profil</a></li>
                                    <li><a href="/account/series">Mes séries</a></li>
                                    <li><a href="/account/comments">Mes commentaires</a></li>
                                    <li><a href="/account/calendar/show">Mon calendrier</a></li>
                                </ul>
                            </li><?php } ?>

                            <?php if(!isset($_SESSION['user_id'])) {?><li><a href="/account/login">Connexion</a></li><?php } ?>
                            <?php if(!isset($_SESSION['user_id'])) {?><li><a href="/account/register">Inscription</a></li><?php } ?>
                            <?php if(isset($_SESSION['user_id'])) {?><li><a href="/account/logout">Déconnexion</a></li><?php } ?>
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
 <div id="fb-root"></div>
        <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&appId=868208133202056&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

         <div class="footer">
            <div class="wrap">

               <!-- Facebook -->
               <div class="footer-left">
                  <div class="detail">
                     <ul>
                        <h3>Rejoignez-nous sur Facebook !</h3>
                        <li>
                          <div class="fb-like-box" data-href="https://www.facebook.com/pages/Agenda-Seriefr/1377372375894645" 
                          data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true">
                          </div>
                        </li>
                        <div class="clear"> </div>
                     </ul>
                  </div>

               </div>
               <!-- Twitter -->
               <div class="footer-right">
                  <h3>L'actu sur Twitter !</h3>
                  <a class="twitter-timeline"  href="https://twitter.com/agendaserie" data-widget-id="566673345341820930">Tweets de @agendaserie</a>
                  <script>
                    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id))
                    {js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}
                    (document,"script","twitter-wjs");
                  </script>
               </div>
               <div class="clear"> </div>
            </div>
         </div>
         <div class="copy">
            <p>© 2015 Tous droits réservés - <a href="http://agenda-serie.fr">Agenda-serie.fr</a></p>
         </div>
      </div>

      <script>
      // config
      var maxBreakpoint = 768; // maximum breakpoint
      var targetID = 'navigation'; // target ID (must be present in DOM)
      var triggerID = 'toggle-nav'; // trigger/button ID (will be created into targetID)

      // targeting navigation
      var n = document.getElementById(targetID);

      // nav initially closed is JS enabled
      n.classList.add('is-closed');

      // global navigation function
      function navi() {
         // when small screen, create a switch button, and toggle navigation class
         if (window.matchMedia("(max-width:" + maxBreakpoint +"px)").matches && document.getElementById(triggerID)==undefined) {
            n.insertAdjacentHTML('afterBegin','<button id='+triggerID+' title="open/close navigation"></button>');
            t = document.getElementById(triggerID);
            t.onclick=function(){ n.classList.toggle('is-closed');}
         }
         // when big screen, delete switch button, and toggle navigation class
         var minBreakpoint = maxBreakpoint + 1;
         if (window.matchMedia("(min-width: " + minBreakpoint +"px)").matches && document.getElementById(triggerID)) {
            document.getElementById(triggerID).outerHTML="";
         }
      }
      navi();

      // when resize or orientation change, reload function
      window.addEventListener('resize', navi);
      </script>
    </body>
</html>
