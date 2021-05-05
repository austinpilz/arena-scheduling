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

	
	
	


?>

<h1>Settings</h1>

<h2>Students</h2>
<p>Student Statistics</p>
<p>Student Accounts</p>
<p><a href="student_reports.php">Student Reports</a></p>
<p><a href="student_utilities.php">Student Utilities</a></p>
<p>Student Settings</p>
<br />

<h2>Courses</h2>
<p>Course Reports</p>
<br />


<h2>Schedules</h2>

<br>

<h2>System</h2>
<p>System Status: [Yay / Nay]</p>
<p>System Settings</p>
<p>System Reset</p>
<p><a href="license.php">License</a></p>

<br>

<h2>Security</h2>
<p>Security Status: [Security Rating]</p>
<p><a href="security_settings.php">Security Settings</a></p>
<p><a href="lockdown.php">Emergency Lockdown</a></p>

<br>





<?
include ('includes/footer.html');
?>