// Chargement des lignes supplémentaire : v1.0 Souple - Ludo
$(document).ready(function () {
   // On masque les résultats
   $("#result_table tr").hide();

   // On récupère le total de lignes
   total = $("#result_table tr").size();

   // On choisi combien on souhaite en afficher de base
   x = 5;
   totalStart = 5;

   // On affiche le nombre lignes de base entré en paramètre précédemment
   $('#result_table tr:lt(' + x + ')').show();

   // Fonction pour afficher les lignes supplémentaires
   $('#loadMore').click(function () {
     x = (x + 5 <= total) ? x + 5 : total;
     $('#result_table tr:lt(' + x + ')').show();

     // On incrémente le nombre des valeurs affichées
     totalStart += 5;

     // Quand on a atteint ou dépassé le nombre total de valeur à afficher on masque le bouton de chargement
     if(totalStart >= total) {
        $('#loadMore').hide();
     }
   });
});
