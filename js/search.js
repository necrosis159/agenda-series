$(function(){
	$('#search_submit').click(submit);

	function submit(){
		var search=$('#search').val();

		$.ajax({
			url:'/serie/search',
			type:'POST',
			data:'search='+search,
			dataType : 'text',
			success : function(code_html, statut){
				alert(code_html);
				$('#search_result').append(code_html);
			},
			error : function(resultat, statut, erreur){
		   	},
		   	complete : function(resultat, statut){

		   	}
		});
	}
})