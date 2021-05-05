CREATE DATABASE `db384047107` DEFAULT CHARACTER SET latin1 COLLATE latin1_german2_ci;
USE db384047107;

-- --------------------------------------------------------

-- 
-- Table structure for table `Admins`
-- We LOVE a plaintext password.
-- 

CREATE TABLE `Admins` (
  `ID` varchar(5000) collate latin1_german2_ci NOT NULL,
  `First` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Last` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Email` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Password` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Super` varchar(5000) collate latin1_german2_ci NOT NULL,
  `View_Only` varchar(5000) collate latin1_german2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci COMMENT='Table for Teacher/Admin';

-- 
-- Dumping data for table `Admins`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `Course`
-- 

CREATE TABLE `Course` (
  `ID` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Name` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Description` mediumtext collate latin1_german2_ci NOT NULL,
  `Location` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Instructor` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Max_Oc` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Active` varchar(5000) collate latin1_german2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- 
-- Dumping data for table `Course`
-- 

INSERT INTO `Course` VALUES ('98765678', 'Chiropractor', ' ', 'Library', 'Medical Professional', '16', '1');


-- --------------------------------------------------------

-- 
-- Table structure for table `Referrer`
-- 

CREATE TABLE `Referrer` (
  `ID` int(10) NOT NULL,
  `Service` int(10) NOT NULL,
  `URL` varchar(100) collate latin1_german2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- 
-- Dumping data for table `Referrer`
-- 

INSERT INTO `Referrer` VALUES (86522, 1, 'http://austinpilzmedia.com/Career');
INSERT INTO `Referrer` VALUES (991736, 1, 'http://austinpilzmedia.com/Career/index.php');
INSERT INTO `Referrer` VALUES (973, 1, 'http://austinpilzmedia.com/Career/ajax/processlogin.php');

-- --------------------------------------------------------

-- 
-- Table structure for table `Session`
-- 

CREATE TABLE `Session` (
  `SID` varchar(100) collate latin1_german2_ci NOT NULL,
  `UID` varchar(10) collate latin1_german2_ci NOT NULL,
  `Date` datetime NOT NULL,
  `Assigned` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- 
-- Dumping data for table `Session`
-- 

INSERT INTO `Session` VALUES ('eabc47ebd82ece1b16ace7e0deae7e61', '169657', '2012-04-25 17:19:59', 1);
INSERT INTO `Session` VALUES ('43fbad62fd4af7497d65fed27d649ba3', '169657', '2012-04-25 19:13:40', 1);
INSERT INTO `Session` VALUES ('324dc0b1264eda9da6b0967596793063', '492842', '2012-04-25 20:52:26', 1);
INSERT INTO `Session` VALUES ('ea41eb2a2a9b68859be6784c658c8420', '69673', '2012-04-25 22:57:18', 1);
INSERT INTO `Session` VALUES ('a80aa3413a958d85cfb6833277acba61', '169657', '2012-04-27 12:44:59', 1);
INSERT INTO `Session` VALUES ('cd68e191f2947c987f354b79e720735a', '169657', '2012-05-05 16:52:49', 1);
INSERT INTO `Session` VALUES ('2ebaa800840d23a82dc8910a64a31cfd', '169657', '2012-05-15 13:38:10', 1);
INSERT INTO `Session` VALUES ('03d1c53b7f9f27920e6303b206dc75b9', '169657', '2012-05-15 14:25:47', 1);
INSERT INTO `Session` VALUES ('e9a8a015da6c9f6ca9734f58eed35df1', '169657', '2012-06-17 22:18:28', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `Session1`
-- 

CREATE TABLE `Session1` (
  `ID` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Student` varchar(5000) collate latin1_german2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- 
-- Dumping data for table `Session1`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `Session2`
-- 

CREATE TABLE `Session2` (
  `ID` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Student` varchar(5000) collate latin1_german2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- 
-- Dumping data for table `Session2`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `Session3`
-- 

CREATE TABLE `Session3` (
  `ID` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Student` varchar(5000) collate latin1_german2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- 
-- Dumping data for table `Session3`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `Students`
-- 

CREATE TABLE `Students` (
  `ID` int(255) NOT NULL,
  `Username` varchar(255) collate latin1_german2_ci NOT NULL,
  `Password` varchar(255) collate latin1_german2_ci NOT NULL,
  `First` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Last` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Email` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Choice1` varchar(5000) collate latin1_german2_ci NOT NULL default '0',
  `Choice2` varchar(5000) collate latin1_german2_ci NOT NULL default '0',
  `Choice3` varchar(5000) collate latin1_german2_ci NOT NULL default '0',
  `Class1` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Class2` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Class3` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Status` tinyint(1) NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- 
-- Dumping data for table `Students`
-- 

INSERT INTO `Students` VALUES (169657, 'austinpilz', '169657', 'austin', 'pilz', 'leave@me.alone', '98765678', '4626599', '463464574567', '', '', '', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `System`
-- 

CREATE TABLE `System` (
  `Active` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Enroll` varchar(5000) collate latin1_german2_ci NOT NULL,
  `Security` varchar(5000) collate latin1_german2_ci NOT NULL,
  `PerFull` tinyint(1) NOT NULL,
  `PrintSch` tinyint(1) NOT NULL,
  `EmailSch` tinyint(1) NOT NULL,
  `Survey` tinyint(1) NOT NULL,
  `Min_Oc` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- 
-- Dumping data for table `System`
-- 

INSERT INTO `System` VALUES ('1', '1', '0', 0, 0, 0, 0, 10);
