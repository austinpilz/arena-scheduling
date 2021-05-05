<? 
include ("includes/moby.php");
include ("../includes/classes.php");
$uid = $_GET["uid"];
$auth = $_GET["afid"];

$account = new Account();
$response = $account->deleteAccount($uid, $auth);
echo $response;
?>
