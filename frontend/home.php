
<?php
$page_title = "APM Schedule Generator";
include ("includes/moby.php");
include ("includes/header.html");
include ("includes/menu.html");
include("includes/classes.php");

$cookie = $_COOKIE["APMSMG_LoginSession"];
$session = new Session();
$user = new Account();
$auth = $session->checkSession($cookie);
if ($auth == 0)
{
	echo '<meta http-equiv="REFRESH" content="0;url=http://austinpilzmedia.com/Career">';
}
else
{
	$userID = $session->getUser($cookie);
	
}//end if auth then show

?>
<h1>Welcome <? echo $user->getFirst($userID); ?></h1>
<img src="images/arrows.png" align="left">
<br><br><br><br>


<?
include ('includes/footer.html');
?>   