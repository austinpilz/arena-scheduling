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

<h2>Initial Import Script</h2>
<br />
<?	
	
if (isset($_POST["process"]))
{
	//begin the username process
	$result = $accounts->generateInitialData();
	
	if ($result >= 1) 
	{ 
		echo "<div class='clean-ok'>Success! ".$result."/".$accounts->activeStudents()." student's accounts were completed!</div>"; 
		if ($result != $accounts->activeStudents())
		{
			$ok = $accounts->activeStudents() - $result;
			echo "<br><br><p>" . $ok . " student's accounts were not completed due to an unknown error";
		}
	
	}
	if ($result == 0) 
	{ 
		echo "<div class='clean-error'>No accounts were completed due to an unexpected error</div>"; 
		
	}
	if ($result < 0)
	{
		echo "<div class='clean-error'>The system encountered an unexpected error due to data corruption</div>";
	}

	
}
else
{

?>
<p>After import, student accounts are not yet able to be accessed until they have username, passwords and unique ID's generated for them. Use this utility only after the initial data import</p>

<br><p><font color='red'><b>Warning:</b></font> Only use this utility once after the studentdata has been imported. Running this utility more than once could result in permanent data corruption and loss</p>

<br><br>
<p><div class='clean-yellow' align="center">By clicking the button below, you agree you acknowledge the aforementioned warnings and notices regarding the process
<br><br>
<form action="" method="POST">
<input type='hidden' name='process' value="password">
<input type="submit" value="Generate Initial Data">
</form>
</div></p>



<?
}
include ('includes/footer.html');
?>