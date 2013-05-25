$(function() {
  
  	
  		$( "#accordion" ).accordion({
  			active:false
  		});
  		$("#new_comment_wrraper").click(function(event){
  			event.preventDefault();
  			$("html, body").animate({ scrollTop: $(document).height() }, 1000);
  		});
  
        if( jQuery.isEmptyObject(comments)){
        	$("#comm_wrrap").hide();
        }
        
  		$( "#new_comment_wrraper" ).accordion();
  		$( "#button" ).button();
  		$('div#info').hide();
  		
  		
  		$("#button").click(function(event){
         	event.preventDefault();
         	var author = $('#author').val();
         	var comment = $('#comment').val();
         	var view_id = $('#post_id').val();
         	if(!author)
         	   setInfo('notice','Please insert your name!');
         	else if(!comment || comment=="Add a new comment...")
         	   setInfo('notice',"Please insert your comment!")
            else{
            	$.ajax({
  				type: 'POST',
  				dataType: "json",
  				url: base_url+'index.php/filmview_control/addComment',
  				data: { commentText: comment, friendID:friendID, viewID:view_id},
  				/*beforeSend:function(){
   				//$('#numLikes').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
  				},*/
  				success:function(data){
  					$("#accordion1").append("<h3>"+data.author+"<small class='comm_time'>["+data.date+"]</small></h3><div class='comment_wrrap'><p>"+data.text+"</p><div class='likeWrraper'><div class='comm_likes'><input type='hidden' class='comment_id' value="+data.id+"><a href='#' title='Like' class='likeComment'>Like it</a></div><div class='num_likes'><b>"+data.likes+"</b> likes</div></div></div>")
  					.accordion('destroy').accordion({
  						active:false
  					});
  					$("#comm_wrrap").show();
  					$("#comment").val('');
  					$("select#friends_combobox").val("Select...");

  				},
  				error:function(){
  					setInfo('error',"Try again in a few moments!");
  				}
			});
            	
            }
		});
  		
});
function setbg(color)
{
document.getElementById("comment").style.background=color
}
function setInfo(type, message){
	$("div#info div strong").empty();
  	$("div#info div span").empty();
    $("div#info div").attr('class','ui-state-'+type+' ui-corner-all');
    $("div#info div p span").attr('class','ui-icon ui-icon-'+type);
  	$("div#info div strong").append(message);
  	$('div#info').show();
}