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
               <li class="mm-selected"><a href="#">Compte</a></li>
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
                  <li class="active"><a href="account.php">Compte</a></li>
                  <li><a href="#">Favoris</a></li>
                  <li><a href="./logout.php">Déconnexion</a></li>
               <?php 
               } else {
               ?> 
               <li><a href="./connection.php">Connexion</a></li>
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
            <a href="index.php">
               <img src="images/home.jpg" alt=""/>
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
               <li class="mm-selected"><a href="#">Accueil</a></li>
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
               <li class="active"><a href="#">Accueil</a></li>
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
