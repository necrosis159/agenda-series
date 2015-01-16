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
