$(function() {
	 var page = 0;
    paginationSerie();

    $("#showMore").click(function() {
        paginationSerie();
    });

    function paginationSerie(){
		var id_episode=$('#id_episode').val();
        $.ajax({
            url: '/admin/search',
            type: 'POST',
            data: 'page=' + page + '&id_episode=' + id_episode,
            dataType : 'text',
            success : function(code_html, statut) {
                			$("#listeComment").append(code_html);
            			},
            error : function(resultat, statut, erreur) {
            			},
            complete : function(resultat, statut) {
            			}
        });
        page++;
    }
})
