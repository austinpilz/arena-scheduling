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

<h2>Regenerate Usernames</h2>
<br />
<?	
	
if (isset($_POST["process"]))
{
	//begin the username process
	$result = $accounts->regenerateUsernames();
	
	if ($result >= 1) 
	{ 
		echo "<div class='clean-ok'>Success! ".$result."/".$accounts->activeStudents()." student's usernames were changed!</div>"; 
		if ($result != $accounts->activeStudents())
		{
			$ok = $accounts->activeStudents() - $result;
			echo "<br><br><p>Not all student accounts were updated as " . $ok . " student account's were already in the proper username format";
		}
	
	}
	if ($result == 0) 
	{ 
		echo "<div class='clean-notice'>".$result."/".$accounts->activeStudents()." student's usernames were changed</div>"; 
		echo "<br><br><p>This typically means all of the students usernames were how they're supposed to be, and no updates were necessairy! If you believe this is an error, please contact your administrator.</p>";
		
	}
	if ($result < 0)
	{
		echo "<div class='clean-error'>The system encountered an unexpected error due to data corruption</div>";
	}

	
}
else
{

?>
<p>Student usernames are per policy, [first].[last], and will be created form the stored First & Last name values. Once the process has been initiated, the system will create a temporary backup of the existing data in the event of system failure / data corruption. It will be stored until the process is run again. It is recommened that you also use the export  </p>

<br><p><font color='red'><b>Warning:</b></font> This process <u>will</u> recreate all <? echo $accounts->activeStudents(); ?> student's usernames using their stored first and last name. This will completely erase any custom created usernames.</p>

<br><br>
<p><div class='clean-yellow' align="center">By clicking the button below, you agree you acknowledge the aforementioned warnings and notices regarding the process
<br><br>
<form action="" method="POST">
<input type='hidden' name='process' value="username">
<input type="submit" value="Regenerate Usernames">
</form>
</div></p>



<?
}
include ('includes/footer.html');
?>