

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

		var name = $('input[name=name]');
	
		var room = $('input[name=room]');
		
		var inst= $('input[name=inst]');
		
		var maxoc = $('input[name=maxoc]');
		
		var desc = $('textarea[name=desc]');
		
		
	
 
        //Simple validation to make sure user entered something
        //If error found, add hightlight class to the text field
       
        
		
		if (name.val()=='') {
            name.addClass('hightlight');
            return false;
        } else name.removeClass('hightlight');
		
		if (room.val()=='') {
            room.addClass('hightlight');
            return false;
        } else room.removeClass('hightlight');
		
		if (inst.val()=='') {
            inst.addClass('hightlight');
            return false;
        } else inst.removeClass('hightlight');
		
		if (maxoc.val()=='') {
           maxoc.addClass('hightlight');
            return false;
        } else maxoc.removeClass('hightlight');
		
		if (maxoc.val()=='0') {
           maxoc.addClass('hightlight');
		    $('.maxocmin').fadeIn('slow');
            return false;
        } else maxoc.removeClass('hightlight');
		
		if (desc.val()=='') {
            desc.addClass('hightlight');
            return false;
        } else desc.removeClass('hightlight');
		
		var data = 'cid=' + id.val() + '&name=' + name.val() + '&room=' + room.val() + '&inst=' + inst.val() + '&maxoc=' + maxoc.val() + '&desc=' + desc.val() + '&fsi=876545653474747';
		
			
        //disabled all the text fields
        //$('.text').attr('disabled','true');
         
        //show the loading sign
		
        
		$('.loading').fadeIn('slow');
		
		
		
	
        //start the ajax
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "ajax_updatecourse.php", 
             
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
				
				if (html == 985)
				{
					maxoc.addClass('hightlight');
				 	$('.maxocerror').fadeIn('slow');
				}
				
				
				
				
            } 
			      
        });
         
        //cancel the submit button default behaviours
        return false;
    }); 
}); 


function testremove(uid, cid, session)
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
				   $('.user' + uid).fadeOut('slow');
                     
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

function makeActive(cid)
{
	var data = "cid=" + cid+ "&action=1";
        //disabled all the text fields
        //$('.text').attr('disabled','true');
		//$('.loading').fadeIn('slow');
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "ajax_coursestatus.php", 
             
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

function makeInActive(cid)
{
	var data = "cid=" + cid + "&action=0";
        //disabled all the text fields
        //$('.text').attr('disabled','true');
		//$('.loading').fadeIn('slow');
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "ajax_coursestatus.php", 
             
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

function deleteCourse(cid)
{
	var data = "cid=" + cid + "&afid=7729475629726386";
        //disabled all the text fields
        //$('.text').attr('disabled','true');
		//$('.loading').fadeIn('slow');
        $.ajax({
            //this is the php file that processes the data and send mail
            url: "ajax_deletecourse.php", 
             
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
				
				if (html == 442)
				{
					$('.sae').fadeIn('slow');
					
				}
				
				if (html = 999)
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

