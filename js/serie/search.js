$(document).ready(function() {
    var page=0;
    paginationSerie();

    // Saisie automatique dans la recherche de séries de account/series
    $("#q").autocomplete({
        source: "/serie/ajaxSearchAllSeriesByName",
        minLength : 3
    });


    $("#results").on('click', '.serie_add', function() {
        $("#q").val($(this).html()); // Ajout le nom de la série dans le champ de recherche
        $("#results").hide(); // cache la liste des résultats de la recherche
    });

// Appel la fonction ajax qui redirige vers la serie
    $('#serie_button').click(function() {
        if ($('#q').val().trim() != '') {
            redirSerie();
        }
    });

    $("#showMore").click(function(){
        paginationSerie();
    });

    function paginationSerie(){
        $.ajax({
            url:'/serie/page',
            type:'POST',
            data:'page='+page,
            dataType : 'text',
            success : function(code_html, statut){
                if(code_html!="")
                {
                $("#listeSerie").append(code_html);
                }   
                else
                {
                    $("#showMore").fadeOut(500);
                }
            },
            error : function(resultat, statut, erreur){
            },
            complete : function(resultat, statut){

            }
        });
        page+=1;
    }
    
    //redirige vers la serie
    function redirSerie(){
        var serie_name = $("#q").val();
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
            type: 'GET', // envoi des données en GET ou POST
            url: '/serie/ajaxRedirectionSerie', // url du fichier de traitement
            data: 'serie_name=' + serie_name, // données à envoyer en  GET ou POST
            beforeSend: function() { // traitements JS à faire AVANT l'envoi
            },
            success: function(data) { // traitements JS à faire APRES le retour d'ajax_add_serie.php
                window.location="/serie/"+data;
            }
        });
    }

});
