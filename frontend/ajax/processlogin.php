<?php
include ("../includes/moby.php");
include ("../includes/classes.php");
$main = new MainLogin();

$username = $_GET["username"];
$password = $_GET["password"];


	$status = $main->checkLogin($username, $password, $_SERVER['HTTP_REFERER']);
	
	
		if ($status != 0)
		{
			echo $status;
		}
		else
		{
			echo "0";
		}
	






?>