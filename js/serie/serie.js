$(function() {
    $("#favorite").click(addSerieToUser);
  // Ajoute le suivi d'une série pour un utilisateur
  function addSerieToUser() {
    var serie_name = $("#title").html();
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
            type: 'GET', // envoi des données en GET ou POST
            url: '/account/ajaxAddSerieToUser', // url du fichier de traitement
            data: 'serie_name=' + serie_name, // données à envoyer en  GET ou POST
            beforeSend: function() { // traitements JS à faire AVANT l'envoi
        },
            success: function(data) { // traitements JS à faire APRES le retour d'ajax_add_serie.php
        }
    });
    }
});