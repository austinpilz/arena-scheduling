<?php
include ("includes/moby.php");
include ("../includes/classes.php");
$course = new Course();

$cid = $_GET["cid"];
$name = $_GET["name"];
$room = $_GET["room"];
$inst = $_GET["inst"];
$maxoc = $_GET["maxoc"];
$desc = $_GET["desc"];
$auth = $_GET["fsi"];

if ($auth == 876545653474747)
{

	$response = $course->verifyUpdate($cid, $name, $room, $inst, $maxoc, $desc);
	
	//985 = new max oc would be less than the # num of students already enrolled
	//1 = all good
	//0 = unknown error
	if ($response == 985) { echo "985"; }
	if ($response == 1) { echo "1"; }
	if ($response == 0) { echo "0"; }
}
else
{
	echo "Unauthorized";
}



?>