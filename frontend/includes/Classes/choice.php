<?php

class Choice
{
	public static function getChoice($uid, $num)
	{
		$account = Choice::userInfo($uid);
		return $account['Choice' . $num];
	}
	
	public static function removeChoice($cid, $uid)
	{
		$c1 = Choice::getChoice($uid, 1); 
		$c2 = Choice::getChoice($uid, 2); 
		$c3 = Choice::getChoice($uid, 3); 
		
		if ($c1 == $cid)
		{
			$result = mysql_query("UPDATE `Students` SET `Choice1` = '0' WHERE `ID` = '$uid' LIMIT 1 ;");
		}
		if ($c2 == $cid)
		{
			$result = mysql_query("UPDATE `Students` SET `Choice2` = '0' WHERE `ID` = '$uid' LIMIT 1 ;");
		}
		if ($c3 == $cid)
		{
			$result = mysql_query("UPDATE `Students` SET `Choice3` = '0' WHERE `ID` = '$uid' LIMIT 1 ;");
		}
		
		
	}
	
	public static function newChoice($cid, $uid)
	{
		$c1 = Choice::getChoice($uid, 1); 
		$c2 = Choice::getChoice($uid, 2); 
		$c3 = Choice::getChoice($uid, 3); 
		
		if ($c1 > 0)
		{
			if ($c2 > 0)
			{
				if ($c3 > 0)
				{
					//all full
				}
				else
				{
					Choice::setChoice($uid, $cid, 3);
				}
			}
			else
			{
				Choice::setChoice($uid, $cid, 2);
			}
		}
		else
		{
			Choice::setChoice($uid, $cid, 1);
		}
		
	}
	
	private static function userInfo($id)
	{
		$result = mysql_query("SELECT * FROM `Students` WHERE `ID` = '$id' LIMIT 1");
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	private static function setChoice($uid, $cid, $cn)
	{
		$choice = "Choice" . $cn;
		$result = mysql_query("UPDATE `Students` SET `$choice` = '$cid' WHERE `ID` = '$uid' LIMIT 1 ;");
	}
	
}





?>