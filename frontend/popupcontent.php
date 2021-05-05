<script type="text/javascript" src="scheduletwo.js"></script> 
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
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


	$choice = new Choice();
	$course = new Course();
	$c1 = $choice->getChoice($userID, 1); 
	$c2 = $choice->getChoice($userID, 2); 
	$c3 = $choice->getChoice($userID, 3); 
	
	
	echo "<div class='maincont'>";
	if ($enroll == 1)
	{
		
		if ($c1 > 0 || $c2 > 0 || $c3 > 0)
		{
			echo "<p><b>Selected Courses:</b></p>";
			
			if ($c1 && $c2 && $c3)
			{
				echo "<p>" . $course->getName($c1) . "</p>";
				echo "<p>" . $course->getName($c2) . "</p>";
				echo "<p>" . $course->getName($c3) . "</p>";
				?>
				
				<br />
				<input type="submit" id="" onClick="javascript:processSchedule()" value="Submit Schedule"/>
				
			
				<?
			}
			else
			{	$left = 3;
				if ($c1)
				{
					echo "<p>" . $course->getName($c1) . "</p>";
					$left--;
				}
				if ($c2)
				{
					echo "<p>" . $course->getName($c2) . "</p>";
					$left--;
				}
				if ($c3)
				{
					echo "<p>" . $course->getName($c3) . "</p>";
					$left--;
				}
				
				echo "<br><p>" . $left . " course(s) left to choose";
			}
		}
		else
		{
		
			echo "<p>You have not yet selected any courses. They will appear here once you do so</p>";	
			
		}
	}
	else
	{
		echo "<p>Creating your schedule is currently unavailable. Please try again later</p>";
	}
	
	echo "</maincont>";
	
	
	
	?>
	 <span class="success">
    Congratulations, your schedule has been created! Please <a href="schedule_view.php">click here</a> to view it.
    </span>