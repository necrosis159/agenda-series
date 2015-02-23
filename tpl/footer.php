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
                        <li>Rejoignez-nous sur Facebook !</li></br>
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
