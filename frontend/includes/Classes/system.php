<?php
class System
{
	public static function totalCourses()
	{
		$result = mysql_query("SELECT * FROM `Course`");
		$total = mysql_num_rows($result);
		return $total;
	}
	
	public static function activeCourses()
	{
		$result = mysql_query("SELECT * FROM `Course` WHERE `Active` != '0'");
		$total = mysql_num_rows($result);
		return $total;
	}
	
	public static function shutDown($reason)
	{
		//used to deactivate the system
		if ($reason == 032196 || $reason == 032197) //invalid license
		{
			System::shutDownNow();
		}
	}
	
	private static function shutDownNow() //called by shutDown to deactivate the system
	{
		$result = mysql_query("UPDATE `System` SET `Active` = '0' WHERE `Active` = '1' LIMIT 1 ;");
	}
	
	public static function checkSystem()
	{
		
		$result = mysql_query("SELECT * FROM `System`");
		$row = mysql_fetch_array($result);
		$status = $row['Active'];
		return $status;
	}
	
	public static function checkSecurity()
	{
		$result = mysql_query("SELECT * FROM `System`");
		$row = mysql_fetch_array($result);
		$security = $row['Security'];
		if ($security == 0)
		{
			return 1; //we're all good
		}
		else
		{
			return 0; //security lockdown enabled
		}
	}
	
	public static function systemBoot()
	{
		// all functions that need to be checked upon system boot
		// called every time admin visits dashboard
		
		if (License::validateLicense() != 1)
		{
			//License is Invalid/Not Activated/Corrupted - turn system off
			
			System::shutDown(032196);
			return "032196";
		}
		else
		{
			//check basic security status - make sure systen security lockdown wasn't marked as "1"
			if (System::checkSecurity() == 1)
			{
				return 1;
			}
			else
			{
				System::shutDown(032197);
				return "032197"; //security fail
			}
		}
		
		
	}
	
	
	
	
}

class License
{
	private static function getLicenseData() //used in all license functions, to get license data stored in MySQL database
	{
		$result = mysql_query("SELECT * FROM `License` LIMIT 1");
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	public static function validateLicense() //get license code, verify its ID
	{
		$license = License::getLicenseData();
		$id = $license['ID'];
		$type = $license['License_Type'];
		//later implimentation to check with main APM server to ensure license is in fact valid
		if ($id > 0 && $type > 0)
		{
			return 1; //valid
		}
		else
		{
			return 0; //not valid, or not activated
		}
		 
	}
	
	//GET FUNCTIONS
	public static function getLicenseID()
	{
		if (License::validateLicense() == 1)
		{
			$license = License::getLicenseData();
			$id = $license['ID'];
			return $id;
		}
		else
		{
			return 0;
		}
	}
	public static function getLicenseType()
	{
		if (License::validateLicense() == 1)
		{
			$data = License::getLicenseData();
			$type = $data['License_Type'];
			return $type;
		}
		else
		{
			return 0;
		}
	}
	
	
	
	
	
	
	
	
}

?>