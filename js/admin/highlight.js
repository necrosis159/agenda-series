$(document).ready(function() {
   // Appelle la fonction d'update d'une série
    $("#highlight_green").live('click', function() {
        var serie_id = $(this).attr('serie_id');
        $(this).replaceWith('<img style="cursor: pointer;" serie_id="' + serie_id + '" id="highlight_red" class="tab_icons" src="../images/highlight-red.png" title="Ne plus mettre en avant" alt="Désactiver" />');
        updateHighlightStatus(serie_id, 1);
    });

    // Appelle la fonction d'update d'une série
    $("#highlight_red").live('click', function() {
         var serie_id = $(this).attr('serie_id');
         $(this).replaceWith('<img style="cursor: pointer;" serie_id="' + serie_id + '" id="highlight_green" class="tab_icons" src="../images/highlight-green.png" title="Mettre en avant" alt="Activer" />');
         updateHighlightStatus(serie_id, 0);
    });

   function updateHighlightStatus(serie_id, valueHighlight) {
      $.ajax({
          type: 'GET', // envoi des données en GET ou POST
          url: '/admin/ajaxHighlightUpdateSerie', // url du fichier de traitement
          data: 'serie_id=' + serie_id + '&value=' + valueHighlight, // données à envoyer en  GET ou POST
          beforeSend: function() { // traitements JS à faire AVANT l'envoi
          },
          success: function(data) { // traitements JS à faire APRES le retour d'ajax_add_serie.php
            //  $('#series_follow').html(data);
            //  loadMore();
          }
      });
   }

   // Appelle la fonction d'update d'un commentaire
    $("#highlight_green_comment").live('click', function() {
        var comment_id = $(this).attr('comment_id');
        $(this).replaceWith('<img style="cursor: pointer;" comment_id="' + comment_id + '" id="highlight_red_comment" class="tab_icons" src="../images/highlight-red.png" title="Ne plus mettre en avant" alt="Désactiver" />');
        updateHighlightStatusComment(comment_id, 1);
    });

    // Appelle la fonction d'update d'une série
    $("#highlight_red_comment").live('click', function() {
         var comment_id = $(this).attr('comment_id');
         $(this).replaceWith('<img style="cursor: pointer;" comment_id="' + comment_id + '" id="highlight_green_comment" class="tab_icons" src="../images/highlight-green.png" title="Mettre en avant" alt="Activer" />');
         updateHighlightStatusComment(comment_id, 0);
    });

   function updateHighlightStatusComment(comment_id, valueHighlight) {
      $.ajax({
          type: 'GET', // envoi des données en GET ou POST
          url: '/admin/ajaxHighlightUpdateComment', // url du fichier de traitement
          data: 'comment_id=' + comment_id + '&value=' + valueHighlight, // données à envoyer en  GET ou POST
          beforeSend: function() { // traitements JS à faire AVANT l'envoi
          },
          success: function(data) { // traitements JS à faire APRES le retour d'ajax_add_serie.php
            //  $('#series_follow').html(data);
            //  loadMore();
          }
      });
   }
});
