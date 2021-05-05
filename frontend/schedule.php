<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="includes/utils.js"></script>
<script type="text/javascript" src="includes/float.js"></script>  
<script type="text/javascript" src="schedule.js"></script> 
<?
include("includes/classes.php");
include("includes/moby.php");
$cookie = $_COOKIE["APMSMG_LoginSession"];
$session = new Session();
$user = new Account();
$schedule = new Schedule();
$auth = $session->checkSession($cookie);
$userID = $session->getUser($cookie);
$completed = $schedule->checkStaus($userID);


$admin_check = mysql_query("SELECT * FROM `System` LIMIT 1");
$row = mysql_fetch_array($admin_check);
$active = $row[0];
$enroll = $row[1];
$security = $row[2];


s
?>

<link rel="stylesheet" href="includes/schedule.css" type="text/css" charset="utf-8" /> 
<SCRIPT LANGUAGE="JavaScript">
<!-- Idea by:  Nic Wolfe -->
<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://www.javascriptsource.com -->

<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=700,height=170,left = 0,top = 0');");
}
// End -->
</script>



<? if ($completed != 1)
{
	?>

	<div id="floatdiv" style="  
    position:absolute;  
    width:200px;height:auto; top:10px;right:10px;  
    padding:16px;background:#FFFFFF;  
    border:2px solid #999;  
    z-index:100">  
    
    
    
    <span class="tryagain">
    Unfortunately, there are no available scheduling options for the courses you selected. Switch one or multiple courses, then try again
    </span>
    
   
   
    <div class="success" id="success">
     Congratulations, your schedule has been created! Please <a href="my_schedule.php">click here</a> to view it.
    </div>
    
    <div class="popup_content" id="popup_content">
    
    
    
    </div>
</div>  

<? }?>
<div class="loading"></div>



<body onLoad="window.blur();">

<?php 
$page_title = "APM Schedule Generator";
include ("includes/header.html");
include ("includes/menu.html");
if ($auth == 0)
{
	echo '<meta http-equiv="REFRESH" content="0;url=http://austinpilzmedia.com/Career">';
}
else
{
	if ($completed != 1)
	{
	


	echo "<h1>Schedule</h1>";
	
	
	if ($active == 0 || $security == 1)
	{
		echo "<br><div class='clean-notice'>The APM Schedule Matrix Generator is currently unavailable</div>";
	}
	else
	{
		
		//echo '<a onclick="javascript:floatbox();">Update</a>';
		echo ' <div class="clean-error unexpected_error" id="unexpected_error">An unexpected error has occured. Please try again later</div>';
		echo "<img src='images/bar1.png' width='750' height='62'><br><br>On this page you can view detailed information on each offered course. To view more information about a course, click the course title. Take note of the courses you're intered in as you'll need them when you create your schedule. Don't worry, you'll be able to view all the courses again while you pick. Once you've completed reviewing the offered courses, click the <b>Create Schedule</b> button in the box to the right.<br><br>";
		
		
		echo '<a href="javascript:expandAll()">Expand All</a> | 
		<a href="javascript:collapseAll()">Collapse All </a>';
		
		$result = mysql_query("SELECT * From `Course` WHERE `Active` = 1 ORDER BY Name");
		
		?>
		
		
		
		
		<form action="schedule.php" method="post" name="form")
		<?	
		
		while ($row = mysql_fetch_array($result)) 
		{
			$class_id = $row['ID'];
			$course = new Course();
			$choice = new Choice();
			$c1 = $choice->getChoice($userID, 1); 
			$c2 = $choice->getChoice($userID, 2); 
			$c3 = $choice->getChoice($userID, 3); 
			
			
				
			
			echo "<br><br>";
			
			echo '<div class="panelcollapsed">';
			
			echo "<h2>" . $course->getName($class_id);
			
			if ($enroll == 1)
			{
			
				if ($c1 == $class_id || $c2 == $class_id || $c3 == $class_id)
				{
					?> 
					<input type="checkbox" name="<? echo $class_id; ?>" onClick="javascript:classAction(<? echo $class_id; ?>);" checked/>
					<?
				}
				else
				{ 	
					if ($course->calculateCapacity($class_id) == 100)
					{
						?>
						<input type="checkbox" name="<? echo $class_id; ?>" onClick="javascript:classAction(<? echo $class_id; ?>);"  DISABLED/>
				
				
				<?
					}
					else
					{
				?>
						<input type="checkbox" name="<? echo $class_id; ?>" onClick="javascript:classAction(<? echo $class_id; ?>);"  />
				
				
				<?
					}
				}
			}
			else
			{
				?>
				<input type="checkbox" name="<? echo $class_id; ?>" onClick="javascript:classAction(<? echo $class_id; ?>);" DISABLED/>
				<?	
			}
			
			echo "</h2>";
			
			if ($course->calculateCapacity($class_id) == 100)
			{
				echo "<font color='red'><b>This course is full</b></font>";
			}
			
			echo '<div class="panelcontent">';
			
			echo "<p>Instructed by " . $course->getInst($class_id) . " in room " . $course->getRoom($class_id);
			
			echo "<p>" . $course->getDesc($class_id) . "</p>";
			
			if ($course->calculateCapacity($class_id) == 100)
			{
				
			}
			else
			{
				echo "<p>" . $course->calculateCapacity($class_id) ."% full</p>";
			}
			
		
			
			
				
			
			
			
			
			echo "</div></div>";
		}
		echo "</form>";
		
	
		
	}
	}
	else
	{
		//schedule completed
		echo "<h1>My Schedule</h1>";
		
		echo "Shown below is your final schedule created from the three courses you chose. Please print out your schedule and keep it for your personal records. If you lose your schedule before the event, you may return to this page using your provided username and password.<br><br>";
		
		?>
        <A HREF="javascript:popUp('schedule_view.php')">Print</A>
        <?
		
		$schedule->displaySchedule($userID);
		
		
	}
	
	
	include ('includes/footer.html');
}
?>   
</body>