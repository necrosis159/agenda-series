$(function(){
	$('#submit_comment').click(submit);

	function submit(){
		//var id_session=<?php echo json_encode($_SESSION['id']) ?>;
		var id_session = 1;
		var id_episode=$('#id_episode').val();
		var title_comment=$('#title_comment').val();
		var content_comment=$('#content_comment').val();

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
})