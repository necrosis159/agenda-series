<body>

   <div>
      <header class="wrapper clearfix">
         <nav>
            <p class="logo"><a href="./index.php">Agenda Série</a></p>
            <ul>
               <li><a href="#">Séries</a></li>
               <li><a href="#">Episodes</a></li>
               <?php
                  if($id == 0) {
                     echo "<li><a href='./connection.php'>Connexion</a></li>";
                     echo "<li><a href='./register.php'>Inscription</a></li>";
                  } else {
                     echo "<li><a href='./account.php'>Mon compte</a></li>";
                     echo "<li><a href='./logout.php'>Déconnexion</a></li>";
                  }
               ?>
               
               
            </ul>
         </nav>
      </header>
   </div>
