$(function(){
    var page=0;
    paginationComment();

    $('#submit_comment').click(submit);

    function submit(){
        var id_episode=$('#id_episode').val();
        var content_comment=$('#content_comment').val();
        if(content_comment!=""){
            //Condition de sécurité
            $.ajax({
    			url:'/serie/comment',
    			type:'POST',
    			data:'id_episode='+id_episode+'&content_comment='+content_comment,
    			dataType : 'text',
    			success : function(code_html, statut){
                    window.location=window.location.href;
                },
                error : function(resultat, statut, erreur){
                },
                complete : function(resultat, statut){

            }
        });
    }
}

$("#listeComment").on('click', 'a', signaler);

    function signaler() {
        $.ajax({
            url:'/serie/commentSignal',
            type:'POST',
            data:'comment_id='+$(this).data('id'),
            dataType : 'text',
            success : function(code_html, statut){
            },
            error : function(resultat, statut, erreur){
            },
            complete : function(resultat, statut){
            }
        });
    }

$("#showMore").click(paginationComment);
    function paginationComment(){
        var id_episode=$('#id_episode').val();
        var listeComment=$('#listeComment').html();
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
                listeComment=$('#listeComment').html();
                if(listeComment=="")
                    $("#containerComment").remove();
                },
            error : function(resultat, statut, erreur){
            },
            complete : function(resultat, statut){
            }
        });
        page+=1;
    }
});