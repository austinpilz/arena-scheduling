function processSchedule()
{
       var data = 'auth=1';
        
		$('.loading').fadeIn('slow');
		
        $.ajax({
         
            url: "ajax/process_schedule.php", 
            type: "GET",    
            data: data,     
            cache: false,
            success: function (html) {              
        
                if (html == 1) {           
				   $('.checkbox').attr('disabled','true');
                   $('.loading').fadeOut('slow');
				   $('.popup_content').fadeOut('fast');
				   
				   $('.success').fadeIn('slow');
                     
         
                }
				else
				{
					$('.loading').fadeOut('slow');
					$('.popup_content').fadeOut('fast');
				    $('.tryagain').fadeIn('slow');
					
					
				}
				
				
            } 
			      
        });
         
        //cancel the submit button default behaviours
        return false;
	}