<?php # Script 9.3 - edit_user.php

// This page is for editing a user record.
// This page is accessed through view_users.php.

$page_title = 'CVMS Carrer Day Admin';
include ("includes/header.html");
include ("includes/menu.html");
include ("includes/moby.php");
include ("../includes/classes.php");

$accounts = new Accounts();
$system = new System();

$status = $system->checkSystem(); //see if system is on or off

$system_status = $system->systemBoot(); //boot system
// (1) - Check License - 032196
// (2) - Check Security	- 032197

if ($system_status != 1)
{
	echo "<h1>System Boot Error</h1>";
	echo "<div class='clean-error'>The system was unable to boot due to a system error. Please resolve the problems listed below</div>";
	
	echo "<br><br><h2>Error(s) - " . $system_status . "</h2><br>";
	
	$num = 0;
	
	if ($system_status == "032196") //license
	{
		$num = $num + 1;
		echo "<p>The system's license is invalid, not registered or corrupt. <a href='license.php'>Update License</a></p>";
	}
	if ($system_status == "032197") //security
	{
		$num = $num + 1;
		echo "<p>Security lockdown was enabled prior to system shut down / reboot. <a href='lockdown.php'>Security Lockdown</a></p>";
	}
	
	
}
else
{


?>

<h1>Dashboard</h1>

<h2>Students</h2>
<p><? echo $accounts->totalStudents(); ?> enrolled students</p>
<p><? echo $accounts->activeStudents(); ?> active students</p>
<p><? echo $accounts->studentsComplete(); ?> students with completed schedules</p>
<p><? echo $accounts->studentsIncomplete(); ?> students with incomplete schedules</p>
<br />

<h2>Courses</h2>
<p><? echo $system->totalCourses(); ?> total courses</p>
<p><? echo $system->activeCourses(); ?> active courses</p>
<br />


<h2>Sessions</h2>


<?
}
include ('includes/footer.html');
?>