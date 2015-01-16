$(document).ready(function() {
    function getBaseURL() {
        var url = location.href;
        var baseURL = url.substring(0, url.indexOf('/', 14));

        if (baseURL.indexOf('http://localhost') != -1) {
            var pathname = location.pathname;
            var index1 = url.indexOf(pathname);
            var index2 = url.indexOf("/", index1);
            var baseLocalUrl = url.substr(0, index2);

            return baseLocalUrl;
        }
        else {
            return baseURL;
        }
    }

    var racine = getBaseURL();
//    console.log(racine+"/register.php");

    if (location.href == racine + "register.php") {
        if ($("#erreurFormulaire").html() != "") {
            $("#erreurFormulaire").show();
            if ($("#erreurFormulaire").html().trim() == "Formulaire valide") {
                $("#erreurFormulaire").attr("style", "color:#4ACC83;");
            }
        }
    }

    $("#formulaire_inscription").submit(function() {
        window.location.reload();
    });

    $(".image_serie").hover(function() {
        console.log("yo");
    });


    // détection de la saisie dans le champ de recherche
    $('#q').keyup(function() {
        $field = $(this);
        $('#results').html(''); // on vide les resultats
        $('#ajax-loader').remove(); // on retire le loader
        var racine = location.href;
        console.log(racine);
        // on commence à traiter à partir du 2ème caractère saisie
        if ($field.val().length > 1) {
            // on envoie la valeur recherché en GET au fichier de traitement
            $.ajax({
                type: 'GET', // envoi des données en GET ou POST
                url: '../ajax/ajax-search.php', // url du fichier de traitement
                data: 'q=' + $(this).val(), // données à envoyer en  GET ou POST
                beforeSend: function() { // traitements JS à faire AVANT l'envoi
                    $field.after('<img src="../images/loader.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
                },
                success: function(data) { // traitements JS à faire APRES le retour d'ajax-search.php
                    $('#ajax-loader').remove(); // on enleve le loader
                    $('#results').html(data); // affichage des résultats dans le bloc
                }
            });
        }
    });



});