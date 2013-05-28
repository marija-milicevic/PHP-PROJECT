$(function() {
  
  	
  		$( "#accordion" ).accordion({
  			active:false
  		});
  		$("#new_comment_wrraper").click(function(event){
  			event.preventDefault();
  			$("html, body").animate({ scrollTop: $(document).height() }, 1000);
  		});
        
  		$( "#new_comment_wrraper" ).accordion();
  		
  		$("button, input:submit, input:button").button();
  			
  				
});
