<?php
class Course
{
	public static function calculateCapacity($id)
	{
		$max_oc = Course::getMaxOc($id);
		
		$session_one_enrolled = Course::getSessionEnrolled($id, 1);
		$session_two_enrolled = Course::getSessionEnrolled($id, 2);
		$session_three_enrolled = Course::getSessionEnrolled($id, 3);
		
	
		$new_oc = Course::getMaxOc($id) * 3;
		$total_en = $session_one_enrolled + $session_two_enrolled + $session_three_enrolled;
		$per_full = ($total_en / $new_oc) * 100;
		$per_full = round($per_full, 0);
		
		return $per_full;
		
		
	}
	
	public static function totalEnrolled($cid)
	{
		$session_one_enrolled = Course::getSessionEnrolled($cid, 1);
		$session_two_enrolled = Course::getSessionEnrolled($cid, 2);
		$session_three_enrolled = Course::getSessionEnrolled($cid, 3);
		$total_enrolled = $session_one_enrolled + $session_two_enrolled + $session_three_enrolled;
		return $total_enrolled;
	}
	
	public static function totalMaxOcc($cid)
	{
		$new_oc = Course::getMaxOc($cid) * 3;
		return $new_oc;
	}
	
	public static function getSessionEnrolled($id, $session)
	{
		//gather how many users are enrolled in course per session, second paramater signifies which session
		 $result = mysql_query("SELECT * FROM `Students` WHERE `Class" . $session . "` = CONVERT( _utf8 '$id' USING latin1 ) COLLATE latin1_general_ci");
		 $enrolled = mysql_num_rows($result);
		 return $enrolled;		
	}
	
	public static function updateStatus($id, $action)
	{
		$result = mysql_query("UPDATE `Course` SET `Active` = '$action' WHERE `ID` = '$id' LIMIT 1 ;");
	}
	
	public static function getStatus($id)
	{
		$course = Course::courseInfo($id);
		return $course['Active'];
	}
	
	public static function getName($id)
	{
		$course = Course::courseInfo($id);
		return $course['Name'];
	}
	
	public static function getDesc($id)
	{
		$course = Course::courseInfo($id);
		return $course['Description'];
	}
	
	public static function getRoom($id)
	{
		$course = Course::courseInfo($id);
		return $course['Location'];
	}
	
	public static function getInst($id)
	{
		$course = Course::courseInfo($id);
		return $course['Instructor'];
	}
	
	public static function getMaxOc($id)
	{
		$course = Course::courseInfo($id);
		return $course['Max_Oc'];
	}
	
	private static function courseInfo($id)
	{
		$result = mysql_query("SELECT * FROM `Course` WHERE `ID` = '$id' LIMIT 1");
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	//////// UPDATING ////////
	
	public static function verifyUpdate($cid, $name, $room, $inst, $maxoc, $desc)
	{
		$enrolled = Course::totalEnrolled($cid);
		$n_maxoc = $maxoc * 3;
		if ($enrolled > $n_maxoc) //verifying that max oc hasn't changed - and if it has that it doesn't fuck with already enrolled students
		{
			return 985;
		}
		else
		{
			$response = Course::updateCourse($cid, $name, $room, $inst, $maxoc, $desc);
			return $response;
		}
		
	}
	
	private function updateCourse($cid, $name, $room, $inst, $maxoc, $desc)
	{
		$result = mysql_query("UPDATE `Course` SET `Name` = '$name', `Location` = '$room', `Instructor` = '$inst', `Max_Oc` = '$maxoc', `Description` = '$desc' WHERE `ID` = '$cid' LIMIT 1 ;");
		
		return 1;
		
		
	}
}

?>