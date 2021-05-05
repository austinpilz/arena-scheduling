<?php

class Account
{
	public static function getID($session)
	{
		$result = mysql_query("SELECT * FROM `Session` WHERE `SID` = '$id' LIMIT 1");
		if (mysql_num_rows($result) == 1)
		{
			$row = mysql_fetch_array($result);
			return $row['UID'];
		}
	}
	
	public static function removeClass($uid, $cid, $session)
	{
		$result = mysql_query("UPDATE `Students` SET `Class" . $session . "` = '' WHERE `ID` = '$uid' AND `Class" . $session ."` = '$cid' LIMIT 1 ;");
		return 1;
	}
	
	public static function getFirst($id)
	{
		$account = Account::userInfo($id);
		return $account['First'];
	}
	
	private function setFirst($id, $first)
	{
		$result = mysql_query("UPDATE `Students` SET `First` = '$first' WHERE `ID` = '$id' LIMIT 1 ;");
	}
	
	public static function getLast($id)
	{
		$account = Account::userInfo($id);
		return $account['Last'];
	}
	
	public static function getPassword($id)
	{
		$account = Account::userInfo($id);
		return $account['Password'];
	}
	
	private function setLast($id, $last)
	{
		$result = mysql_query("UPDATE `Students` SET `Last` = '" . $last . "' WHERE `ID` = '$id' LIMIT 1 ;");
	}
	
	public static function getUsername($id)
	{
		$account = Account::userInfo($id);
		return $account['Username'];
	}
	
	private function setUsername($id, $username)
	{
		$result = mysql_query("UPDATE `Students` SET `Username` = '" . $username . "' WHERE `ID` = '$id' LIMIT 1 ;");
	}
	
	public static function getEmail($id)
	{
		$account = Account::userInfo($id);
		return $account['Email'];
	}
	
	private function setEmail($id, $email)
	{
		$result = mysql_query("UPDATE `Students` SET `Email` = '" . $email . "' WHERE `ID` = '$id' LIMIT 1 ;");
	}
	
	public static function getStatus($id)
	{
		$account = Account::userInfo($id);
		return $account['Status'];
	}
	
	public static function getClassOne($id)
	{
		$account = Account::userInfo($id);
		return $account['Class1'];
	}
	
	public static function getClassTwo($id)
	{
		$account = Account::userInfo($id);
		return $account['Class2'];
	}
	
	public static function getClassThree($id)
	{
		$account = Account::userInfo($id);
		return $account['Class3'];
	}
	
	// course choices
	
		public static function choiceOne($id)
		{
			$account = Account::userInfo($id);
			return $account['Choice' . 1];
		}
		
		public static function choiceTwo($id)
		{
			$account = Account::userInfo($id);
			return $account['Choice' . 2];
		}
		
		public static function choiceThree($id)
		{
			$account = Account::userInfo($id);
			return $account['Choice' . 3];
		}
		
	public static function inProgress($id)
	{
		if (Account::choiceOne($id) > 0 || Account::choiceTwo($id) > 0 || Account::choiceThree($id))
		{
			//yep, in progress
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	private static function userInfo($id)
	{
		$result = mysql_query("SELECT * FROM `Students` WHERE `ID` = '$id' LIMIT 1");
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	public static function updateStatus($id, $action)
	{
		if ($action == 1)
		{
			Account::makeActive($id);
			return 1;
		}
		else if ($active == 0)
		{
			Account::makeInActive($id);
			return 1;
		}
	}
	
		private function makeActive($id)
		{
			$result = mysql_query("UPDATE `Students` SET `Status` = '1' WHERE `ID` = '$id' LIMIT 1 ;");
		}
		
		private function makeInActive($id)
		{
			$result = mysql_query("UPDATE `Students` SET `Status` = '0' WHERE `ID` = '$id' LIMIT 1 ;");
		}
		
	
	public static function updateAccount($id, $fname, $lname, $email, $username)
	{
		Account::setFirst($id, $fname); 
		Account::setLast($id, $lname); 
		Account::setEmail($id, $email); 
		Account::setUsername($id, $username); 
		
		return 1;
		
		
	}
	
	public static function deleteAccount($id, $auth)
	{
		//auth implentation here
		$response = Account::removeAccount($id);
		echo $response;
		
	}
		private function removeAccount($id)
		{
			$result = mysql_query("DELETE FROM `Students` WHERE `ID` = '$id' LIMIT 1;");
			return 1;
		}
		
		public static function clearSchedule($id)
	{
		//auth implentation here
		$result = mysql_query("UPDATE  `Career`.`Students` SET  `Choice1` =  '',
`Choice2` =  '',
`Class1` =  '',
`Class2` =  '',
`Class3` =  '' WHERE  `Students`.`ID` =169657 LIMIT 1 ;");
		echo $response;
		
	}
	
	
	
}
?>