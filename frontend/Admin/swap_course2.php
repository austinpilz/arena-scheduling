<?php
include ("includes/moby.php");
include ("../includes/classes.php");
$session = new Session();
$course = new Course();
$account = new Account();
$schedule = new Schedule();

$uid = $_GET["uid"];
$courseID = $_GET["course"];
$session = $_GET["session"];

$result = $schedule->setCourseOverride($uid, $courseID, $session);
if ($result == 1)
{
	echo "Enrollment complete.";
}
else
{
	echo "error";
}

?>