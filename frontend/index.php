<?
include ("includes/moby.php");
//if ($_GET["log_out"] == 1)
//	{
	//	$cookie = $_COOKIE["APMSMG_LoginSession"];
	//	setcookie ("APMSMG_LoginSession", "", time() - 3600);
	//	$result = mysql_query("DELETE FROM `Session` WHERE `SID` = '$cookie' LIMIT 1");
	//}
 ?>

<script type="text/javascript" src="https://fightthemirror.com/js/cufon-yui.js"></script>
<script type="text/javascript" src="https://fightthemirror.com/js/arial.js"></script>
<script type="text/javascript" src="https://fightthemirror.com/js/cuf_run.js"></script>
<script type="text/javascript" src="https://fightthemirror.com/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="https://fightthemirror.com/js/radius.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="login.js"></script>
<link rel="stylesheet" href="includes/login.css" type="text/css" charset="utf-8" />

<?php 
$page_title = "APM Schedule Generator";
include ("includes/header.html");
include ("includes/login_menu.html");
include("includes/classes.php");

echo "<h1>Login</h1>";

$admin_check = mysql_query("SELECT * FROM `System` LIMIT 1");
$row = mysql_fetch_array($admin_check);
$active = $row[0];
$enroll = $row[1];
$security = $row[2];

if ($active == 0 || $security == 1)
{
	echo "<br><div class='clean-notice'>The APM Schedule Matrix Generator is currently unavailable</div>";
}
else
{
	
	
	
	$cookie = $_COOKIE["APMSMG_LoginSession"];
	$session = new Session();
	$auth = $session->checkSession($cookie);
	if ($auth == 1)
	{
		echo '<meta http-equiv="REFRESH" content="0;url=home.php">';
	}
	else
	{
		
		
	
		echo "<div class='done'></div>";
		
		echo "<br><br><span align='center'>";
		
		echo "<span class='incorrect'><div class='clean-notice'>We could not locate an account with the provided login credentials</div></span><br>";
		
		echo "<div class='loginform'>";
		
		?>
				  <form name="login" method="post" action="index.php">
		
		<div class="element">
			<label>Username:</label>
			<input type="text" id="username" name="username"  />
		</div>
		<div class="element">
			<label>Password:</label>
			<input type="password" id="password" name="pass"  />
		</div>
	   
		
		 
		<div class="element">
			 
			<input type="submit" id="submit" value="Login"/>
			<div class="loading"></div>
		</div>
		</form>
		
		
		<?
		
		echo "</form></span></div>";
	}


}
include ('includes/footer.html');
?>   
</body>