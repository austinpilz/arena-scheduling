<script type="text/javascript" src="includes/utils.js"></script>
<script type="text/javascript" src="includes/float.js"></script>  
<script type="text/javascript" src="includes/courses.js"></script>  
<link rel="stylesheet" href="includes/courses.css" type="text/css" charset="utf-8" />

<div id="floatdiv" style="  
    position:absolute;  
    width:200px;height:60px;top:10px;right:10px;  
    padding:16px;background:#FFFFFF;  
    border:2px solid #999;  
    z-index:100">  
    
Done reviewing? Ready to make your schedule?
<a href="schedule.php"><img src='images/createschedule.png' border="0"width="201" height="50" ></a>
</div>  


<?php 
$page_title = "APM Schedule Generator";
include ("includes/moby.php");
include ("includes/header.html");
include ("includes/menu.html");
include("includes/classes.php");

$cookie = $_COOKIE["APMSMG_LoginSession"];
$session = new Session();
$user = new Account();
$auth = $session->checkSession($cookie);
if ($auth == 0)
{
	echo '<meta http-equiv="REFRESH" content="0;url=http://austinpilzmedia.com/Career">';
}
else
{


echo "<h1>Course List</h1>";
$admin_check = mysql_query("SELECT * FROM `System` LIMIT 1");
$row = mysql_fetch_array($admin_check);
$active = $row[0];
$enroll = $row[1];
$security = $row[2];

if ($active == 0 || $security == 1)
{
	echo "<br><div class='clean-notice'>The APM Schedule Matrix Generator is currently unavailable</div>";
}
else
{
echo "<img src='images/step1button.png'><br>On this page you can view detailed information on each offered course. To view more information about a course, click the course title. Take note of the courses you're intered in as you'll need them when you create your schedule. Don't worry, you'll be able to view all the courses again while you pick. Once you've completed reviewing the offered courses, click the <b>Create Schedule</b> button in the box to the right.<br><br>";


echo '<a href="javascript:expandAll()">Expand All</a> | 
<a href="javascript:collapseAll()">Collapse All </a>';

$result = mysql_query("SELECT * From `Course` WHERE `Active` = 1");	

while ($row = mysql_fetch_array($result)) 
{
	$class_id = $row['ID'];
	$course = new Course();
	
	echo "<br><br>";
	
	echo '<div class="panelcollapsed">';
	
	echo "<h2>" . $course->getName($class_id) . "</h2>";
	
	echo '<div class="panelcontent">';
	
	echo "<p>Instructed by " . $course->getInst($class_id) . " in room " . $course->getRoom($class_id);
	
	echo "<p>" . $course->getDesc($class_id) . "</p>";
	
	echo "<p>" . $course->calculateCapacity($class_id) ."% full</p>";
	

	
	
		
	
	
	
	
	echo "</div></div>";
}


}
include ('includes/footer.html');
}
?>   
</body>