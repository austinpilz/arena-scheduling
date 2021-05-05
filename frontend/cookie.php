<?php
include("includes/moby.php");
include("includes/classes.php");

$session = $_GET["session"];
$main = new Session();
$check = $main->cookieCheckSession($session);


if ($check == 1)
{
	setcookie("APMSMG_LoginSession", $session, time()+2400);  /* expires in 40 min */
	?>
    <meta http-equiv="REFRESH" content="0;url=home.php">
	<div align="center">One moment while you're redirected. If you're not automatically redirected, <a href='home.php'>click here</a></div>
	<?
}
else
{
	echo '<meta http-equiv="REFRESH" content="0;url=Career">';
	//echo $session;
	//echo "<br>" . md5($session);
	
}






?>
