<?php
class Schedule
{
	public static function checkStaus($uid)
	{
		$user = new Account();
		
		$class1 = $user->getClassOne($uid);
		$class2 = $user->getClassTwo($uid);
		$class3 = $user->getClassThree($uid);
		

		if ($class1 > 0 && $class2 > 0 && $class3 > 0)
		{
			return 1; //completed
		}
		else
		{
			// check to see if any choices are saved
			
			if ($user->inProgress($uid) == 1) 
			{
				//in progress
				return 2;
				
			}
			else
			{
				return 0; //totally incomplete
			}
		}
		
	}
	
	
	
	public static function createSchedule($uid)
	{
		$choice = new Choice(); 
		
		for ($r=1; $r<=3; $r++)
		{
			$c[$r] = $choice->getChoice($uid, $r);
		}
		

		for ($j=1; $j<=3; $j++)
		{
			$ca1[$j] = Schedule::checkCourseAvailability($c[1], $j);
		}
		
		for ($j=1; $j<=3; $j++)
		{
			$ca2[$j] = Schedule::checkCourseAvailability($c[2], $j);
		}
		
		for ($j=1; $j<=3; $j++)
		{
			$ca3[$j] = Schedule::checkCourseAvailability($c[3], $j);
		}
		
		//for simulation purposes only
		//$ca1[1] = 0;
		//$ca2[1] = 0;
		//$ca3[1] = 0;
		
		
		
		//echo "Course 1(" . $c[1] . "):<br><br>Session 1: " . $ca1[1] . "<br>Session 2: " . $ca1[2] . "<br>Session 3: " . $ca1[3];
		//echo "<br><br>Course 2(" . $c[2] . "):<br><br>Session 1: " . $ca2[1] . "<br>Session 2: " . $ca2[2] . "<br>Session 3: " . $ca2[3];
		//echo "<br><br>Course 3(" . $c[3] . "):<br><br>Session 1: " . $ca3[1] . "<br>Session 2: " . $ca3[2] . "<br>Session 3: " . $ca3[3] . "<br><br>";
		
		
		//echo "<br><br><br><br><br><br><br>";
		//begin 
		$x = 0;
		$y = 0;
		$z = 0;
		$found = false;
		
		
		
		
			if ($ca1[1] && $ca2[2] && $ca3[3])
			{
				$result = mysql_query("UPDATE  `Students` SET  `Class1` =  '$c[1]', `Class2` =  '$c[2]', `Class3` =  '$c[3]' WHERE CONVERT(  `ID` USING utf8 ) =  '$uid' LIMIT 1");
				$found = true;
			}


			if ($ca1[1] && $ca2[3] && $ca3[2] && $found == false)
			{
				$result = mysql_query("UPDATE  `Students` SET  `Class1` =  '$c[1]', `Class2` =  '$c[3]', `Class3` =  '$c[2]' WHERE CONVERT(  `ID` USING utf8 ) =  '$uid' LIMIT 1");
				$found = true;
			}
			
			if ($ca1[2] && $ca2[1] && $ca3[3] && $found == false)
			{
				$result = mysql_query("UPDATE  `Students` SET  `Class1` =  '$c[2]', `Class2` =  '$c[1]', `Class3` =  '$c[3]' WHERE CONVERT(  `ID` USING utf8 ) =  '$uid' LIMIT 1");
				$found = true;
			}
			
			if ($ca1[2] && $ca2[3] && $ca3[1] && $found == false)
			{
				$result = mysql_query("UPDATE  `Students` SET  `Class1` =  '$c[3]', `Class2` =  '$c[1]', `Class3` =  '$c[2]' WHERE CONVERT(  `ID` USING utf8 ) =  '$uid' LIMIT 1");
				$found = true;
			}
			
			if ($ca1[3] && $ca2[1] && $ca3[2] && $found == false)
			{
				$result = mysql_query("UPDATE  `Students` SET  `Class1` =  '$c[2]', `Class2` =  '$c[3]', `Class3` =  '$c[1]' WHERE CONVERT(  `ID` USING utf8 ) =  '$uid' LIMIT 1");
				$found = true;
			}
			
			if ($ca1[3] && $ca2[2] && $ca3[1] && $found == false)
			{
				$result = mysql_query("UPDATE  `Students` SET  `Class1` =  '$c[3]', `Class2` =  '$c[2]', `Class3` =  '$c[1]' WHERE CONVERT(  `ID` USING utf8 ) =  '$uid' LIMIT 1");
				$found = true;
			}
			
		
		
		if ($found)
		{
			return 1;
		}
		else
		{
			
			return 0;
		}
		
		
		
		
		
		
		
		
		
	}
	
