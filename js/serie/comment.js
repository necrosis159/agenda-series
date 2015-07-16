$(function(){
	var page=0;
    paginationSerie();

	$('#submit_comment').click(submit);

	function submit(){
		var id_session =$('#id_user').val();;
		var id_episode=$('#id_episode').val();
		var title_comment= $('#title').val();
		var content_comment=$('#content_comment').val();
		alert(title_comment+" "+content_comment+" "+id_episode+" "+id_user);
		//Condition de sécurité
		$.ajax({
			url:'/serie/comment',
			type:'POST',
			data:'id_session='+id_session+'&id_episode='+id_episode+'&title_comment='+title_comment+'&content_comment='+content_comment,
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

    $("#showMore").click(function(){
        paginationSerie();
    });

    function paginationSerie(){
		var id_episode=$('#id_episode').val();
        $.ajax({
            url:'/serie/commentShow',
            type:'POST',
            data:'page='+page+'&id_episode='+id_episode,
            dataType : 'text',
            success : function(code_html, statut){
                $("#listeComment").append(code_html);
            },
            error : function(resultat, statut, erreur){
            },
            complete : function(resultat, statut){

            }
        });
        page+=1;
    }
})