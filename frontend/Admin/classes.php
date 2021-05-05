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
$page_title = 'Career Day Courses';
include ('includes/header.html');
include ('includes/menu.html');
include ("includes/moby.php");
include ("../includes/classes.php");
$course = new Course();


$ip = getenv("REMOTE_ADDR") ; 






echo '<h1>Courses</h1>';

?>

<a onclick="javascript:openSort();">Sorting Options</a> | <a href='course_overview.php'>Enrollment Status</a> | <a href='master_roster.php'>Master Roster</a>
<br />
<div class="sorting">
<div class="clean-yellow">
<span class="hideInact"><a onclick="javascript:hideInactive();">Hide Inactive</a></span>
<span class="showInact"><a onclick="javascript:showInactive();">Show Inactive</a></span>



</div>
</div>



<br />
<?




// Make the query:
$result = mysql_query("SELECT * From `Course` ORDER BY Name");		


// Table header:
echo '<table align="center" cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td align="left"><b>View</b></td>
	<td align="left"><b>Name</a></b></td>
	<td align="left"><b>Enrolled : Max</a></b></td>
	<td align="left"><b>% Full</b></td>
</tr>
';

// Fetch and print all the records....
echo "</b></b>";
$bg = '#eeeeee'; 
while ($row = mysql_fetch_array($result)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
	
	
	
	$cid = $row['ID'];
	if ($course->getStatus($cid) == 0)
	{
		echo '<tr bgcolor="' . $bg . '" class="inactive">';
	}
	else
	{
		echo '<tr bgcolor="' . $bg . '">';
	}
	
	
	
	
	
echo '
		<td align="left"><form action="view_class.php" method="post"><input type="hidden" name="ID" value="' . $row['ID'] . '"><input type="submit" value="View"></form></a></td>';
		
		echo '<td align="left">' . $course->getName($cid) . '</td>';
		echo '<td align="left">' . $course->totalEnrolled($cid) . ' : ' . $course->totalMaxOcc($cid) .'</td>';
		echo '<td align="left">' . $course->calculateCapacity($cid) . '%</td></tr>';	
			
		
} // End of WHILE loop.

echo '</table> ';





	
include ('includes/footer.html');

?>
