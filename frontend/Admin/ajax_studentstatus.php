<? 
include ("includes/moby.php");
include ("../includes/classes.php");
$uid = $_GET["uid"];
$action = $_GET["action"];

$account = new Account();
$response = $account->updateStatus($uid, $action);

echo "1";
?>
