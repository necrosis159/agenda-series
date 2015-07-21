$(document).ready(function(){

    // Saisie automatique dans la recherche de séries de account/series
   $("#global_search").autocomplete({
        source: "/serie/ajaxSearchAllSeriesByName",
        minLength : 3
    });


    $("#results").on('click', '.serie_add', function() {
        $("#global_search").val($(this).html()); // Ajout le nom de la série dans le champ de recherche
        $("#results").hide(); // cache la liste des résultats de la recherche
    });

    // Appel la fonction ajax global_searchui redirige vers la serie
    $('#global_search_submit').click(function() {
        if ($('#global_search').val().trim() != '') {
            redirSerie();
        }
    });

    //redirige vers la serie
    function redirSerie(){
        var serie_name = $("#global_search").val();
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
            type: 'GET', // envoi des données en GET ou POST
            url: '/serie/ajaxRedirectionSerie', // url du fichier de traitement
            data: 'serie_name=' + serie_name, // données à envoyer en  GET ou POST
            beforeSend: function() { // traitements JS à faire AVANT l'envoi
            },
            success: function(data) { // traitements JS à faire APRES le retour d'ajax_add_serie.php
                if(data!="")window.location="/serie/"+data;
            }
        });
    }
});