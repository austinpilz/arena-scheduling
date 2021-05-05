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
<th>Last, First</th>
<th>Session 1</th>
<th>Session 2</th>
<th>Session 3</th>
</tr>


<?
$result = mysql_query("SELECT * FROM  `Students` ORDER BY Last");	
	while ($row = mysql_fetch_array($result)) {
		$userID = $row[0];
		$class1 = $account->getClassOne($userID);
		$class2 = $account->getClassTwo($userID);
		$class3 = $account->getClassThree($userID);
		
		echo "<tr>";
		echo "<td>" . strtoupper($account->getLast($userID)) . ", " . strtoupper($account->getFirst($userID)) . "</td>";
		echo "<td>". $course->getRoom($class1) ."</td>";
		echo "<td>". $course->getRoom($class2) ."</td>";
		echo "<td>". $course->getRoom($class3) ."</td>";
		echo "</tr>";
	}


?>



</table>