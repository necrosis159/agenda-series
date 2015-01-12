if($("#erreurFormulaire").html() != "") {
	$("#erreurFormulaire").show();
}

$("#formulaire_inscription").submit(function(){
	window.location.reload();
});