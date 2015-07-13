$(document).ready(function() {
    var page=0;
    paginationSerie();

    // Saisie automatique dans la recherche de séries de account/series
    $("#q").autocomplete({
        source: "/serie/ajaxSearchAllSeriesByName"
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
                $("#listeSerie").append(code_html);
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
        
    }

});
