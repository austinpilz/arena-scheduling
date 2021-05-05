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

<h2>Regenerate Passwords</h2>
<br />
<?	
	
if (isset($_POST["process"]))
{
	//begin the username process
	$result = $accounts->regeneratePasswords();
	
	if ($result >= 1) 
	{ 
		echo "<div class='clean-ok'>Success! ".$result."/".$accounts->activeStudents()." student's passwords were changed!</div>"; 
		if ($result != $accounts->activeStudents())
		{
			$ok = $accounts->activeStudents() - $result;
			echo "<br><br><p>" . $ok . " student's ID and Password's were not updated due to an unknown error";
		}
	
	}
	if ($result == 0) 
	{ 
		echo "<div class='clean-error'>No ID or Passwords were updated due to an unexpected error</div>"; 
		
	}
	if ($result < 0)
	{
		echo "<div class='clean-error'>The system encountered an unexpected error due to data corruption</div>";
	}

	
}
else
{

?>
<p>Student ID and Passwords are the same value, and are randomly generated upon account creation for security purposes. This process will generate new ID's for all students. Once the process has been initiated, the system will create a temporary backup of the existing data in the event of system failure / data corruption. It will be stored until the process is run again. It is recommened that you also use the export  </p>

<br><p><font color='red'><b>Warning:</b></font> This process <u>will</u> recreate all <? echo $accounts->activeStudents(); ?> student's passwords & ID's using randomly selected numbers. This will render any login details useless.</p>

<br><br>
<p><div class='clean-yellow' align="center">By clicking the button below, you agree you acknowledge the aforementioned warnings and notices regarding the process
<br><br>
<form action="" method="POST">
<input type='hidden' name='process' value="password">
<input type="submit" value="Regenerate Passwords">
</form>
</div></p>



<?
}
include ('includes/footer.html');
?>