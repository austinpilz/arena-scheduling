// Copyright 2012 APM LLC //
 


$(document).ready(function() {
     
    
    $('#submit').click(function () {        
         
       
        var username = $('input[name=username]');

		var pass = $('input[name=pass]');
	
		if (username.val()=='') {
            username.addClass('hightlight');
            return false;
        } else username.removeClass('hightlight');
		if (pass.val()=='') {
            pass.addClass('hightlight');
            return false;
        } else pass.removeClass('hightlight');
   
         
        
       var data = 'username=' + username.val() + '&password=' + pass.val();
		$('.loading').fadeIn('slow');
		
		var u = document.getElementById('username'); 
		var p = document.getElementById('password');
		var s = document.getElementById('submit');
		
		
		u.disabled = true;
		p.disabled = true;
		s.disabled = true;
		
		
	
        $.ajax({
            url: "ajax/processlogin.php", 
            type: "GET",       
            data: data,     
            cache: false,
            success: function (html) {              
                if (html!=0) {                  
                   $('.done').fadeIn('slow');
				   document.location.href = "cookie.php?session=" + html;
                }
				else
				{
					
					$('.loading').fadeOut('slow');
				    $('.loginform').fadeIn('slow');
					$('.incorrect').fadeIn('slow');
					u.disabled = false;
					p.disabled = false;
					s.disabled = false;
					
				}
				
				
            }       
        });
        return false;
    }); 
}); 

