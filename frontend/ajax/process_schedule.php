<?php
include("../includes/moby.php");
include("../includes/classes.php");
$cookie = $_COOKIE["APMSMG_LoginSession"];
$session = new Session();
$schedule = new Schedule();
$userID = $session->getUser($cookie);

$result = $schedule->createSchedule($userID);



if ($result == 1)
{
	echo "1";
}
else
{
	echo "0";
}

?>

