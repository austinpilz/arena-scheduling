

function remove(uid, cid, session) {
  window.open('unenroll_popup.php?uid=' + uid + "&cid=" + cid + "&session=" + session,'NewWin','toolbar=no,status=no,width=350,height=135');
  window.onpagehide;
}

$(document).ready(function() {
     
    //if submit button is clicked
    $('#submit').click(function () {        
         
        //Get the data from all the field
        

		
        //organize the data properly
        var id = $('input[name=id]');

		var fname = $('input[name=fname]');
		
		var lname = $('input[name=lname]');
	
		var email = $('input[name=email]');
		
		var username = $('input[name=username]');
		
	
 
        //Simple validation to make sure user entered something
        //If error found, add hightlight class to the text field
       
        
		
		if (fname.val()=='') {
            fname.addClass('hightlight');
            return false;
        } else fname.removeClass('hightlight');
		
		if (lname.val()=='') {
            lname.addClass('hightlight');
            return false;
        } else lname.removeClass('hightlight');
		
		if (email.val()=='') {
            email.addClass('hightlight');
            return false;
        } else email.removeClass('hightlight');
		
		if (username.val()=='') {
            username.addClass('hightlight');
            return false;
        } else username.removeClass('hightlight');
		
		
		
		var data = 'id=' + id.val() + '&fname=' + fname.val() + '&lname=' + lname.val() + '&email=' + email.val() + '&username=' + username.val();
		
			
        //disabled all the text fields
        //$('.text').attr('disabled','true');
         
        //show the loading sign
		
        
		$('.loading').fadeIn('slow');
		
		
		
	
        //start the ajax
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "ajax_updatestudent.php", 
             
            //GET method is used
            type: "GET",
 
            //pass the data         
            data: data,     
             
            //Do not cache the page
            cache: false,
             
            //success
            success: function (html) {              
                //if process.php returned 1/true (send mail success)
                if (html == 1) {           
				    $('.rtcm').fadeOut('slow');    
                   	$('.maincontent').fadeIn('slow'); 
					$('.updatedone').fadeIn('slow'); 
  					$('.modifyform').fadeOut('slow');
                     
                //if process.php returned 0/false (send mail failed)
                }
				
				if (html == 0)
				{
					
					$('.rtcm').fadeOut('slow');    
                   	$('.maincontent').fadeIn('slow'); 
					$('.updateerror').fadeIn('slow'); 
  					$('.modifyform').fadeOut('slow');
					
					//$('.loading').fadeOut('slow');
					//$('.popup_content').fadeOut('fast');
				    //$('.tryagain').fadeIn('slow');
				}
				
				
				
				
				
            } 
			      
        });
         
        //cancel the submit button default behaviours
        return false;
    }); 
}); 


function removeUser(uid, cid, session)
{
	var data = 'uid=' + uid + "&cid=" + cid + "&session=" + session;
        //disabled all the text fields
        //$('.text').attr('disabled','true');
         
        //show the loading sign
		
        
		//$('.loading').fadeIn('slow');
		
		
		
	
        //start the ajax
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "ajax_removeclass.php", 
             
            //GET method is used
            type: "GET",
 
            //pass the data         
            data: data,     
             
            //Do not cache the page
            cache: false,
             
            //success
            success: function (html) {              
                //if process.php returned 1/true (send mail success)
                if (html == 1) {           
				   $('.s1').fadeOut('slow');
                     
                //if process.php returned 0/false (send mail failed)
                }
				else
				{
					alert(":(");
					//$('.loading').fadeOut('slow');
					//$('.popup_content').fadeOut('fast');
				    //$('.tryagain').fadeIn('slow');
					
					
				}
				
				
            } 
		})
}

function updateStatus(uid, action)
{
	var data = "uid=" + uid + "&action=" + action;
        //disabled all the text fields
        //$('.text').attr('disabled','true');
		//$('.loading').fadeIn('slow');
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "ajax_studentstatus.php", 
             
            //GET method is used
            type: "GET",
 
            //pass the data         
            data: data,     
             
            //Do not cache the page
            cache: false,
             
            //success
            success: function (html) {              
                //if process.php returned 1/true (send mail success)
                if (html == 1) {      
				   $('.inactive').fadeOut('slow');    
				   $('.statusupdate').fadeIn('slow');
				  
                     
                //if process.php returned 0/false (send mail failed)
                }
				else
				{
					alert("An unexpected error occured..");
					
				}
				
				
            } 
		})
}


function deleteStudent(uid)
{
	var data = "uid=" + uid + "&afid=7729475629726386";
        //disabled all the text fields
        //$('.text').attr('disabled','true');
		//$('.loading').fadeIn('slow');
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "ajax_deletestudent.php", 
             
            //GET method is used
            type: "GET",
 
            //pass the data         
            data: data,     
             
            //Do not cache the page
            cache: false,
             
            //success
            success: function (html) {              
                //if process.php returned 1/true (send mail success)
                if (html == 1) {      
				   //$('.inactive').fadeOut('slow');    
				   //$('.statusupdate').fadeIn('slow');
				   alert("removed");
				  
                     
                //if process.php returned 0/false (send mail failed)
                }
				
				
				
				if (html != 1)
				{
					$('.unauthorized').fadeIn('slow');
				}
				
				
            } 
		})
}

<!--
function showUpdateForm ()
{	
  $('.maincontent').fadeOut('slow'); 
  $('.rtcm').fadeIn('slow'); 
  $('.modifyform').fadeIn('slow');   
}
-->
function returnMain ()
{	
 $('.rtcm').fadeOut('slow'); 
  $('.maincontent').fadeIn('slow'); 
 
  $('.modifyform').fadeOut('slow');   
}

