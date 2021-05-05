<?php
include ('includes/header.html');
include ('includes/menu.html');
include ("includes/moby.php");
include ("../includes/classes.php");
$account = new Account();
$schedule = new Schedule();


$result = mysql_query("SELECT * From `Students` ORDER BY Last");



while ($row = mysql_fetch_array($result)) {
	
	$rf = $row[3];
	$rl = $row[4];
	
	$first = strtolower($row[3]);
	$last = strtolower($row[4]);
	$id = rand(1000, 500000);
	
	$username = substr($first, 0) . "." . $last;
	$password = $id;
	
	$resulty = mysql_query("UPDATE  `Students` SET  `ID` =  '$id', `Username` =  '$username', `Password` =  '$password', `First` = '$first', `Last` = '$last' WHERE  CONVERT(  `First` USING utf8 ) =  '$rf' AND CONVERT(  `Last` USING utf8 ) =  '$rl' LIMIT 1 ;");
	
	
	
	
	
	
	
	
	
}

?>