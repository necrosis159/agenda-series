$(document).ready(function() {
    
    // Saisie automatique dans la recherche de séries de account/series
    $("#q").autocomplete({
        source: "ajaxSearchSeriesByName"
    });


    $("#results").on('click', '.serie_add', function() {
        $("#q").val($(this).html()); // Ajout le nom de la série dans le champ de recherche
        $("#results").hide(); // cache la liste des résultats de la recherche
    });

// Appel la fonction ajax qui ajoute la série dans la bdd
    $('#add_serie_button').click(function() {
        if ($('#q').val().trim() != '') {
            addSerieToUser();
        }
    });

// Ajoute le suivi d'une série pour un utilisateur
    function addSerieToUser() {
        var serie_name = $("#q").val();
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
            type: 'GET', // envoi des données en GET ou POST
            url: 'ajaxAddSerieToUser', // url du fichier de traitement
            data: 'serie_name=' + serie_name, // données à envoyer en  GET ou POST
            beforeSend: function() { // traitements JS à faire AVANT l'envoi
            },
            success: function(data) { // traitements JS à faire APRES le retour d'ajax_add_serie.php
                $('#q').val('');
                $('#series_follow').html(data);
            }
        });
    }

// Appelle la fonction de suppression d'une série suivi
    $('#series_follow').on('click', '.serie_delete', function() {
        var serie_id = $(this).attr('serie_id');
        deleteSerieFollow(serie_id);
    });

// Suprime une série suivi par l'utilisateur
    function deleteSerieFollow(serie_id) {
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
            type: 'GET', // envoi des données en GET ou POST
            url: '../ajax/ajax_delete_serie.php', // url du fichier de traitement
            data: 'serie_id=' + serie_id, // données à envoyer en  GET ou POST
            beforeSend: function() { // traitements JS à faire AVANT l'envoi
            },
            success: function(data) { // traitements JS à faire APRES le retour d'ajax_add_serie.php
                $('#series_follow').html(data);
            }
        });
    }

    $('#avatar_modify').click(function() {
        var ancre = $("#create_logo");
        $(ancre).slideToggle(400, function() {
            if ($(ancre).css('display') === 'block') {
                $('html, body').animate({
                    scrollTop: $('#profile_bloc').offset().top
                }, 'slow');
            } else {
                $('html, body').animate({
                    scrollTop: $('.header_bg').offset().top
                }, 'slow');
            }
        });
        return false;
    });

    $('#show_text_options').click(function() {
        $('#font_bloc').slideToggle(200, function() {
            $('html, body').animate({
                scrollTop: $('#create_logo').offset().top
            }, 'slow');
        });
        $('#create_logo_ou').slideToggle();
    });

// Permet de scroller jusqu'au bloc désiré
    $('#yo').click(function() {
        var offset = $('#last_comments').offset();
        $('html,body').animate({scrollTop: offset.top}, 1000);
        return false;
    });

//    if(location.href === getBaseURL()+'/account/index.php') {
//      if($('#create_logo textarea').val() !== "") {
//        $('#create_logo').show();
//        $('html, body').animate({
//          scrollTop:$('#create_logo').offset().top
//        }, 'slow');
//      }
//    }

    if (typeof ($('#erreurFormulaire')) !== 'undefined' && $.trim($('#erreurFormulaire').html()) !== "") {
        $('#erreurFormulaire').show();
    }
});
