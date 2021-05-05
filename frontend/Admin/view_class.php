<style type="text/css">
/*body { font: 12px Tahoma, Geneva, sans-serif; } */

/* panel */
.panel, .panelcollapsed 
{
	background: #eee;
	margin: 5px;
	padding: 0px 0px 5px;
	
	border: 1px solid #999;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
}

/* panel heading */
.panel h2, .panelcollapsed h2 
{
	font-size: 18px;
	font-weight: normal;
	margin: 0px;
	padding: 4px;
	background: #CCC url(../arrow-up.gif) no-repeat right;
	border-bottom: 1px solid #999;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-top: 1px solid #FFF;
	border-right: 1px solid #FFF;
	border-left: 1px solid #FFF;
}

/* panel heading on rollover */
.panel h2:hover, .panelcollapsed h2:hover { background-color: #A9BCEF; }

/* heading of a collapsed panel */
.panelcollapsed h2 
{
	background: #CCC url(../arrow-dn.gif) no-repeat right;
	border-color: #CCC;
}

/* panel content - do not set borders or paddings */
.panelcontent 
{ 
	background: #EEE; 
	overflow: hidden;
}
.element label {
    float:center; 
    width:75px;
    font-weight:700
}
.element input.text {
    
    width:270px;
    padding-left:20px;
}
.element .textarea {
    height:120px; 
    width:270px;
    padding-left:20px;
}
.element .hightlight {
    border:2px solid #9F1319;
   
}
.element #submit {
    
    margin-right:10px;
}
.loading {
   
    background:url(ajax-loader.gif) no-repeat 1px; 
    height:28px; 
    width:28px; 
    display:none;
}

	
	
/* collapsed panel content */
.panelcollapsed .panelcontent { display: none; }

.statusupdate {display:none;}

.modifyform {display:none; }

.maxocmin{display:none;}

.maxocerror{display:none;}

.rtcm{display:none;}

.updatedone{display:none;}

.updateerror{display:none;}

.sea{display:none;}

.unauthorized{display:none;}

</style>
<script type="text/javascript" src="../includes/utils.js"></script>
<script type="text/javascript" src="../includes/float.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="vs.js"></script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Idea by:  Nic Wolfe -->
<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://www.javascriptsource.com -->

<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=700,height=1000,left = 0,top = 0');");
}
// End -->
</script>




<?php # Script 3.4 - index.php
$page_title = 'View Course';
include ('includes/header.html');
include ('includes/menu.html');
include ("includes/moby.php");
include ("../includes/classes.php");
$course = new Course();
$account = new Account();



