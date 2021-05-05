window.onload=floatbox(); 


function floatbox()
	{
		var data = 0;
		
		$.ajax({
            url: "includes/complete.php", 
            type: "GET",      
            data: data,     
            cache: false,
            success: function (html) { 
			
			if (html == 1)
			{
				$('#success').html('');
		$.get("popupcontent.php",function(data){
		   $('#success').html(data);
		});
		return false;
			}
			else
			{
				//$('#popup_content').fadeOut('slow');
				$('#popup_content').html('');
			$.get("popupcontent.php",function(data){
		   $('#popup_content').html(data);
		  // $('#popup_content').fadeIn('slow');
		   
		});
		return false;
			}
			
				
				
            } 
		})

		
		
		
		
		
		
	};
	
	

//function add(id) {
//  window.open('includes/set_popup.php?id=' + id,'NewWin','toolbar=no,status=no,width=350,height=135');
//  window.onpagehide;
//}


//function remove(id) {
//  window.open('includes/remove_popup.php?id=' + id,'NewWin','toolbar=no,status=no,width=350,height=135');
//  window.onpagehide;
//}






function classAction(cid)
{
	$('.loading').fadeIn('slow');

	var data = "id=" + cid;
        $.ajax({
            url: "includes/choice.php", 
            type: "GET",      
            data: data,     
            cache: false,
            success: function (html) { 
			
				if (html == 1)
				{
					$('.loading').fadeOut('slow');
					floatbox();
				}
				else
				{
					//$('#unexpected_error').fadeIn('slow');
				}
				
				
			
				
				
            } 
		})
}



    
    floatingMenu.add('floatdiv',  
        {  
            // Represents distance from left or right browser window  
            // border depending upon property used. Only one should be  
            // specified.  
            // targetLeft: 0,  
            targetRight: 10,  
  
            // Represents distance from top or bottom browser window  
            // border depending upon property used. Only one should be  
            // specified.  
            targetTop: 10,  
            // targetBottom: 0,  
  
            // Uncomment one of those if you need centering on  
            // X- or Y- axis.  
            // centerX: true,  
            // centerY: true,  
  
            // Remove this one if you don't want snap effect  
            snap: true  
        });  