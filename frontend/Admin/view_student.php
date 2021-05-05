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
<script type="text/javascript" src="vs2.js"></script>
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
$page_title = 'View Student';
include ('includes/header.html');
include ('includes/menu.html');
include ("includes/moby.php");
include ("../includes/classes.php");
$course = new Course();
$account = new Account();
$schedule = new Schedule();



if (!isset($_POST["ID"]))
	{
		$ID = $_GET["id"];
	}
	else
	{
		$ID = $_POST["ID"];
	}
	
	echo '<h1>' . $account->getFirst($ID) .' ' . $account->getLast($ID) . '</h1><span class="rtcm">' . "<a href='#' onclick='Javascript:returnMain();'>Return To Student Main</a>".'<br><br></span>';
	echo "<div class='maincontent'>";
	
	
	
	if ($account->getStatus($ID) == 0)
	{
		echo "<div class='inactive'><div class='clean-notice'>Account Inactive</div></div>";
		
	}
		
	echo "<div class='statusupdate'><div class='clean-ok'>The students's account status has been updated accordingly</div></div>";
	
	echo "<div class='updatedone clean-ok'>The account information has been updated accordingly. Please refresh to view updates</div>";
	
	echo "<div class='sea clean-error'>Unable to remove</div>";
	
	echo "<div class='unauthorized clean-error'>You don't possess sufficient privileges in order to perform this action </div>";
	
	
	echo "<br><b>Name:</b> " . $account->getFirst($ID) . " " . $account->getLast($ID);
	
	echo "<br><br><b>Email:</b> " . $account->getEmail($ID);	
	
	echo "<br><br><b>Username:</b> " . $account->getUsername($ID);
	
	echo "<br><br><b>ID:</b> " . $ID;
	
	echo "<br><br><b>Schedule Status:</b> ";
	
		if ($schedule->checkStaus($ID) == 1)
		{
			echo "<font color='green'>Complete</font>";
		}
		else
		{
			if ($schedule->checkStaus($ID) == 2)
			{
				echo "<font color='red'>Incomplete</font> <font color='orange'><b>(In Progress)</b></font>";
			}
			else
			{
				echo "<font color='red'>Incomplete</font>";
			}
		}
			
	
	
	
	
	
	echo "<br><br>";
	
	
	echo '<div class="panelcollapsed">';
	
	echo "<h2>Account Settings</h2>";
	
	echo '<div class="panelcontent">';
	
	echo "<p><b>Status:</b>  ".'<input type="radio" name="status" onclick="javascript:updateStatus(' . $ID .', 1);"';
	if ($account->getStatus($ID) == 1) { echo "checked"; }
	echo '> Active <input type="radio" name="status" onclick="javascript:updateStatus(' . $ID . ', 0)"';
	if ($account->getStatus($ID) == 0) { echo "checked"; }
	echo '> Inactive ';

	
	
	echo "</p>";
	
	echo "<p><b>Information:</b> <a href='#' onclick='Javascript:showUpdateForm();'>Modify</a></p>";
	echo "<p><b>Delete:</b>";
	?>
    <a href="#" onclick="if(confirm('Are you sure, there is NO undo?!')) javascript:deleteStudent(<? echo $ID; ?>);">Delete</a>
    <?
	
	echo "</p>";
	
	echo "</div></div>";
	
	echo "<br><br>";
	

//session 1 roster panel

	echo '<div class="panelcollapsed">';
	
	echo "<h2>Session 1</h2>";
	
	$course1 = $account->getClassOne($ID);
	
	echo $course->getName($course1);
	
	echo '<div class="panelcontent"><p>';
	
	if ($course1 > 0)
	{
	
		echo 'Course: <a href="view_class.php?id=' . $course1 . '">View</a>';
		
		?>
			<br>User: <span class="s1"><a href="#" onclick="ijavascript:removeUser(<? echo $ID; ?>, <? echo $course1; ?>, 1);">Unenroll</a></span>
            <br />Swap: <A HREF="javascript:popUp('swap_course.php?uid=<? echo $ID; ?>&course=<? echo $course1; ?>&session=1')">Swap Courses</A>
		<?
	}
	else
	{
		?>
        <A HREF="javascript:popUp('swap_course.php?uid=<? echo $ID; ?>&session=1')">Manually Enroll</A>
        <?
	}
	
	echo "</p></div></div>";
	
	//Session 2
	
	echo '<div class="panelcollapsed">';
	
	echo "<h2>Session 2</h2>";
	
	$course2 = $account->getClassTwo($ID);
	
	echo $course->getName($course2);
	
	echo '<div class="panelcontent"><p>';
	
	if ($course2 > 0)
	{
	
		echo 'Course: <a href="view_class.php?id=' . $course2 . '">View</a>';
		
		?>
			<br>User: <span class="s1"><a href="#" onclick="ijavascript:removeUser(<? echo $ID; ?>, <? echo $course2; ?>, 2);">Unenroll</a></span>
            <br />Swap: <A HREF="javascript:popUp('swap_course.php?uid=<? echo $ID; ?>&course=<? echo $course2; ?>&session=2')">Swap Courses</A>
		<?
	}
	else
	{
		?>
        <A HREF="javascript:popUp('swap_course.php?uid=<? echo $ID; ?>&course=<? echo $course2; ?>&session=2')">Manually Enroll</A>
        <?
	}
	
	
	echo "</p></div></div>";
	
	//Session 3
	
	echo '<div class="panelcollapsed">';
	
	echo "<h2>Session 3</h2>";
	
	$course3 = $account->getClassThree($ID);
	
	echo $course->getName($course3);
	
	echo '<div class="panelcontent"><p>';
	
	if ($course3 > 0)
	{
	
		echo 'Course: <a href="view_class.php?id=' . $course3 . '">View</a>';
		
		?>
			<br>User: <span class="s1"><a href="#" onclick="ijavascript:removeUser(<? echo $ID; ?>, <? echo $course3; ?>, 3);">Unenroll</a></span>
            <br />Swap: <A HREF="javascript:popUp('swap_course.php?uid=<? echo $ID; ?>&course=<? echo $course3; ?>&session=3')">Swap Courses</A>
		<?
	}
	else
	{
		?>
        <A HREF="javascript:popUp('swap_course.php?uid=<? echo $ID; ?>&course=<? echo $course3; ?>&session=3')">Manually Enroll</A>
        <?
	}
	
	echo "</p></div></div>";
	
	


echo "</div>";//end main content DIV

echo "<div class='modifyform'>";
echo "In order to modify the students's information, make desried modifications below, then hit <b>modify</b>. Please note that you are unable to modify the ID of a student.";
?>
	<br><br>
      <form method="post" action="">
		<br /><br />
        
        
		<div class="element">
			<label>ID:</label>
			<input type="text" name="id" value="<? echo $ID; ?>"  DISABLED/>
		</div><br />
		<div class="element name">
			<label>First Name:</label>
			<input type="text" name="fname" value="<? echo $account->getFirst($ID); ?>" size="<? echo strlen($account->getFirst($ID))?>" />
		</div><br />
        
        <div class="element name">
			<label>Last Name:</label>
			<input type="text" name="lname" value="<? echo $account->getLast($ID); ?>" size="<? echo strlen($account->getLast($ID))?>" />
		</div><br />
        
        <div class="element">
			<label>Email:</label>
			<input type="text" name="email" value="<? echo $account->getEmail($ID); ?>"  />
		</div><br />
        
        <div class="element">
			<label>Username:</label>
			<input type="text" name="username" value="<? echo $account->getUsername($ID); ?>"  />
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

