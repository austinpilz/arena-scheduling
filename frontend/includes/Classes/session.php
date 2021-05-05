<?php
class Session
{
	public static function checkSession($id) //called by cookie.php
	{
		$id = md5($id);
		$result = mysql_query("SELECT * FROM `Session` WHERE `SID` = '$id' LIMIT 1");
		if (mysql_num_rows($result) == 1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
	
	public static function cookieCheckSession($id)
	{
		$id = md5($id);
		$result = mysql_query("SELECT * FROM `Session` WHERE `SID` = '$id' AND `Assigned` = 0 LIMIT 1");
		if (mysql_num_rows($result) == 1)
		{
			$result = mysql_query("UPDATE `Session` SET `Assigned` = '1' WHERE `SID` = '$id' LIMIT 1 ;");
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	public static function setSession($userID) //called by checkLogin
	{
		srand ((double) microtime( )*1000000);
		$sess_id = rand( );
		$sess_id_e = md5($sess_id);
		$result = mysql_query("INSERT INTO  `Session` (  `SID` ,  `UID`, `Date`, `Assigned`) VALUES ('$sess_id_e', '$userID', now(), 0);");
		return $sess_id;
			
	}
	
	public static function getUser($id)
	{
		$id = md5($id);
		$result = mysql_query("SELECT * FROM `Session` WHERE `SID` = '$id' LIMIT 1");
		$row = mysql_fetch_array($result);
		return $row['UID'];
	}
}

?>