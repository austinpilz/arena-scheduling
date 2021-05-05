<?
include("classes.php");
include("moby.php");
$cookie = $_COOKIE["APMSMG_LoginSession"];
$session = new Session();
$user = new Account();
$schedule = new Schedule();
$auth = $session->checkSession($cookie);
$userID = $session->getUser($cookie);
$completed = $schedule->checkStaus($userID);

echo $completed;
?>

