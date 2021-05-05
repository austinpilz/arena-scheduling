<?php
include ("includes/moby.php");
include ("../includes/classes.php");
$session = new Session();
$course = new Course();
$account = new Account();
$schedule = new Schedule();

$courseID = $_GET["id"];


$admin_check = mysql_query("SELECT * FROM `System` LIMIT 1");
$row = mysql_fetch_array($admin_check);
$min_oc = $row[7];


$result = mysql_query("SELECT * FROM  `Students` ORDER BY Last");	
	while ($row = mysql_fetch_array($result)) {
		$userID = $row[0];
		
		$schedule->displaySchedule($userID);
		echo "<br><br><br><br><br><br><br><br><br>";
		
	}


?>


