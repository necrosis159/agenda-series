$(document).ready(function() {

    // Saisie automatique dans la recherche de séries de account/series
    $("#q").autocomplete({
        source: "/account/ajaxSearchSeriesByName",
        minLength: 3
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

    $('#q').keyup(function(e) {
        if (e.keyCode == 13) { // KeyCode de la touche entrée
            addSerieToUser();
        }
    });

// Ajoute le suivi d'une série pour un utilisateur
    function addSerieToUser() {
        var serie_name = $("#q").val();
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
            type: 'GET', // envoi des données en GET ou POST
            url: '/account/ajaxAddSerieToUser', // url du fichier de traitement
            data: 'serie_name=' + serie_name, // données à envoyer en  GET ou POST
            beforeSend: function() { // traitements JS à faire AVANT l'envoi
            },
            success: function(data) { // traitements JS à faire APRES le retour d'ajax_add_serie.php
                $('#q').val('');
                $('#series_follow').html(data);
                loadMore();
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
            url: '/account/ajaxDeleteSerieUser', // url du fichier de traitement
            data: 'serie_id=' + serie_id, // données à envoyer en  GET ou POST
            beforeSend: function() { // traitements JS à faire AVANT l'envoi
            },
            success: function(data) { // traitements JS à faire APRES le retour d'ajax_add_serie.php
                $('#series_follow').html(data);
                loadMore();
            }
        });
    }

    $('#avatar_modify').click(function() {
        var ancre = $("#create_logo");
        $(ancre).slideToggle(400, function() {
            if ($(ancre).css('display') === 'block') {
                $('html, body').animate({
                    scrollTop: $('#create_logo').offset().top
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
    $('#image_text').click(function() {
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

    // LOAD MORE

    function loadMore() {
        // On masque les résultats
        $("#series_list li").hide();
        // On récupère le total de lignes
        total = $("#series_list li").size();

        // On choisi combien on souhaite en afficher de base
        x = 5;
        totalStart = 5;

        // On affiche le nombre lignes de base entré en paramètre précédemment
        $('#series_list li:lt(' + x + ')').show();

        // Fonction pour afficher les lignes supplémentaires
        $('#loadMore').click(function() {
            x = (x + 5 <= total) ? x + 5 : total;
            $('#series_list li:lt(' + x + ')').show();

            // On incrémente le nombre des valeurs affichées
            totalStart += 5;

            // Quand on a atteint ou dépassé le nombre total de valeur à afficher on masque le bouton de chargement
            if (totalStart >= total) {
                $('#loadMore').hide();
            }
        });
    }
    
    loadMore();
});
