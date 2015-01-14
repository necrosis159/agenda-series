<?php

   // Récupération du nom du fichier utilisé
   $folder = dirname($_SERVER['PHP_SELF']);
   $page_name = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
   // Récupération du nom du répertoire courant
   $cur_dir = explode('\\', getcwd());
   $dir_name = $cur_dir[count($cur_dir)-1];

?>

<!-- start top header -->
<div class="top_header_btm">
   <div class="wrap">
      <!-- Menu pour res < 768px -->
      <div id="page">
         <div id="header">
            <a class="navicon" href="#menu-left"> </a>
         </div>
         <nav id="menu-left">
            <ul>
               <?php if($id != 0): ?>
                  <li <?php if($dir_name == "localweb"): ?> class="active" <?php endif; ?>><a href="/">Site</a></li>
                  <li <?php if($dir_name == "account"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/index.php">Compte</a></li>
                  <li <?php if($dir_name == "management"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/index.php">Gestion</a></li>
                  <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/logout.php">Déconnexion</a></li>
               <?php else: ?>
                  <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/login.php">Connexion</a></li>
                  <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/register.php">Inscription</a></li>
               <?php endif; ?>
            </ul>
         </nav>
      </div>

      <!-- Menu pour res > 768px -->
      <div class="header_sub">

         <div class="th_menu">
            <ul>
               <?php if($id != 0): ?>
                  <li <?php if($dir_name == "localweb"): ?> class="active" <?php endif; ?>><a href="/">Site</a></li>
                  <li <?php if($dir_name == "account"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/index.php">Compte</a></li>
                  <li <?php if($dir_name == "management"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/index.php">Gestion</a></li>
                  <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/logout.php">Déconnexion</a></li>
               <?php else: ?>
                  <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/login.php">Connexion</a></li>
                  <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/register.php">Inscription</a></li>
               <?php endif; ?>
            </ul>
         </div>
         <div class="clear"> </div>
      </div>
   </div>
</div>

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

<?php if($folder == "/account"): ?>

<!-- start header -->
<div class="header_btm">
   <div class="wrap">
      <!-- Menu pour res < 768px -->
      <div id="page">
         <div id="header">
            <a class="navicon" href="#menu-left"> </a>
         </div>
         <nav id="menu-left">
            <ul>
               <li <?php if($page_name == "index.php"): ?> class="mm-selected" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/index.php">Mon profil</a></li>
               <li <?php if($page_name == "account_series.php"): ?> class="mm-selected" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/account_series.php">Mes séries</a></li>
               <li <?php if($page_name == "account_calendrier.php"): ?> class="mm-selected" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/account_calendrier.php">Mon calendrier</a></li>
               <li <?php if($page_name == "account_info.php"): ?> class="mm-selected" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/account_info.php">Mes informations</a></li>
            </ul>
         </nav>
      </div>

      <!-- Menu pour res > 768px -->
      <div class="header_sub">

         <div class="h_menu">
            <ul>
               <li <?php if($page_name == "index.php"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/index.php">Mon profil</a></li>
               <li <?php if($page_name == "account_series.php"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/account_series.php">Mes séries</a></li>
               <li <?php if($page_name == "account_calendrier.php"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/account_calendrier.php">Mon calendrier</a></li>
               <li <?php if($page_name == "account_info.php"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/account_info.php">Mes informations</a></li>
            </ul>
         </div>

         <div class="h_search">
            <form>
               <input type="text" value="" placeholder="Rechercher...">
               <input type="submit" value="">
            </form>
         </div>
         <div class="clear"> </div>
      </div>
   </div>
</div>

<?php elseif($folder == "/management"): ?>

   <!-- start header -->
   <div class="header_btm">
      <div class="wrap">
         <!-- Menu pour res < 768px -->
         <div id="page">
            <div id="header">
               <a class="navicon" href="#menu-left"> </a>
            </div>
            <nav id="menu-left">
               <ul>
                  <li <?php if($page_name == "index.php"): ?> class="mm-selected" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/index.php">Tableau de bord</a></li>
                  <li <?php if($page_name == "manage_articles.php"): ?> class="mm-selected" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_articles.php">Mes articles</a></li>
                  <li <?php if($page_name == "manage_comments.php"): ?> class="mm-selected" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_comments.php">Mes commentaires</a></li>
                  <li <?php if($page_name == "manage_users.php"): ?> class="mm-selected" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_users.php">Utilisateurs</a></li>
               </ul>
            </nav>
         </div>

         <!-- Menu pour res > 768px -->
         <div class="header_sub">

            <div class="h_menu">
               <ul>
                  <li <?php if($page_name == "index.php"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/index.php">Tableau de bord</a></li>
                  <li <?php if($page_name == "manage_articles.php"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_articles.php">Mes articles</a></li>
                  <li <?php if($page_name == "manage_comments.php"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_comments.php">Mes commentaires</a></li>
                  <li <?php if($page_name == "manage_users.php"): ?> class="active" <?php endif; ?>><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/management/manage_users.php">Utilisateurs</a></li>
               </ul>
            </div>

            <div class="h_search">
               <form>
                  <input type="text" value="" placeholder="Rechercher...">
                  <input type="submit" value="">
               </form>
            </div>
            <div class="clear"> </div>
         </div>
      </div>
   </div>

<?php else: ?>

   <!-- start header -->
   <div class="header_btm">
      <div class="wrap">
         <!-- Menu pour res < 768px -->
         <div id="page">
            <div id="header">
               <a class="navicon" href="#menu-left"> </a>
            </div>
            <nav id="menu-left">
               <ul>
                  <li <?php if($page_name == "index.php"): ?> class="mm-selected" <?php endif; ?>><a href="/">Accueil</a></li>
                  <li><a href="#">Les séries</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Calendrier</a></li>
                  <li><a href="#">Contact</a></li>
               </ul>
            </nav>
         </div>

         <!-- Menu pour res > 768px -->
         <div class="header_sub">

            <div class="h_menu">
               <ul>
                  <li <?php if($page_name == "index.php"): ?> class="active" <?php endif; ?>><a href="/">Accueil</a></li>
                  <li><a href="#">Les séries</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Calendrier</a></li>
                  <li><a href="#">Contact</a></li>
               </ul>
            </div>

            <div class="h_search">
               <form>
                  <input type="text" value="" placeholder="Rechercher...">
                  <input type="submit" value="">
               </form>
            </div>
            <div class="clear"> </div>
         </div>
      </div>
   </div>

<?php endif; ?>