if (!isset($_POST["ID"]))
	{
		$ID = $_GET["id"];
	}
	else
	{
		$ID = $_POST["ID"];
	}
	
	echo '<h1>' . $course->getName($ID) .' (' . $ID . ')</h1><span class="rtcm">' . "<a href='#' onclick='Javascript:returnMain();'>Return To Course Main</a>".'<br><br></span>';
	echo "<div class='maincontent'>";
	
	
	
	if ($course->getStatus($ID) == 0)
	{
		echo "<div class='inactive'><div class='clean-notice'>Course is inactive</div></div>";
		
	}
		
	echo "<div class='statusupdate'><div class='clean-ok'>The course's status has been updated accordingly</div></div>";
	
	echo "<div class='updatedone clean-ok'>The course information has been updated accordingly. Please refresh to view updates</div>";
	
	echo "<div class='sea clean-error'>Unable to remove course. There are students already enrolled in this course. In order to proceed with course removal, you'll need to unenroll all students first.</div>";
	
	echo "<div class='unauthorized clean-error'>You don't possess sufficient privileges in order to perform this action </div>";
	
	
	echo "<br><b>Name:</b> " . $course->getName($ID);
	
	echo "<br><br><b>Instructor:</b> " . $course->getInst($ID);	
	
	echo "<br><br><b>Room:</b> " . $course->getRoom($ID);
	
	echo "<br><br><b>Maximum Occupancy (S:T):</b> " . $course->getMaxOc($ID) . ":" . $course->totalMaxOcc($ID);
	
	echo "<br><br><b>Total Enrolled:</b> " . $course->totalEnrolled($ID) . " (" . $course->calculateCapacity($ID) . "%)";
	
	
	
	
	
	echo "<br><br>";
	
	
	echo '<div class="panelcollapsed">';
	
	echo "<h2>Course Settings</h2>";
	
	echo '<div class="panelcontent">';
	
	echo "<p><b>Status:</b>  ".'<input type="radio" name="status" onclick="javascript:makeActive(' . $ID .');"';
	if ($course->getStatus($ID) == 1) { echo "checked"; }
	echo '> Active <input type="radio" name="status" onclick="javascript:makeInActive(' . $ID . ')"';
	if ($course->getStatus($ID) == 0) { echo "checked"; }
	echo '> Inactive ';

	
	
	echo "</p>";
	
	echo "<p><b>Course Information:</b> <a href='#' onclick='Javascript:showUpdateForm();'>Modify</a></p>";
	echo "<p><b>Remove Course:</b>";
	
	
	?>
    <a href="#" onclick="if(confirm('Are you sure, there is NO undo?!')) javascript:deleteCourse(<? echo $ID; ?>);">Delete</a>
    <?
	
	echo "</p>";
	echo "<p><b>Roster: </b><a href='roster.php?id=" . $ID . "'>Print</a>";
	echo "</div></div>";
	
	echo "<br><br>";
	

//session 1 roster panel

	echo '<div class="panelcollapsed">';
	
	echo "<h2>Session 1 Roster</h2>";
	echo $course->getSessionEnrolled($ID, 1) . " Students Enrolled";
	
	echo '<div class="panelcontent"><p>';
	echo '<table align="left" cellspacing="0" cellpadding="1" width="100%" border="0">';
	

	$result = mysql_query("SELECT * FROM  `Students` WHERE  `Class1` = CONVERT( _utf8 '$ID' USING latin1 ) COLLATE latin1_general_ci");	
	while ($row = mysql_fetch_array($result)) {
		$userID = $row["ID"];
		
		echo "<tr class='user" . $userID . "'>";
		echo '<td align="left">';
		?>
        <A HREF="javascript:popUp('swap_course.php?uid=<? echo $userID; ?>&course=<? echo $ID; ?>&session=1')">(S)</A>
        <a href="#" onclick="if(confirm('Are you sure? Removing this user from this class will render their schedule incomplete!')) javascript:testremove(<? echo $userID; ?>, <? echo $ID; ?>, 1);"</a>
        
        
        
        <?
		echo '(X)</a> ' . "<a href='view_student.php?id=" . $userID ."'>" . $account->getFirst($userID) . " " . $account->getLast($userID) . "</a></td>";
		echo "</tr>";
		
	}
	

	
	
	 
	
	echo "</table></p></div></div>";
	
//session 2 roster panel
echo '<div class="panelcollapsed">';
	
	echo "<h2>Session 2 Roster</h2>";
	echo $course->getSessionEnrolled($ID, 2) . " Students Enrolled";
	
	echo '<div class="panelcontent"><p>';
	echo '<table align="left" cellspacing="0" cellpadding="1" width="100%" border="0">';
	

	$result = mysql_query("SELECT * FROM  `Students` WHERE  `Class2` = CONVERT( _utf8 '$ID' USING latin1 ) COLLATE latin1_general_ci");	
	while ($row = mysql_fetch_array($result)) {
		$userID = $row["ID"];
		
		echo "<tr class='user" . $userID . "'>";
		echo '<td align="left">';
		?>
        <A HREF="javascript:popUp('swap_course.php?uid=<? echo $userID; ?>&course=<? echo $ID; ?>&session=2')">(S)</A>
        <a href="#" onclick="if(confirm('Are you sure? Removing this user from this class will render their schedule incomplete!')) javascript:testremove(<? echo $userID; ?>, <? echo $ID; ?>, 2);"
        
        
        ">
        <?
		echo '(X)</a> ' . "<a href='view_student.php?id=" . $userID ."'>" . $account->getFirst($userID) . " " . $account->getLast($userID) . "</a></td>";
		echo "</tr>";
		
	}
	

	
	
	 
	
	echo "</table></p></div></div>";
	