	private static function storeSchedule($uid, $combo)
	{
		
		
	}
	
	public static function setCourseOverride($uid, $course, $session)
	{
		
		//used to override schedule making process, used during swap course, in order to manually assign student to course / session
		if ($session == 1)
		{
			$result = mysql_query("UPDATE  `Students` SET  `Class1` =  '$course' WHERE CONVERT(  `ID` USING utf8 ) =  '$uid' LIMIT 1");
			return 1;
		}
		else if ($session == 2)
		{
			$result = mysql_query("UPDATE  `Students` SET  `Class2` =  '$course' WHERE CONVERT(  `ID` USING utf8 ) =  '$uid' LIMIT 1");
			return 1;
		}
		else if ($session == 3)
		{
			$result = mysql_query("UPDATE  `Students` SET  `Class3` =  '$course' WHERE CONVERT(  `ID` USING utf8 ) =  '$uid' LIMIT 1");
			return 1;
		}
		else
		{
			return 0;
		}
		
		
	}
	
	private static function debugPrint($ca1, $ca2, $ca3, $c)
	{
		
		echo "<br><br><br><br>Debug Output: <br><br><br>";
		echo "Outputting three choices: <br>";
		for ($r=1; $r<=3; $r++)
		{
			echo $c[$r] . "<br>";
		}
		
		
		for ($r=1; $r<=3; $r++)
		{
			echo "Course 1: (Session " . $r . ") " . $ca1[$r] . "<br>";
		}
		for ($r=1; $r<=3; $r++)
		{
			echo "Course 2: (Session " . $r . ") " . $ca2[$r] . "<br>";
		}
		for ($r=1; $r<=3; $r++)
		{
			echo "Course 3: (Session " . $r . ") " . $ca3[$r] . "<br>";
		}
	}
	
	private static function checkCourseAvailability ($cid, $sess)
	{
		$course = new Course();
		
		$max_oc = Course::getMaxOc($cid);
		
		
		$num=$course->getSessionEnrolled($cid, $sess);
	
		
		if ($num >= $max_oc || $course->getStatus($cid) == 0)
		{
			return 0;
		}
		else
		{
			return 1;
		}
		
	}
	
	public static function displaySchedule($uid)
	{
		$course = new Course();
		$user = new Account();
		$class1 = $user->getClassOne($uid);
		$class2 = $user->getClassTwo($uid);
		$class3 = $user->getClassThree($uid);
	
		echo "<HR WIDTH='100%' COLOR='#FF0000' SIZE='3'>";
		echo "<div align='center'><font size='+1'>CHARTIERS VALLEY MIDDLE SCHOOL CAREER DAY '" . date("y")  . "</font></div>";
		
		echo "<div align='center'><font size='-2'>Schedule for " . $user->getFirst($uid)  . " " . $user->getLast($uid) . " (Compiled " . date("F j Y") . ")</font></div>";
		echo "<br>Session 1: (1:00 - 1:30)<b> " . $course->getName($class1) ."</b> Room " . $course->getRoom($class1) ."";
		echo "<br>Session 2: (1:30 - 2:00)<b> " . $course->getName($class2) ."</b> Room " . $course->getRoom($class2) ."";
		echo "<br>Session 3: (2:00 - 2:30)<b> " . $course->getName($class3) ."</b> Room " . $course->getRoom($class3) ."<br>";
		
		
		echo '<HR WIDTH="100%" COLOR="#FF0000" SIZE="3"><div align="center">Copyright &copy; APM 2012 | All rights reserved</div>';

		
		
		
		
		
	}
	
	
	
}





?>