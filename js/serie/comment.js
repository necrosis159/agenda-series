$(function(){
	var page=0;
    paginationSerie();

	$('#submit_comment').click(submit);

	function submit(){
		var id_episode=$('#id_episode').val();
		var content_comment=$('#content_comment').val();
		//Condition de sécurité
		$.ajax({
			url:'/serie/comment',
			type:'POST',
			data:'id_episode='+id_episode+'&content_comment='+content_comment,
			dataType : 'text',
			success : function(code_html, statut){
				if(code_html!="")
					alert(code_html);
			},
			error : function(resultat, statut, erreur){
		   	},
		   	complete : function(resultat, statut){

		   	}
		});
	}

    $("#showMore").click(paginationSerie);

    function paginationSerie(){
		var id_episode=$('#id_episode').val();
        $.ajax({
            url:'/serie/commentShow',
            type:'POST',
            data:'page='+page+'&id_episode='+id_episode,
            dataType : 'text',
            success : function(code_html, statut){
            	if(code_html!="<ul class='list_comment'></ul>")
            	{
                	$("#listeComment").append(code_html);
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
})