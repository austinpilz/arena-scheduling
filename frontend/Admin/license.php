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
$license = new License();

	
	
	


?>

<h1>License</h1>

<?
if ($license->getLicenseType() == "032196")
{
	echo "<h2>Developers License</h2>";
}


?>
<p>License ID: 
<? if ($license->getLicenseID() > 0) { echo "" . $license->getLicenseID() . ""; } else { echo "<font color='red'>Error</font>"; } ?> </p>
<p>Status: <? if ($license->validateLicense() == 1) { echo "<font color='green'>Valid</font>"; } else { echo "<font color='red'>Invalid</font>"; } ?></p>
<p>Registered to <b>Austin Pilz</b></p>
<p>Max Students: <font color="green">Unlimited</font></p>
<p>Max Courses: <font color="green">Unlimited</font></p>
<p>Max Teachers: <font color="green">Unlimited</font></p>





<?
include ('includes/footer.html');
?>