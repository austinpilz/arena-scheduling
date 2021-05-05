<?php
include("moby.php");
include("classes.php");
$cookie = $_COOKIE["APMSMG_LoginSession"];
$session = new Session();
$choice = new Choice();
$schedule = new Schedule();
$userID = $session->getUser($cookie);
$completed = $schedule->checkStaus($userID);

$admin_check = mysql_query("SELECT * FROM `System` LIMIT 1");
$row = mysql_fetch_array($admin_check);
$active = $row[0];
$enroll = $row[1];
$security = $row[2];


$c1 = $choice->getChoice($userID, 1); 
$c2 = $choice->getChoice($userID, 2); 
$c3 = $choice->getChoice($userID, 3); 

if ($completed != 1 && $active == 1 && $enroll == 1 && $security != 1 && $_GET["id"] != "" && $userID != 0)
{
	if ($c1 == $_GET["id"] || $c2 == $_GET["id"] || $c3 == $_GET["id"])
	{
		$choice = new Choice();
		$choice->removeChoice($_GET["id"], $userID);
	}
	else
	{
		$choice = new Choice();
		$choice->newChoice($_GET["id"], $userID);
	}
	echo "1";
}
else
{
	echo "999";
}
?>

