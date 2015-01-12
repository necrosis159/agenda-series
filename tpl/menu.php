<?php

   $folder = dirname($_SERVER['PHP_SELF']);

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
               <li><a href="/">Agenda-série.fr</a></li>
               <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/account.php">Compte</a></li>
               <li><a href="#">Favoris</a></li>
               <li><a href="#">Connexion</a></li>
            </ul>
         </nav>
      </div>

      <!-- Menu pour res > 768px -->
      <div class="header_sub">

         <div class="th_menu">
            <ul>
               <?php
               if($id != 0) {
               ?>
                  <li><a href="/">Agenda-série.fr</a></li>
                  <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/account/index.php">Compte</a></li>
                  <li><a href="#">Administration</a></li>
                  <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/logout.php">Déconnexion</a></li>
               <?php
               } else {
               ?>
               <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/connection.php">Connexion</a></li>
               <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/register.php">Inscription</a></li>
               <?php } ?>
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
               <li class="mm-selected"><a href="#">Mon profil</a></li>
               <li><a href="#">Mes séries</a></li>
               <li><a href="#">Mon calendrier</a></li>
               <li><a href="#">Mes informations</a></li>
            </ul>
         </nav>
      </div>

      <!-- Menu pour res > 768px -->
      <div class="header_sub">

         <div class="h_menu">
            <ul>
               <li class="active"><a href="#">Mon profil</a></li>
               <li><a href="#">Mes séries</a></li>
               <li><a href="#">Mon calendrier</a></li>
               <li><a href="#">Mes informations</a></li>
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

<?php elseif($folder == "/manage"): ?>

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
                  <li class="mm-selected"><a href="/">Accueil</a></li>
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
                  <li class="active"><a href="/">Accueil</a></li>
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
                  <li class="mm-selected"><a href="/">Accueil</a></li>
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
                  <li class="active"><a href="/">Accueil</a></li>
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