//session 3 roster panel

echo '<div class="panelcollapsed">';
	
	echo "<h2>Session 3 Roster</h2>";
	echo $course->getSessionEnrolled($ID, 3) . " Students Enrolled";
	
	echo '<div class="panelcontent"><p>';
	echo '<table align="left" cellspacing="0" cellpadding="1" width="100%" border="0">';
	

	$result = mysql_query("SELECT * FROM  `Students` WHERE  `Class3` = CONVERT( _utf8 '$ID' USING latin1 ) COLLATE latin1_general_ci");	
	while ($row = mysql_fetch_array($result)) {
		$userID = $row["ID"];
		
		echo "<tr class='user" . $userID . "'>";
		echo '<td align="left">';
		?>
        
        
        
        
        <A HREF="javascript:popUp('swap_course.php?uid=<? echo $userID; ?>&course=<? echo $ID; ?>&session=3')">(S)</A>
        <a href="#" onclick="if(confirm('Are you sure? Removing this user from this class will render their schedule incomplete!')) javascript:testremove(<? echo $userID; ?>, <? echo $ID; ?>, 3);"
        
        
        ">
        <?
		echo '(X)</a> ' . "<a href='view_student.php?id=" . $userID ."'>" . $account->getFirst($userID) . " " . $account->getLast($userID) . "</a></td>";
		echo "</tr>";
		
	}
	

	
	
	 
	
	echo "</table></p></div></div>";
	
//end
	
	
	


echo "</div>";//end main content DIV

echo "<div class='modifyform'>";
echo "In order to modify the course's information, make desried modifications below, then hit <b>modify</b>. Please note that you are unable to modify the ID of a course.";
?>
	<br><br>
      <form method="post" action="">
		<div class="maxocerror clean-error">The entered Maximum Occupancy value (multiplied by 3 [one per session]) would be less than the total number of students already enrolled (<? echo $course->totalEnrolled($ID); ?>) in the class. Either choose a higher Maximum Occupancy or unenroll students from the roster.</div><br /><br />
        
        
		<div class="element">
			<label>ID:</label>
			<input type="text" name="id" value="<? echo $ID; ?>"  DISABLED/>
		</div><br />
		<div class="element name">
			<label>Name:</label>
			<input type="text" name="name" value="<? echo $course->getName($ID); ?>" size="<? echo strlen($course->getName($ID))?>" />
		</div><br />
        
        <div class="element">
			<label>Room:</label>
			<input type="text" name="room" value="<? echo $course->getRoom($ID); ?>"  />
		</div><br />
        
        <div class="element">
			<label>Instructor:</label>
			<input type="text" name="inst" value="<? echo $course->getInst($ID); ?>"  />
		</div><br />
        
        <div class="element">
			<label>Maximum Occupancy:</label>
			<input type="text" name="maxoc" value="<? echo $course->getMaxOc($ID); ?>"  /> (per session) 
            <span class="maxocmin"> (Must be greater than 0) </span>
            
		</div><br />
        
         <div class="element">
         <textarea name="desc" rows="15" cols="100"><? echo $course->getDesc($ID); ?></textarea>
		</div><br />
	   
		
		 
		<div class="element">
			 
			<input type="submit" id="submit" value="Update"/>
			<div class="loading"></div>
		</div>
		</form>
    



<?

echo "</div>"; //end modidy form DIV


		




include ('includes/footer.html');

?>

