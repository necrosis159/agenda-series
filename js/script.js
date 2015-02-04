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

//    $("#formulaire_inscription").submit(function() {
//        window.location.reload();
//    });

  /********************************************************
   * 
   *                ACCOUNT
   * 
   ********************************************************/

  // détection de la saisie dans le champ de recherche
  $('#q').keyup(function() {
    $field = $(this);
    $('#results').html(''); // on vide les resultats
    $('#ajax-loader').remove(); // on retire le loader
    var racine = location.href;
    // on commence à traiter à partir du 2ème caractère saisie
    if ($field.val().length > 0) {
      // on envoie la valeur recherché en GET au fichier de traitement
      $.ajax({
        type: 'GET', // envoi des données en GET ou POST
        url: '../ajax/ajax_search.php', // url du fichier de traitement
        data: 'q=' + $(this).val(), // données à envoyer en  GET ou POST
        beforeSend: function() { // traitements JS à faire AVANT l'envoi
//                    $field.after('<img src="../images/loader.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
        },
        success: function(data) { // traitements JS à faire APRES le retour d'ajax-search.php
          $('#ajax-loader').remove(); // on enleve le loader
          $('#results').show();
          $('#results').html(data); // affichage des résultats dans le bloc
        }
      });
    } else {
      $('#results').hide();
    }
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
    var serie = $("#q").val();
    // on envoie la valeur recherché en GET au fichier de traitement
    $.ajax({
      type: 'GET', // envoi des données en GET ou POST
      url: '../ajax/ajax_add_serie.php', // url du fichier de traitement
      data: 'serie=' + serie, // données à envoyer en  GET ou POST
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
  
    // Permet de scroller jusqu'au bloc désiré
    $('#yo').click(function(){
        var offset = $('#last_comments').offset();
        $('html,body').animate({scrollTop: offset.top}, 1000);
        return false;
    });

  /********************************************************
   * 
   *                SERIES
   * 
   ********************************************************/


    // détection de la saisie dans le champ de recherche
    $('#rechercheSerie').keyup(function(){
    $field = $(this);
    $('#resultsSeries').html(''); // on vide les resultats
    $('#ajax-loader').remove(); // on retire le loader
 
    // on commence à traiter à partir du 2ème caractère saisie
    if( $field.val().length > 0 ) {
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
                type : 'GET', // envoi des données en GET ou POST
                url : '/ajax/ajax-search_series.php' , // url du fichier de traitement
                data : 'q='+$(this).val() , // données à envoyer en  GET ou POST
                beforeSend : function() { // traitements JS à faire AVANT l'envoi
                    $field.after('<img src="../images/loader.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
                },
                success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
                    $('#ajax-loader').remove(); // on enleve le loader
                    $('#resultsSeries').html(data); // affichage des résultats dans le bloc
                    }
        });
    }
    else{
        $('#resultsSeries').html("Vous n'avez rien rechercher!");
    }       
});


// détection de la saisie dans le champ de recherche
    $('#send_comment').click(function(){
    $field = $('#comment');
    $('#results').html(''); // on vide les resultats
    $('#ajax-loader').remove(); // on retire le loader
 
    // on commence à traiter à partir du 2ème caractère saisie
    if( $field.val().length > 0 ) {
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
                type : 'GET', // envoi des données en GET ou POST
                url : '/ajax/ajax-comment.php' , // url du fichier de traitement
                data : 'q='+$field.val() , // données à envoyer en  GET ou POST
                beforeSend : function() { // traitements JS à faire AVANT l'envoi
                    $("#send_comment").remove();
                    $field.after('<img src="../images/loader.gif" alt="loader" id="test" />'); // ajout d'un loader pour signifier l'action
                },
                success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
                    $('#test').remove(); // on enleve le loader
                    $('#commentZone').html("Merci!"); // affichage des résultats dans le bloc
                    }                
        });
    }    
});

// détection de la saisie dans le champ de recherche
    $('#favorite').click(function(){
    $field = $('#favorite');
    $('#results').html(''); // on vide les resultats
    $('#ajax-loader').remove(); // on retire le loader
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
                type : 'GET', // envoi des données en GET ou POST
                url : '/ajax/ajax-favorite.php' , // url du fichier de traitement
                data : 'q='+$(this).val() , // données à envoyer en  GET ou POST
                beforeSend : function() { // traitements JS à faire AVANT l'envoi
                    $("#send_comment").remove();
                    $field.after('<img src="../images/loader.gif" alt="loader" id="test" />'); // ajout d'un loader pour signifier l'action
                },
                success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
                    $('#test').remove(); // on enleve le loader
                    $('#results').html("<img style='width: 46px;' src='../images/ok.png' />"); // affichage des résultats dans le bloc
                    }
                
        });
        
});

/*FIN SERIE*/

});