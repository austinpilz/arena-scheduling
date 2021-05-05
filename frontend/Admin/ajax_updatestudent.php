<?php
include ("includes/moby.php");
include ("../includes/classes.php");
$account = new Account();

$id = $_GET["id"];
$fname = $_GET["fname"];
$lname = $_GET["lname"];
$email = $_GET["email"];
$username = $_GET["username"];

$response = $account->updateAccount($id, $fname, $lname, $email, $username);
echo $response;





?>