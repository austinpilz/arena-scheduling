<? 
include ("includes/moby.php");
include ("../includes/classes.php");
$cid = $_GET["cid"];
$action = $_GET["action"];

$course = new Course();
$response = $course->updateStatus($cid, $action);
echo "1";
?>
