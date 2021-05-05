<?php
include ("includes/moby.php");
include ("../includes/classes.php");
$session = new Session();
$course = new Course();
$account = new Account();
$schedule = new Schedule();

$userID = $_GET["uid"];
$courseID = $_GET["course"];
$session = $_GET["session"];

$admin_check = mysql_query("SELECT * FROM `System` LIMIT 1");
$row = mysql_fetch_array($admin_check);
$min_oc = $row[7];

echo "Student Course Change: ";
echo "<br><br>Name: <b>" .  $account->getFirst($userID) . " " . $account->getLast($userID) . "</b>";
echo "<br>Current Course: " . $course->getName($courseID) . " (Session " . $session . ") ";
?>

<br><br><b><font color="green">Green = </font></b> Above min. requirement
<br><b><font color="orange">Orange = </font></b> Below min. requirement
<br><b><font color="red">Red = </font></b> Less than 1/2 min. requirement


<table border="1">
<tr>
<th></th>
<th>Session 1</th>
<th>Session 2</th>
<th>Session 3</th>
</tr>
<tr>

<?
$result = mysql_query("SELECT * From `Course` ORDER BY Name");
while ($row = mysql_fetch_array($result)) 
	{
		if ($course->getStatus($row[0]) == 0)
		{
			echo "<td> " . $course->getName($row[0]) . " <font color='red'>(Inactive)</font></td>";
		}
		else
		{
			echo "<td> " . $course->getName($row[0]) . "</td>";
		}
		
		$maxoc = $course->getMaxOc($row[0]);
		$s1e = $course->getSessionEnrolled($row[0], 1);
		$s2e = $course->getSessionEnrolled($row[0], 2);
		$s3e = $course->getSessionEnrolled($row[0], 3);
		
		if ($session == 1)
		{
			if ($s1e < $maxoc )
			{
				if ($s1e < $min_oc / 2)
				{
					echo "<td BGCOLOR='red'><a href='swap_course2.php?uid=" . $userID ."&course=" . $row[0] ."&session=1'>" . $s1e . " / " . $maxoc . "</a></td>";
				}
				else if ($s1e < $min_oc )
				{
					echo "<td BGCOLOR='orange'><a href='swap_course2.php?uid=" . $userID ."&course=" . $row[0] ."&session=1'>" . $s1e . " / " . $maxoc . "</a></td>";
				}
				else
				{
					echo "<td BGCOLOR='#00FF00'><a href='swap_course2.php?uid=" . $userID ."&course=" . $row[0] ."&session=1'>" . $s1e . " / " . $maxoc . "</a></td>";
				}
			}
		}
		else if ($session == 2)
		{
			echo "<td></td>";
			if ($s2e < $maxoc )
			{
				if ($s2e < $min_oc / 2)
				{
					echo "<td BGCOLOR='red'><a href='swap_course2.php?uid=" . $userID ."&course=" . $row[0] ."&session=2'>" . $s2e . " / " . $maxoc . "</a></td>";
				}
				else if ($s2e < $min_oc )
				{
					echo "<td BGCOLOR='orange'><a href='swap_course2.php?uid=" . $userID ."&course=" . $row[0] ."&session=2'>" . $s2e . " / " . $maxoc . "</a></td>";
				}
				else
				{
					echo "<td BGCOLOR='#00FF00'><a href='swap_course2.php?uid=" . $userID ."&course=" . $row[0] ."&session=2'>" . $s2e . " / " . $maxoc . "</a></td>";
				}
			}
		}
		else if ($session == 3)
		{
			echo "<td></td>";
			echo "<td></td>";
			if ($s3e < $maxoc )
			{
				if ($s3e < $min_oc / 2)
				{
					echo "<td BGCOLOR='red'><a href='swap_course2.php?uid=" . $userID ."&course=" . $row[0] ."&session=3'>" . $s3e . " / " . $maxoc . "</a></td>";
				}
				else if ($s3e < $min_oc )
				{
					echo "<td BGCOLOR='orange'><a href='swap_course2.php?uid=" . $userID ."&course=" . $row[0] ."&session=3'>" . $s3e . " / " . $maxoc . "</a></td>";
				}
				else
				{
					echo "<td BGCOLOR='#00FF00'><a href='swap_course2.php?uid=" . $userID ."&course=" . $row[0] ."&session=3'>" . $s3e . " / " . $maxoc . "</a></td>";
				}
			}
		}
		
		echo "</tr>";
		
	}
?>


</table>