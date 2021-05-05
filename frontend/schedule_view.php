<?
include("includes/classes.php");
include("includes/moby.php");
$cookie = $_COOKIE["APMSMG_LoginSession"];
$session = new Session();
$user = new Account();
$schedule = new Schedule();
$auth = $session->checkSession($cookie);
$userID = $session->getUser($cookie);
$completed = $schedule->checkStaus($userID);


$admin_check = mysql_query("SELECT * FROM `System` LIMIT 1");
$row = mysql_fetch_array($admin_check);
$active = $row[0];
$enroll = $row[1];
$security = $row[2];

if ($auth == 0)
{
	echo "Error: You're not logged in. You can login <a href='index.php'>here</a>";
	?>
    <body onload="window.close()">
    <?
}
else
{

	if ($completed)
	{
		$schedule->displaySchedule($userID);
	}
	



?>

<script type="text/javascript">
        function PrintWindow()
        {                     
           window.print();            
           CheckWindowState(); 
        }
        
        function CheckWindowState()
        {            
            if(document.readyState=="complete")
            {
                window.close();  
            }
            else
            {            
                setTimeout("CheckWindowState()", 2000)
            }
        }    
        
       PrintWindow();
</script>

<?
}


?>