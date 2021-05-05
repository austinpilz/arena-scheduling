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

<h1>Student Reports</h1>
<br>
<h2>Accounts</h2>
<p>Complete Account Information</p>
<p><a href="login_information.php">Login Information</a></p>
<p><a href="inactive_accounts.php">Inactive Accounts</a></p>
<br />

<h2>Schedules</h2>
<p><a href="complete_schedules.php">Complete Schedules<a></p>
<p><a href="incomplete_schedules.php">Incomplete Schedules</a></p>
<p><a href="inprogress_schedules.php">In Progress Schedules</a></p>







<?
include ('includes/footer.html');
?>