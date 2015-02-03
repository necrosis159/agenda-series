         <div class="footer">
            <div class="wrap">
               <div class="footer-left">
                  <h3>A propos</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                  <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                  <div class="detail">
                     <ul>
                        <li><a href="#">Rejoignez-nous sur les réseaux sociaux</a></li>
                        <div class="clear"> </div>
                     </ul>
                  </div>
                  <div class="soc_icons soc_icons1">
                     <ul>
                        <li><a class="icon1" href="#"> </a> </li>
                        <li><a class="icon2" href="#"> </a></li>
                        <li><a class="icon3" href="#"> </a></li>
                        <div class="clear"> </div>
                     </ul>

                  </div>
               </div>
               <div class="footer-right">
                  <h3>Derniers Twitts</h3>
                  <div class="comments1">
                     <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident. consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                     <span>~ Il y a 15 minutes</span>
                  </div>
                  <div class="comments1">
                     <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                     <span>~ Il y a 2 jours</span>
                  </div>
               </div>
               <div class="clear"> </div>
            </div>
         </div>
         <div class="copy">
            <p>© 2014 Tous droits réservés - <a href="http://agenda-serie.fr">Agenda-serie.fr</a></p>
         </div>
      </div>

      <script>
      // Configuration des ID du menu et du point du rupture
      var maxBreakpoint = 768; // Point de rupture max
      var navID = 'navigation'; // ID du menu responsive
      var buttonID = 'toggle-nav'; // ID du bouton de défilement du menu

      // On récupère le menu via son ID
      var n = document.getElementById(navID);

      // On l'initialise en état fermé
      n.classList.add('is-closed');

      // Fonction d'affichage et de fermeture du menu
      function navi() {
         // Affichage du bouton de défilement lors du passage en petite résolution
         // MatchMedia() permet de définir un point de rupture du côté JS, ici je le calcule grâce au maxBreakpoint définit
         if (window.matchMedia("(max-width:" + maxBreakpoint +"px)").matches && document.getElementById(buttonID) == undefined) {
            n.insertAdjacentHTML('afterBegin','<button id=' + buttonID + ' title="open/close navigation"></button>');
            t = document.getElementById(buttonID);
            t.onclick=function(){ n.classList.toggle('is-closed');}
         }
         // On repasse sur la résolution de grand écran et masque le bouton
         // On initialise le point de rupture minimum
         var minBreakpoint = maxBreakpoint + 1;
         if (window.matchMedia("(min-width: " + minBreakpoint +"px)").matches && document.getElementById(buttonID)) {
            // Si ce point est dépassé on masque le bouton
            document.getElementById(buttonID).outerHTML = "";
         }
      }

      navi();

      // Lorsque l'évènement de redimmensionnement est appelé on relance la fonction pour modifier le menu en conséquence
      window.addEventListener('resize', navi);
      </script>
   </body>
</html>
