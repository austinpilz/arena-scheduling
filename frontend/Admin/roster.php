<?php
include ("includes/moby.php");
include ("../includes/classes.php");
$session = new Session();
$course = new Course();
$account = new Account();
$schedule = new Schedule();

$courseID = $_GET["id"];


$admin_check = mysql_query("SELECT * FROM `System` LIMIT 1");
$row = mysql_fetch_array($admin_check);
$min_oc = $row[7];

echo "<h1>" . $course->getName($courseID) . " </h1>";
?>

<table border="1">
<tr>
<th>Session 1</th>
<th>Session 2</th>
<th>Session 3</th>
</tr>

<td>
<?
$result = mysql_query("SELECT * FROM  `Students` WHERE  `Class1` = CONVERT( _utf8 '$courseID' USING latin1 ) COLLATE latin1_general_ci");	
	while ($row = mysql_fetch_array($result)) {
		$userID = $row["ID"];
		
		echo "" . strtoupper($account->getLast($userID)) . ", " . strtoupper($account->getFirst($userID)) . "<br>";
	}
		
		
		
		
		?>
</td>



<td>
<?
$result = mysql_query("SELECT * FROM  `Students` WHERE  `Class2` = CONVERT( _utf8 '$courseID' USING latin1 ) COLLATE latin1_general_ci");	
	while ($row = mysql_fetch_array($result)) {
		$userID = $row["ID"];
		
		echo "" . strtoupper($account->getLast($userID)) . ", " . strtoupper($account->getFirst($userID)) . "<br>";
	}
		
		
		
		
		?>
</td>




<td>
<?
$result = mysql_query("SELECT * FROM  `Students` WHERE  `Class3` = CONVERT( _utf8 '$courseID' USING latin1 ) COLLATE latin1_general_ci");	
	while ($row = mysql_fetch_array($result)) {
		$userID = $row["ID"];
		
		echo "" . strtoupper($account->getLast($userID)) . ", " . strtoupper($account->getFirst($userID)) . "<br>";
	}
		
		
		
		
		?>
</td>
</table>