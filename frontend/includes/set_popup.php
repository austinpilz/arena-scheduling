<?php
include("moby.php");
include("classes.php");
$cookie = $_COOKIE["APMSMG_LoginSession"];
$session = new Session();
$userID = $session->getUser($cookie);

$choice = new Choice();
$choice->newChoice($_GET["id"], $userID);
?>

<script language="JavaScript" type="text/javascript">
window.close();
if (window.opener && !window.opener.closed) {
window.opener.location.reload();
} 
</script>