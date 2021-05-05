<?php
class Accounts extends Account
{
	public static function totalStudents()
	{
		$result = mysql_query("SELECT * FROM `Students`");
		$total = mysql_num_rows($result);
		return $total;
	}
	
	public static function activeStudents()
	{
		$result = mysql_query("SELECT * FROM `Students` WHERE `Status` != '0'");
		$total = mysql_num_rows($result);
		return $total;
	}
	
	public static function studentsComplete()
	{
		$result = mysql_query("SELECT * FROM `Students` WHERE `Class1` > '0' AND `Class2` > '0' AND `Class3` > '0'");
		$total = mysql_num_rows($result);
		return $total;
	}
	
	public static function generateInitialData()
	{
		//ONLY CALL ONCE
		$total = Accounts::initialData();
		return $total;
		
	}
	
	public static function studentsIncomplete()
	{
		$total = Accounts::activeStudents() - Accounts::studentsComplete();
		return $total;
	}
	
	public static function regenerateUsernames()
	{
		//impliment backup feature here that stores data to another mysql table just in case
		$number = Accounts::generateUsernames(); //returns number of usernames regenerated
		return $number;
		
	}
	
	public static function regeneratePasswords()
	{
		//impliment backup feature here that stores data to another mysql table just in case
		$number = Accounts::generatePasswords(); //returns number of passwords regenerated
		return $number;
		
	}
		private static function generateUsernames()
		{
			$num = 0;
			$result = mysql_query("SELECT * From `Students` ORDER BY Last");
			while ($row = mysql_fetch_array($result)) {
	
			$rf = $row[3];
			$rl = $row[4];
			$id = $row[0];
			
			$first = strtolower($row[3]); //convert to all lowercase
			$last = strtolower($row[4]); //convert to all lowercase
			
			$username = substr($first, 0) . "." . $last;
			
			$resulty = mysql_query("UPDATE  `Students` SET  `Username` =  '$username' WHERE  CONVERT(  `ID` USING utf8 ) =  '$id' LIMIT 1");
			if ($result)
			{
				if (mysql_affected_rows())
				{
					$num = $num + 1;
				}
			}
			
			}
			return $num; //ACTUALLY RETURNS HOW MANY WERE ACTUALLY CHANGED
		}
		
		private static function generatePasswords()
		{
			$num = 0;
			$result = mysql_query("SELECT * From `Students` ORDER BY Last");
			while ($row = mysql_fetch_array($result)) {
	
			$rf = $row[3];
			$rl = $row[4];
			$og_id = $row[0];
			
			$first = strtolower($row[3]); //convert to all lowercase
			$last = strtolower($row[4]); //convert to all lowercase
			
			$id = rand(1000, 500000);
			$password = $id;
			
			$resulty = mysql_query("UPDATE  `Students` SET  `ID` =  '$password', `Password` =  '$password' WHERE  CONVERT(  `ID` USING utf8 ) =  '$og_id' LIMIT 1");
			if ($result)
			{
				if (mysql_affected_rows())
				{
					$num = $num + 1;
				}
			}
			
			}
			return $num; //ACTUALLY RETURNS HOW MANY WERE ACTUALLY CHANGED
		}
		
		
		private static function initialData()
		{
			$result = mysql_query("SELECT * From `Students` ORDER BY Last");
			$num = 0;
			while ($row = mysql_fetch_array($result)) {
				
				$rf = $row[3];
				$rl = $row[4];
				
				$first = strtolower($row[3]);
				$last = strtolower($row[4]);
				$id = rand(1000, 500000);
				
				$username = substr($first, 0) . "." . $last;
				$password = $id;
				
				$resulty = mysql_query("UPDATE  `Students` SET  `ID` =  '$id', `Username` =  '$username', `Password` =  '$password', `First` = '$first', `Last` = '$last' WHERE  CONVERT(  `First` USING utf8 ) =  '$rf' AND CONVERT(  `Last` USING utf8 ) =  '$rl' LIMIT 1 ;");
				
				if ($result)
				{
					if (mysql_affected_rows())
					{
						$num = $num + 1;
					}
				}
			
				
			}
			return $num;
		}
}

?>