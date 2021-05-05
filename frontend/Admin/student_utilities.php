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

<h1>Student Utilities</h1>

<h2>Accounts</h2>
<p><a href="initial_script.php">Initial Import Script</a></p>
<p><a href="generate_usernames.php">Regenerate Usernames</a></p>
<p><a href="generate_passwords.php">Regenerate IDs & Passwords</a></p>
<br />

<h2>Import & Export</h2>
<p><a href="dbTube_php/">Student Import</a></p>
<p><a href="export.php">Export All Student Data</a></p>
<br>

<br>




<?
include ('includes/footer.html');
?>