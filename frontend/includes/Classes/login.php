<?php
class MainLogin
{
	public static function checkLogin($username, $password, $ref)
	{
	
		
		//$auth = MainLogin::checkAuth($ref); for later implimentation regarding checking website referrer. Perhaps security setting choice?
		$auth = 1;
		if ($auth == 1)
		{
		
			$result = mysql_query("SELECT * FROM `Students` WHERE `Username` = CONVERT( _utf8 '$username' USING latin1 ) COLLATE latin1_general_ci AND `Password` = CONVERT( _utf8 '$password' USING latin1 ) COLLATE latin1_general_ci LIMIT 1");
			
			if (mysql_num_rows($result) == 1)
			{
				$row = mysql_fetch_array($result);
				$userID = $row[0];
				
				$session = new Session();
				$result = $session->setSession($userID);
				
				
				return $result;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 999;
		}
	}
	
	
	private function checkAuth($ref)
	{
		$result = mysql_query("SELECT * FROM `Referrer` WHERE `Service` ='1' AND `URL` = '$ref' LIMIT 1");
		return mysql_num_rows($result);
	}
		
}
?>