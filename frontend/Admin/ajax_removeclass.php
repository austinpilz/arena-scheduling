<? 
include ("includes/moby.php");
include ("../includes/classes.php");
$uid = $_GET["uid"];
$cid = $_GET["cid"];
$session = $_GET["session"];

$account = new Account();
$account->removeClass($uid, $cid, $session);
echo "1";
?>
