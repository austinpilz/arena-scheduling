<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script language="JavaScript" type="text/javascript">
function hideInactive()
{
	$('.inactive').fadeOut('slow');
	$('.hideInact').fadeOut('fast');
	$('.showInact').fadeIn('fast');
	
	
}
function showInactive()
{
	$('.inactive').fadeIn('slow');
	$('.hideInact').fadeIn('fast');
	$('.showInact').fadeOut('fast');
	
	
}

function openSort()
{
	$('.sorting').fadeIn('slow');
	
}

</script>
<style type="text/css">
.sorting{ display:none;}
.showInact{ display:none;}



</style>
<?php # Script 9.5 - #5
$page_title = 'Incomplete Schedules';
include ('includes/header.html');
include ('includes/menu.html');
include ("includes/moby.php");
include ("../includes/classes.php");
$account = new Account();
$schedule = new Schedule();



$ip = getenv("REMOTE_ADDR") ; 






echo '<h1>Incomplete Schedules</h1>';
echo "<br>Rows highlighted in <b><font color='red'>red</font></b> denote inactive accounts<br>";
?>


<br />
<?




// Make the query:
$result = mysql_query("SELECT * From `Students` ORDER BY Last");		


// Table header:
echo '<table align="center" cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td align="left"><b>View</b></td>
	<td align="left"><b>Last</a></b></td>
	<td align="left"><b>First</a></b></td>
	<td align="left"><b>ID</a></b></td>
</tr>
';

// Fetch and print all the records....
echo "</b></b>";
$bg = '#eeeeee'; 
while ($row = mysql_fetch_array($result)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
	
	
	
	$uid = $row['ID'];
	$completed = $schedule->checkStaus($uid);
	
		if ($completed == 0 || $completed == 2)
		{
			if ($account->getStatus($uid) == 0)
			{
				echo '<tr bgcolor="#FF3333" class="schcomplete">';
			}
			else
			{
				echo '<tr bgcolor="' . $bg . '" class="schcomplete">';
			}
			
			echo '
		<td align="left"><form action="view_student.php" method="post"><input type="hidden" name="ID" value="' . $row['ID'] . '"><input type="submit" value="View"></form></a></td>';
		
		echo '<td align="left">' . $account->getLast($uid) . '</td>';
		echo '<td align="left">' . $account->getFirst($uid) . '</td>';
		echo '<td align="left">' . $uid . '</td>';
		echo '</tr>';
		
		}
		else
		{

		}
	
		
		
			
		
} // End of WHILE loop.

echo '</table> ';





	
include ('includes/footer.html');

?>