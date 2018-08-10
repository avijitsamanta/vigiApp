-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2018 at 12:04 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vigilant`
--

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_admin`
--

CREATE TABLE IF NOT EXISTS `vigilant_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(30) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `admin_type` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vigilant_admin`
--

INSERT INTO `vigilant_admin` (`admin_id`, `admin_username`, `admin_password`, `admin_type`) VALUES
(1, 'master', '123456', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_blocked_user`
--

CREATE TABLE IF NOT EXISTS `vigilant_blocked_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `blocked_user` int(11) NOT NULL,
  `is_blocked` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_comment`
--

CREATE TABLE IF NOT EXISTS `vigilant_comment` (
  `cmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `cmt_desc` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `cmt_posted` datetime NOT NULL,
  `cmt_updated` datetime NOT NULL,
  PRIMARY KEY (`cmt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `vigilant_comment`
--

INSERT INTO `vigilant_comment` (`cmt_id`, `post_id`, `cmt_desc`, `user_id`, `cmt_posted`, `cmt_updated`) VALUES
(1, 1, 'Test Test', 3, '2016-12-05 04:11:11', '0000-00-00 00:00:00'),
(22, 18, 'Hello from Jeet', 58, '2016-12-19 13:55:05', '0000-00-00 00:00:00'),
(24, 19, 'Gdjsbdjdb dbi. Djc dnd end Jc djdjevf xhe. Fahd d djd d djd scene Jc riches chevdb did s she. Die d JD djd. Djd d do djd d e', 57, '2016-12-19 13:57:35', '0000-00-00 00:00:00'),
(25, 1, 'Fjggu hyhb Hun KGB KGB jgjbjkh. KGB nah. My. MLB. Mlhgdj mgkb oh.hb g \nBillion hilm kills lb  \n Kith Hh ', 58, '2016-12-19 16:58:12', '0000-00-00 00:00:00'),
(26, 21, 'Where at??', 63, '2016-12-21 12:58:23', '0000-00-00 00:00:00'),
(27, 23, 'Found. Thank you all for your help!', 63, '2016-12-21 13:00:21', '0000-00-00 00:00:00'),
(28, 24, '10am', 63, '2016-12-21 13:01:41', '0000-00-00 00:00:00'),
(29, 24, 'Thanks!', 63, '2016-12-21 13:01:48', '0000-00-00 00:00:00'),
(30, 28, 'Thanks', 63, '2016-12-21 13:58:07', '0000-00-00 00:00:00'),
(34, 28, 'Nsnsnnna', 66, '2016-12-29 17:37:56', '0000-00-00 00:00:00'),
(35, 29, 'Cool', 30, '2017-02-13 14:25:54', '0000-00-00 00:00:00'),
(36, 28, 'Cool', 30, '2017-02-13 14:26:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_crime_type`
--

CREATE TABLE IF NOT EXISTS `vigilant_crime_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `crime_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `vigilant_crime_type`
--

INSERT INTO `vigilant_crime_type` (`type_id`, `crime_name`, `status`) VALUES
(1, 'Murder', 1),
(2, 'Robbery', 1),
(3, 'Rape', 1),
(7, 'Kidnapping', 0),
(8, 'Assault', 1),
(10, 'Theft', 1),
(11, 'Vandalism', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_device_details`
--

CREATE TABLE IF NOT EXISTS `vigilant_device_details` (
  `device_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `device_type` enum('A','I') NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`device_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `vigilant_device_details`
--

INSERT INTO `vigilant_device_details` (`device_id`, `user_id`, `device_type`, `device_token`, `status`) VALUES
(1, 1, '', '', '1'),
(2, 65, '', '', '1'),
(3, 58, '', '', '1'),
(4, 57, '', '', '1'),
(5, 30, '', '', '1'),
(6, 65, '', '', '1'),
(7, 58, '', '', '1'),
(8, 58, '', '', '1'),
(9, 57, '', '', '1'),
(10, 58, '', '', '1'),
(11, 58, '', '', '1'),
(12, 57, '', '', '1'),
(13, 56, 'I', '16c100391c28de2d7bbe1a5b6d6278082fd40e80d5bcaecfe11fb6e4c730d657', '1'),
(14, 65, '', '', '1'),
(15, 57, '', '', '1'),
(16, 58, '', '', '1'),
(17, 58, '', '', '1'),
(18, 57, '', '', '1'),
(19, 57, '', '', '1'),
(20, 65, '', '', '1'),
(21, 58, '', '', '1'),
(22, 57, 'I', '', '1'),
(23, 65, '', '', '1'),
(24, 58, '', '', '1'),
(25, 65, '', '', '1'),
(26, 66, 'I', '74282f750507d630b94002d467f1fe5bbd38e7a786f16531e9ede5de06924c85', '1'),
(27, 65, 'I', '', '1'),
(28, 30, 'I', 'ebdee78c8d6d82ae03ffe0367fe64d72d18a66106f0110986d7600e07fd9b92e', '1'),
(29, 19, 'I', '910bccad797eab1cdc177168bdd5b130e58f515413c41f8190726a9eb775a85f', '1'),
(30, 68, 'I', '', '1'),
(31, 21, '', '', '1'),
(32, 68, '', '', '1'),
(33, 4, '', '', '1'),
(34, 58, 'I', 'e097e5c62896682fc5e51abf0356f3e63a18d499cbf13ae3cb9022903af7b1f1', '1'),
(35, 4, 'I', 'a7f0bb15b7e29d45064f040492a7be0690b33f823e717cd44ed1d2199da17692', '1'),
(36, 70, '', '', '1'),
(37, 69, '', '', '1'),
(38, 62, '', '', '1'),
(39, 72, 'I', 'cd5053f8819a8ec576ad9b7657931feb938d89fb6829d8dac30ef529161f180d', '1'),
(40, 73, 'I', '', '1'),
(41, 74, 'I', '', '1'),
(42, 75, 'I', '7932e16cc652391164658961cdad1f35e605e58d61b6fc9caadc663aee10f765', '1'),
(43, 76, '', '', '1'),
(44, 77, 'I', 'c0a5eb5b4b3772fefc2437673e96b22c5e2d3cf3e619fcb88b43ddb9dca55f1f', '1'),
(45, 78, 'I', '', '1'),
(46, 79, 'I', '97247a8e221a6488a21ea912e1c4662138cd250abee8162d5ec90b43df03135f', '1'),
(47, 31, 'I', 'c5f82a98fce5d2cf3ff232431bbe5b0a017a2746ced028de965f20e7dbd6cf1e', '1'),
(48, 80, 'I', '', '1'),
(49, 81, 'I', 'e399b4508b899a5779384f8c37ec951f3482ebe8dbda8670a06236fced1482e9', '1'),
(50, 82, 'I', '', '1'),
(51, 83, 'I', '', '1'),
(52, 85, 'I', '', '1'),
(53, 86, 'I', '', '1'),
(54, 87, 'I', '', '1'),
(55, 88, 'I', '', '1'),
(56, 89, 'I', '', '1'),
(57, 90, 'I', '', '1'),
(58, 2, 'I', 'I3462323', '1'),
(59, 76, 'I', 'I3462323', '1'),
(63, 62, 'A', 'A3423', '1'),
(65, 95, 'I', 'I3462323', '1'),
(66, 96, 'I', 'I3462323', '1'),
(67, 20, 'I', '4fd948ef6d55c43fd4b298dadd768ef2128ed5902f9f4d3fa9210ec1fba180c5', '1'),
(68, 97, 'I', 'f123d36af5b0bcbf4ac4f9a01ce1027fce58dfbc21db9d257cfef1d3834e6227', '1'),
(69, 99, 'I', 'I3462323', '1'),
(70, 100, 'I', 'I3462323', '1'),
(71, 101, 'I', '10c3104316f2f6a7bc615f8e72b2bf26c4c1f91b84ad2ba1afc0cacd529a9dd2', '1'),
(72, 102, 'I', 'I3462323', '1'),
(73, 103, 'I', 'I3462323', '1'),
(74, 18, 'I', '', '1'),
(75, 104, 'I', '', '1'),
(76, 106, 'I', '21160ba1eb743585220fb239f95afcff142ad7ceb4b85e708586b1ee69f5da90', '1'),
(77, 107, 'I', 'I346232365546', '1'),
(78, 110, 'I', 'I3462323', '1'),
(79, 111, 'I', 'I3462323', '1'),
(80, 112, 'I', 'I3462323', '1'),
(81, 62, 'I', 'I3462323', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_distance`
--

CREATE TABLE IF NOT EXISTS `vigilant_distance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distance_covered` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vigilant_distance`
--

INSERT INTO `vigilant_distance` (`id`, `distance_covered`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_emergency_contact`
--

CREATE TABLE IF NOT EXISTS `vigilant_emergency_contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `emerg_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `vigilant_emergency_contact`
--

INSERT INTO `vigilant_emergency_contact` (`contact_id`, `user_id`, `emerg_name`, `contact_no`, `status`) VALUES
(3, 1, 'Avijit', '3434098967', 1),
(5, 1, 'avijit', '968676757', 1),
(6, 1, 'avijit', '343434545334534456', 1),
(7, 1, 'avisam', '5466756756', 1),
(9, 97, 'Abhishek Kumar', '9000000000', 1),
(11, 57, 'Abhishek Kumar', '99999999958', 1),
(13, 57, 'ffhklgfd', '58285269', 1),
(14, 58, 'Abhishek', '+91907495785', 1),
(15, 4, 'trst', '123456789', 1),
(16, 4, 'reet', '258866', 1),
(17, 30, 'Christine', '7146973133', 1),
(18, 104, 'A', '+9185635882587', 1),
(19, 30, 'Brandon', '5596231936', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_notifications`
--

CREATE TABLE IF NOT EXISTS `vigilant_notifications` (
  `notify_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `notify_msg_title` text NOT NULL,
  `notify_msg_body` text NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`notify_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=252 ;

--
-- Dumping data for table `vigilant_notifications`
--

INSERT INTO `vigilant_notifications` (`notify_id`, `user_id`, `report_id`, `notify_msg_title`, `notify_msg_body`, `status`) VALUES
(79, 56, 96, 'Assault', 'Asaul asault', '1'),
(81, 56, 97, 'Assault', 'Asaul asault', '1'),
(83, 56, 98, 'Vandalism', 'By av', '1'),
(86, 56, 99, 'Assault', 'Asaul asault', '1'),
(88, 56, 100, 'Vandalism', 'By av', '1'),
(91, 56, 101, 'Vandalism', 'By av', '1'),
(94, 56, 102, 'Vandalism', 'Jet ghost was beaten severely and badly wounded. Criminal: The girl gang!', '1'),
(96, 56, 103, 'Vandalism', 'By av', '1'),
(99, 56, 104, 'Vandalism', 'By av', '1'),
(102, 56, 105, 'Assault', 'Criminals', '1'),
(105, 56, 106, 'Assault', 'Criminals', '1'),
(188, 65, 151, 'Murder', '', '1'),
(223, 65, 171, 'Murder', 'Murder of Jeet''s privacy.', '1'),
(228, 65, 173, 'Rape', 'Ha I ', '1'),
(229, 57, 174, 'Robbery', 'Ok I will work with the app but not proper review but it is a good game too', '1'),
(230, 65, 174, 'Robbery', 'Ok I will work with the app but not proper review but it is a good game too', '1'),
(231, 57, 175, 'Robbery', 'Band she dx dj', '1'),
(232, 65, 175, 'Robbery', 'Band she dx dj', '1'),
(234, 65, 176, 'Murder', 'Murder of Jeet''s privacy.', '1'),
(235, 66, 177, 'Murder', '', '1'),
(236, 65, 177, 'Murder', '', '1'),
(237, 66, 177, 'Murder', '', '1'),
(238, 66, 177, 'Murder', '', '1'),
(239, 66, 178, 'Rape', '', '1'),
(240, 65, 178, 'Rape', '', '1'),
(242, 66, 178, 'Rape', '', '1'),
(243, 57, 179, 'Rape', '', '1'),
(244, 65, 179, 'Rape', '', '1'),
(245, 57, 180, 'Murder', '', '1'),
(246, 65, 180, 'Murder', '', '1'),
(247, 57, 181, 'Assault', 'Gahd', '1'),
(248, 65, 181, 'Assault', 'Gahd', '1'),
(249, 57, 182, 'Robbery', 'Hddhdh\n', '1'),
(250, 65, 182, 'Robbery', 'Hddhdh\n', '1'),
(251, 97, 186, 'Robbery', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_notification_data`
--

CREATE TABLE IF NOT EXISTS `vigilant_notification_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  `crime_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `vigilant_notification_data`
--

INSERT INTO `vigilant_notification_data` (`id`, `user_id`, `distance`, `crime_type`) VALUES
(1, 57, 80, '10,9,8,7,3,2,1'),
(3, 58, 100, '7,3,2,1'),
(4, 56, 50, '7'),
(5, 30, 50, '3,7'),
(6, 65, 100, '10,9,8,3,2,1'),
(7, 66, 81, '9,8,7,3,1'),
(8, 78, 64, '10,9,8,3,2,1'),
(9, 97, 3, '11,10,8,3,2,1');

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_pics`
--

CREATE TABLE IF NOT EXISTS `vigilant_pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gplaceid` varchar(255) NOT NULL,
  `user_type` enum('custom','admin') NOT NULL,
  `crime_pics` varchar(255) NOT NULL,
  `upload_path` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=248 ;

--
-- Dumping data for table `vigilant_pics`
--

INSERT INTO `vigilant_pics` (`id`, `report_id`, `user_id`, `gplaceid`, `user_type`, `crime_pics`, `upload_path`, `status`) VALUES
(1, 1, 17, 'ChIJBeB5Twbb_3sRKIbMdNKCd0s', 'custom', 'userphoto_1479722085.jpg', 'upload/crime_pics/', 0),
(2, 10, 17, 'ChIJLbZ-NFv9DDkRQJY4FbcFcgM', 'custom', 'userphoto_1479722139.jpg', 'upload/crime_pics/', 0),
(3, 10, 17, 'ChIJLbZ-NFv9DDkRQJY4FbcFcgM', 'custom', 'userphoto_1479722144.jpg', 'upload/crime_pics/', 0),
(4, 10, 17, 'ChIJLbZ-NFv9DDkRQJY4FbcFcgM', 'custom', 'userphoto_1479722159.jpg', 'upload/crime_pics/', 0),
(13, 9, 29, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1479725852.jpg', 'upload/crime_pics/', 0),
(14, 9, 29, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1479725862.jpg', 'upload/crime_pics/', 0),
(16, 0, 29, 'ChIJAYWNSLS4QIYROwVl894CDco', 'custom', 'userphoto_1479729464.jpg', 'upload/crime_pics/', 0),
(17, 0, 29, 'ChIJAYWNSLS4QIYROwVl894CDco', 'custom', 'userphoto_1479729470.jpg', 'upload/crime_pics/', 0),
(19, 0, 29, 'ChIJrQfILRJuToYRvaxp3fiLr6Q', 'custom', 'userphoto_1479729878.jpg', 'upload/crime_pics/', 0),
(20, 0, 29, 'ChIJrQfILRJuToYRvaxp3fiLr6Q', 'custom', 'userphoto_1479729900.jpg', 'upload/crime_pics/', 0),
(21, 0, 29, 'ChIJGVtI4by3t4kRr51d_Qm_x58', 'custom', 'userphoto_1479730025.jpg', 'upload/crime_pics/', 0),
(22, 0, 29, 'ChIJ141OPOzfm4ARyfw0wYgvF20', 'custom', 'userphoto_1479730060.jpg', 'upload/crime_pics/', 0),
(23, 0, 29, 'ChIJ141OPOzfm4ARyfw0wYgvF20', 'custom', 'userphoto_1479730073.jpg', 'upload/crime_pics/', 0),
(24, 0, 29, 'ChIJ141OPOzfm4ARyfw0wYgvF20', 'custom', 'userphoto_1479730093.jpg', 'upload/crime_pics/', 0),
(25, 0, 29, 'ChIJV4FfHcU28YgR5xBP7BC8hGY', 'custom', 'userphoto_1479730154.jpg', 'upload/crime_pics/', 0),
(26, 0, 17, 'ChIJf0dSgjnmaC4Rfp2O_FSkGLw', 'custom', 'userphoto_1479731000.jpg', 'upload/crime_pics/', 0),
(27, 0, 17, 'ChIJf0dSgjnmaC4Rfp2O_FSkGLw', 'custom', 'userphoto_1479731057.jpg', 'upload/crime_pics/', 0),
(28, 0, 17, 'ChIJMVd4MymgVA0R99lHx5Y__Ws', 'custom', 'userphoto_1479731385.jpg', 'upload/crime_pics/', 0),
(29, 0, 17, 'ChIJV4FfHcU28YgR5xBP7BC8hGY', 'custom', 'userphoto_1479732276.jpg', 'upload/crime_pics/', 0),
(30, 0, 17, 'ChIJdd4hrwug2EcRmSrV3Vo6llI', 'custom', 'userphoto_1479732364.jpg', 'upload/crime_pics/', 0),
(31, 0, 17, 'ChIJdd4hrwug2EcRmSrV3Vo6llI', 'custom', 'userphoto_1479732382.jpg', 'upload/crime_pics/', 0),
(32, 0, 17, 'ChIJMVd4MymgVA0R99lHx5Y__Ws', 'custom', 'userphoto_1479732498.jpg', 'upload/crime_pics/', 0),
(61, 4, 17, 'ChIJj0i_N0xaozsR1Xx10YzS8UE', 'custom', 'userphoto_1479817353.jpg', 'upload/crime_pics/', 0),
(64, 4, 17, 'ChIJj0i_N0xaozsR1Xx10YzS8UE', 'custom', 'userphoto_1479818284.jpg', 'upload/crime_pics/', 0),
(74, 11, 17, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1479907260.jpg', 'upload/crime_pics/', 0),
(75, 11, 17, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1479907269.jpg', 'upload/crime_pics/', 0),
(76, 11, 17, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1479907279.jpg', 'upload/crime_pics/', 0),
(77, 11, 17, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1479907298.jpg', 'upload/crime_pics/', 0),
(78, 8, 29, 'ChIJ946yAeBwAjoRPViIcfTfHIE', 'custom', 'userphoto_1479968980.jpg', 'upload/crime_pics/', 0),
(79, 8, 29, 'ChIJ946yAeBwAjoRPViIcfTfHIE', 'custom', 'userphoto_1479968995.jpg', 'upload/crime_pics/', 0),
(81, 9, 29, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1479970526.jpg', 'upload/crime_pics/', 0),
(83, 4, 17, 'ChIJj0i_N0xaozsR1Xx10YzS8UE', 'custom', 'userphoto_1479972241.jpg', 'upload/crime_pics/', 0),
(84, 4, 17, 'ChIJj0i_N0xaozsR1Xx10YzS8UE', 'custom', 'userphoto_1479972681.jpg', 'upload/crime_pics/', 0),
(85, 4, 17, 'ChIJj0i_N0xaozsR1Xx10YzS8UE', 'custom', 'userphoto_1479972850.jpg', 'upload/crime_pics/', 0),
(86, 4, 17, 'ChIJj0i_N0xaozsR1Xx10YzS8UE', 'custom', 'userphoto_1479972927.jpg', 'upload/crime_pics/', 0),
(88, 4, 17, 'ChIJj0i_N0xaozsR1Xx10YzS8UE', 'custom', 'userphoto_1479973221.jpg', 'upload/crime_pics/', 0),
(89, 4, 17, 'ChIJj0i_N0xaozsR1Xx10YzS8UE', 'custom', 'userphoto_1479973289.jpg', 'upload/crime_pics/', 0),
(90, 4, 17, 'ChIJj0i_N0xaozsR1Xx10YzS8UE', 'custom', 'userphoto_1479973396.jpg', 'upload/crime_pics/', 0),
(100, 0, 17, 'ChIJ6du4Abp1AjoRnscs42BEKbs', 'custom', 'userphoto_1479974951.jpg', 'upload/crime_pics/', 0),
(102, 0, 17, 'ChIJ6du4Abp1AjoRnscs42BEKbs', 'custom', 'userphoto_1479976872.jpg', 'upload/crime_pics/', 0),
(103, 0, 17, 'ChIJ6du4Abp1AjoRnscs42BEKbs', 'custom', 'userphoto_1479976882.jpg', 'upload/crime_pics/', 0),
(111, 0, 17, 'ChIJ6du4Abp1AjoRnscs42BEKbs', 'custom', 'userphoto_1479997540.jpg', 'upload/crime_pics/', 0),
(113, 3, 17, 'ChIJ6du4Abp1AjoRnscs42BEKbs', 'custom', 'userphoto_1479997598.jpg', 'upload/crime_pics/', 0),
(114, 0, 17, 'ChIJnSm0MbLiDDkRWcGjtw1sYMw', 'custom', 'userphoto_1479998018.jpg', 'upload/crime_pics/', 0),
(115, 0, 17, 'ChIJnSm0MbLiDDkRWcGjtw1sYMw', 'custom', 'userphoto_1479998041.jpg', 'upload/crime_pics/', 0),
(116, 0, 17, 'ChIJAYWNSLS4QIYROwVl894CDco', 'custom', 'userphoto_1479998219.jpg', 'upload/crime_pics/', 0),
(120, 0, 17, 'ChIJRcbZaklDXz4RYlEphFBu5r0', 'custom', 'userphoto_1480053239.jpg', 'upload/crime_pics/', 0),
(121, 0, 17, 'ChIJRcbZaklDXz4RYlEphFBu5r0', 'custom', 'userphoto_1480053258.jpg', 'upload/crime_pics/', 0),
(123, 0, 17, 'ChIJRcbZaklDXz4RYlEphFBu5r0', 'custom', 'userphoto_1480053311.jpg', 'upload/crime_pics/', 0),
(124, 86, 17, 'ChIJRcbZaklDXz4RYlEphFBu5r0', 'custom', 'userphoto_1480053337.jpg', 'upload/crime_pics/', 0),
(126, 62, 17, 'ChIJ6du4Abp1AjoRnscs42BEKbs', 'custom', 'userphoto_1480053416.jpg', 'upload/crime_pics/', 0),
(129, 15, 17, 'ChIJRcbZaklDXz4RYlEphFBu5r0', 'custom', 'userphoto_1480071475.jpg', 'upload/crime_pics/', 0),
(130, 16, 17, 'ChIJcZGoRwtx9zkR3QngV9sbnkI', 'custom', 'userphoto_1480072585.jpg', 'upload/crime_pics/', 0),
(131, 17, 31, 'ChIJAayDIFDc3IARft_dbPwxWNE', 'custom', 'userphoto_1480408050.jpg', 'upload/crime_pics/', 0),
(132, 17, 31, 'ChIJAayDIFDc3IARft_dbPwxWNE', 'custom', 'userphoto_1480408058.jpg', 'upload/crime_pics/', 0),
(133, 17, 31, 'ChIJAayDIFDc3IARft_dbPwxWNE', 'custom', 'userphoto_1480408064.jpg', 'upload/crime_pics/', 0),
(134, 17, 31, 'ChIJAayDIFDc3IARft_dbPwxWNE', 'custom', 'userphoto_1480408071.jpg', 'upload/crime_pics/', 0),
(135, 17, 31, 'ChIJAayDIFDc3IARft_dbPwxWNE', 'custom', 'userphoto_1480408078.jpg', 'upload/crime_pics/', 0),
(136, 18, 17, 'ChIJzfkTj8drTIcRP0bXbKVK370', 'custom', 'userphoto_1480421708.jpg', 'upload/crime_pics/', 0),
(137, 19, 41, 'ChIJZ_YISduC-DkRvCxsj-Yw40M', 'custom', 'userphoto_1480577706.jpg', 'upload/crime_pics/', 0),
(138, 23, 42, 'ChIJXYSLiq11AjoRmxkV9l4mAhA', 'custom', 'userphoto_1480590045.jpg', 'upload/crime_pics/', 0),
(139, 23, 42, 'ChIJXYSLiq11AjoRmxkV9l4mAhA', 'custom', 'userphoto_1480590067.jpg', 'upload/crime_pics/', 0),
(140, 24, 36, 'ChIJWzeYoxfP5zsR7b9f1W5YTWc', 'custom', 'userphoto_1480592678.jpg', 'upload/crime_pics/', 0),
(141, 25, 36, 'ChIJWzeYoxfP5zsR7b9f1W5YTWc', 'custom', 'userphoto_1480593497.jpg', 'upload/crime_pics/', 0),
(142, 26, 36, 'ChIJWzeYoxfP5zsR7b9f1W5YTWc', 'custom', 'userphoto_1480594096.jpg', 'upload/crime_pics/', 0),
(143, 0, 36, 'ChIJWzeYoxfP5zsR7b9f1W5YTWc', 'custom', 'userphoto_1480594381.jpg', 'upload/crime_pics/', 0),
(144, 27, 36, 'ChIJWzeYoxfP5zsR7b9f1W5YTWc', 'custom', 'userphoto_1480594510.jpg', 'upload/crime_pics/', 0),
(145, 28, 42, 'ChIJX8oAvkmC-DkR6NZLL8SWVD8', 'custom', 'userphoto_1480595029.jpg', 'upload/crime_pics/', 0),
(146, 34, 42, 'ChIJZ_YISduC-DkRvCxsj-Yw40M', 'custom', 'userphoto_1480595631.jpg', 'upload/crime_pics/', 0),
(147, 37, 36, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1480658158.jpg', 'upload/crime_pics/', 0),
(153, 43, 48, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1481882812.jpg', 'upload/crime_pics/', 0),
(154, 43, 48, 'ChIJY_6ZFZZ1AjoRQrkrNQG__1M', 'custom', 'userphoto_1481882930.jpg', 'upload/crime_pics/', 0),
(155, 99, 48, 'ChIJY_6ZFZZ1AjoRQrkrNQG__1M', 'custom', 'userphoto_1481882964.jpg', 'upload/crime_pics/', 0),
(156, 94, 48, 'ChIJcSUF4qZ1AjoRtf_PtyjUxhY', 'custom', 'userphoto_1481883218.jpg', 'upload/crime_pics/', 0),
(157, 0, 48, 'ChIJcSUF4qZ1AjoRtf_PtyjUxhY', 'custom', 'userphoto_1481883520.jpg', 'upload/crime_pics/', 0),
(158, 0, 48, 'ChIJsbUi45N3AjoR9VdBHymQLiU', 'custom', 'userphoto_1481883587.jpg', 'upload/crime_pics/', 0),
(159, 44, 48, 'ChIJcSUF4qZ1AjoRtf_PtyjUxhY', 'custom', 'userphoto_1481883722.jpg', 'upload/crime_pics/', 0),
(160, 45, 57, 'ChIJsbUi45N3AjoR9VdBHymQLiU', 'custom', 'userphoto_1482137250.jpg', 'upload/crime_pics/', 0),
(161, 46, 58, 'ChIJcSUF4qZ1AjoRtf_PtyjUxhY', 'custom', 'userphoto_1482137522.jpg', 'upload/crime_pics/', 0),
(162, 47, 57, 'ChIJAYWNSLS4QIYROwVl894CDco', 'custom', 'userphoto_1482143785.jpg', 'upload/crime_pics/', 0),
(163, 48, 30, 'ChIJ538Rphfc3IARSWjcCQ54sNg', 'custom', 'userphoto_1482200287.jpg', 'upload/crime_pics/', 0),
(164, 49, 30, 'ChIJAayDIFDc3IARft_dbPwxWNE', 'custom', 'userphoto_1482200381.jpg', 'upload/crime_pics/', 0),
(165, 50, 30, 'ChIJQ_jUAlDc3IARX6kVbkAAPvo', 'custom', 'userphoto_1482200432.jpg', 'upload/crime_pics/', 0),
(166, 51, 30, 'ChIJ42zOaUXc3IAR-RvpOJJzJQg', 'custom', 'userphoto_1482200473.jpg', 'upload/crime_pics/', 0),
(167, 0, 30, 'ChIJ42zOaUXc3IAR-RvpOJJzJQg', 'custom', 'userphoto_1482200534.jpg', 'upload/crime_pics/', 0),
(168, 52, 30, 'ChIJVyIF5k_c3IARBlvcN22a3rQ', 'custom', 'userphoto_1482200616.jpg', 'upload/crime_pics/', 0),
(169, 53, 30, 'ChIJE6bpc6solYARY3SMsxq0-64', 'custom', 'userphoto_1482355041.jpg', 'upload/crime_pics/', 0),
(170, 54, 59, 'ChIJE6bpc6solYARY3SMsxq0-64', 'custom', 'userphoto_1482355196.jpg', 'upload/crime_pics/', 0),
(171, 55, 59, 'ChIJKYfr04LYlIARDkgLAe7jklU', 'custom', 'userphoto_1482355250.jpg', 'upload/crime_pics/', 0),
(172, 56, 59, 'EixNb29uZXkgQm91bGV2YXJkLCBWaXNhbGlhLCBDQSwgVW5pdGVkIFN0YXRlcw', 'custom', 'userphoto_1482355328.jpg', 'upload/crime_pics/', 0),
(173, 57, 63, 'EiYxNCBCZWFyIFBhdywgSXJ2aW5lLCBDQSwgVW5pdGVkIFN0YXRlcw', 'custom', 'userphoto_1482371190.jpg', 'upload/crime_pics/', 0),
(174, 0, 65, 'ChIJn-Bbnah1AjoRdqlEnRkXMJc', 'custom', 'userphoto_1482820243.jpg', 'upload/crime_pics/', 0),
(175, 69, 65, 'ChIJn-Bbnah1AjoRdqlEnRkXMJc', 'custom', 'userphoto_1482820391.jpg', 'upload/crime_pics/', 0),
(176, 65, 58, 'ChIJxWib_3gDGTkRHkuZub5MllU', 'custom', 'userphoto_1482820500.jpg', 'upload/crime_pics/', 0),
(177, 91, 58, 'ChIJn-Bbnah1AjoRdqlEnRkXMJc', 'custom', 'userphoto_1482820838.jpg', 'upload/crime_pics/', 0),
(178, 87, 58, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1482829778.jpg', 'upload/crime_pics/', 0),
(179, 88, 65, 'ChIJvbZ596V1AjoRFDvsmG9ziJ4', 'custom', 'userphoto_1482831485.jpg', 'upload/crime_pics/', 0),
(180, 92, 58, 'ChIJCTDp1Ld1AjoRumjRcD9FW5o', 'custom', 'userphoto_1482917309.jpg', 'upload/crime_pics/', 0),
(181, 104, 65, 'ChIJXYSLiq11AjoRmxkV9l4mAhA', 'custom', 'userphoto_1482928726.jpg', 'upload/crime_pics/', 0),
(182, 102, 57, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1482928929.jpg', 'upload/crime_pics/', 0),
(183, 106, 65, 'ChIJXYSLiq11AjoRmxkV9l4mAhA', 'custom', 'userphoto_1482929115.jpg', 'upload/crime_pics/', 0),
(184, 107, 65, 'ChIJgU-8Ea91AjoRciDQs9IiVTw', 'custom', 'userphoto_1482929257.jpg', 'upload/crime_pics/', 0),
(185, 172, 65, 'ChIJXYSLiq11AjoRmxkV9l4mAhA', 'custom', 'userphoto_1482929326.jpg', 'upload/crime_pics/', 0),
(186, 110, 58, 'ChIJ78IJek5YwokRvVV8rYzRhhw', 'custom', 'userphoto_1482930058.jpg', 'upload/crime_pics/', 0),
(187, 115, 65, 'ChIJXYSLiq11AjoRmxkV9l4mAhA', 'custom', 'userphoto_1482930550.jpg', 'upload/crime_pics/', 0),
(188, 120, 65, 'ChIJQarxaK51AjoRbpEHQ-jlw9Q', 'custom', 'userphoto_1482930685.jpg', 'upload/crime_pics/', 0),
(189, 123, 65, 'ChIJQarxaK51AjoRbpEHQ-jlw9Q', 'custom', 'userphoto_1482931126.jpg', 'upload/crime_pics/', 0),
(190, 152, 65, 'ChIJuaWYAzV1AjoRJTQyRLJl4XU', 'custom', 'userphoto_1482931267.jpg', 'upload/crime_pics/', 0),
(191, 151, 58, 'ChIJUVFUV-Z1AjoRZ_VSDr4NNGc', 'custom', 'userphoto_1482935794.jpg', 'upload/crime_pics/', 0),
(192, 153, 65, 'ChIJAYZcF851AjoRRhDQfcEjfu8', 'custom', 'userphoto_1482935945.jpg', 'upload/crime_pics/', 0),
(193, 170, 65, 'ChIJLZ9vmE10AjoR2ftJs2B-Plw', 'custom', 'userphoto_1482987238.jpg', 'upload/crime_pics/', 0),
(194, 176, 57, 'ChIJu8hg2K91AjoRi3cELRWQaok', 'custom', 'userphoto_1483010938.jpg', 'upload/crime_pics/', 0),
(195, 173, 66, 'ChIJLZ9vmE10AjoR2ftJs2B-Plw', 'custom', 'userphoto_1483011065.jpg', 'upload/crime_pics/', 0),
(196, 174, 66, 'ChIJCTDp1Ld1AjoRumjRcD9FW5o', 'custom', 'userphoto_1483011129.jpg', 'upload/crime_pics/', 0),
(197, 175, 66, 'ChIJn0SJYdhwAjoRkng1fTiGQUg', 'custom', 'userphoto_1483011247.jpg', 'upload/crime_pics/', 0),
(198, 0, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013688.jpg', 'upload/crime_pics/', 0),
(199, 0, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013698.jpg', 'upload/crime_pics/', 0),
(200, 0, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013709.jpg', 'upload/crime_pics/', 0),
(201, 0, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013726.jpg', 'upload/crime_pics/', 0),
(202, 0, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013737.jpg', 'upload/crime_pics/', 0),
(203, 0, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013744.jpg', 'upload/crime_pics/', 0),
(204, 177, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013875.jpg', 'upload/crime_pics/', 0),
(205, 177, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013896.jpg', 'upload/crime_pics/', 0),
(206, 177, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013902.jpg', 'upload/crime_pics/', 0),
(207, 177, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013909.jpg', 'upload/crime_pics/', 0),
(208, 177, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483013921.jpg', 'upload/crime_pics/', 0),
(210, 178, 57, 'ChIJpymoC8QKAjoRWgMCCYJCNA4', 'custom', 'userphoto_1483014061.jpg', 'upload/crime_pics/', 0),
(211, 0, 57, 'ChIJQbc2YxC6vzsRkkDzYv-H-Oo', 'custom', 'userphoto_1483014832.jpg', 'upload/crime_pics/', 0),
(212, 0, 57, 'ChIJQbc2YxC6vzsRkkDzYv-H-Oo', 'custom', 'userphoto_1483014960.jpg', 'upload/crime_pics/', 0),
(213, 0, 57, 'ChIJn3cRVJUSlR4R4jhUy8fnnm0', 'custom', 'userphoto_1483015001.jpg', 'upload/crime_pics/', 0),
(214, 0, 57, 'ChIJTfgMjPrHvzsRV3U0LSIp1Lc', 'custom', 'userphoto_1483015190.jpg', 'upload/crime_pics/', 0),
(215, 0, 57, 'ChIJTfgMjPrHvzsRV3U0LSIp1Lc', 'custom', 'userphoto_1483015197.jpg', 'upload/crime_pics/', 0),
(216, 0, 57, 'ChIJTfgMjPrHvzsRV3U0LSIp1Lc', 'custom', 'userphoto_1483015204.jpg', 'upload/crime_pics/', 0),
(217, 0, 57, 'ChIJTfgMjPrHvzsRV3U0LSIp1Lc', 'custom', 'userphoto_1483015209.jpg', 'upload/crime_pics/', 0),
(218, 0, 57, 'ChIJTfgMjPrHvzsRV3U0LSIp1Lc', 'custom', 'userphoto_1483015216.jpg', 'upload/crime_pics/', 0),
(219, 0, 57, 'ChIJQbc2YxC6vzsRkkDzYv-H-Oo', 'custom', 'userphoto_1483015468.jpg', 'upload/crime_pics/', 0),
(220, 179, 66, 'EjxDaGluZ3JpZ2hhdGEgRmx5b3ZlciwgTmFiYXBhbGx5LCBLb2xrYXRhLCBXZXN0IEJlbmdhbCwgSW5kaWE', 'custom', 'userphoto_1483015881.jpg', 'upload/crime_pics/', 0),
(221, 180, 66, 'ChIJDUy0VA51AjoR2uix1BvNgjE', 'custom', 'userphoto_1483015946.jpg', 'upload/crime_pics/', 0),
(222, 181, 66, 'ChIJXYSLiq11AjoRmxkV9l4mAhA', 'custom', 'userphoto_1483016006.jpg', 'upload/crime_pics/', 0),
(223, 182, 66, 'ChIJUVFUV-Z1AjoRZ_VSDr4NNGc', 'custom', 'userphoto_1483017896.jpg', 'upload/crime_pics/', 0),
(224, 173, 66, 'ChIJLZ9vmE10AjoR2ftJs2B-Plw', 'custom', 'userphoto_1483046238.jpg', 'upload/crime_pics/', 0),
(226, 0, 104, 'ChIJ1_zpad05dYgRzravrqd7NlM', 'custom', 'userphoto_1487075467.jpg', 'upload/crime_pics/', 0),
(227, 0, 1, '', 'custom', 'slide_3_1487075960.jpeg', 'upload/crime_pics/', 0),
(228, 0, 104, 'ChIJQbc2YxC6vzsRkkDzYv-H-Oo', 'custom', 'userphoto_1487078055.jpg', 'upload/crime_pics/', 0),
(229, 0, 104, 'ChIJQbc2YxC6vzsRkkDzYv-H-Oo', 'custom', 'userphoto_1487078071.jpg', 'upload/crime_pics/', 0),
(230, 0, 104, '', 'custom', 'userphoto_1487078813.jpg', 'upload/crime_pics/', 0),
(231, 186, 104, '', 'custom', 'userphoto_1487079543.jpg', 'upload/crime_pics/', 0),
(232, 185, 104, '', 'custom', 'userphoto_1487081652.jpg', 'upload/crime_pics/', 0),
(233, 0, 1, '', 'custom', 'images5_1487145832.jpg', 'upload/crime_pics/', 0),
(243, 199, 0, '', 'admin', '1487863061slide_3.jpeg', 'upload/crime_pics/', 0),
(244, 199, 0, '', 'admin', '1487863061slide_2.jpeg', 'upload/crime_pics/', 0),
(246, 199, 0, '', 'admin', '1487863148slide_1.jpeg', 'upload/crime_pics/', 0),
(247, 38, 0, '', 'admin', '1489560846index.jpeg', 'upload/crime_pics/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_posts`
--

CREATE TABLE IF NOT EXISTS `vigilant_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_desc` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `posted_date` datetime NOT NULL,
  `post_updated` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `vigilant_posts`
--

INSERT INTO `vigilant_posts` (`post_id`, `post_desc`, `user_id`, `posted_date`, `post_updated`, `status`) VALUES
(1, 'Hi Hi Hi Hi Test', 2, '2016-12-05 14:59:30', '2016-12-05 19:11:33', 0),
(18, 'This is a new post added from iPhone 5', 57, '2016-12-19 13:51:09', '0000-00-00 00:00:00', 0),
(20, 'Neighborhood watch meeting tonight at 8pm.', 19, '2016-12-20 14:14:10', '0000-00-00 00:00:00', 0),
(21, 'OC Animal adoption day in the park!!! Agust 24th, 9 am to 4 pm ', 63, '2016-12-21 12:56:50', '0000-00-00 00:00:00', 0),
(22, 'Irvine Police Department neighborhood safety meeting. August 29th. ', 63, '2016-12-21 12:58:05', '0000-00-00 00:00:00', 0),
(23, 'LOST DOG ALERT!!!!!!! Bulldog mix, brown, 2 years old. Please contact if you have any information.', 63, '2016-12-21 12:59:48', '0000-00-00 00:00:00', 0),
(24, 'Does anyone lnow what time movies in the park starts this Saturday??', 63, '2016-12-21 13:01:26', '0000-00-00 00:00:00', 0),
(25, 'City Council metting tomorrow night at 8pm. ', 63, '2016-12-21 13:03:28', '2016-12-21 13:54:15', 0),
(26, 'Where will the Farmers Market be this Sunday?', 63, '2016-12-21 13:55:37', '0000-00-00 00:00:00', 0),
(27, 'Neighborhood Alert! UPS packages being stolen off doorsteps. Keep an extra close on on your deliveries.', 63, '2016-12-21 13:56:39', '0000-00-00 00:00:00', 0),
(28, 'Culver and Main will be closed this week due to construction. ', 63, '2016-12-21 13:57:37', '0000-00-00 00:00:00', 0),
(29, 'Testing post', 66, '2016-12-29 17:41:27', '0000-00-00 00:00:00', 0),
(30, 'Test', 30, '2017-02-13 14:26:11', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_reply`
--

CREATE TABLE IF NOT EXISTS `vigilant_reply` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `cmt_id` int(11) NOT NULL,
  `reply_desc` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply_added` datetime NOT NULL,
  `reply_updated` datetime NOT NULL,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `vigilant_reply`
--

INSERT INTO `vigilant_reply` (`reply_id`, `cmt_id`, `reply_desc`, `user_id`, `reply_added`, `reply_updated`) VALUES
(1, 4, 'test test test test ccccccccccccccccccccddadasdasdasda', 9, '2016-12-07 13:43:21', '2016-12-07 14:58:46'),
(17, 22, 'Wassbup?????????????????????????', 58, '2016-12-19 13:55:49', '2016-12-19 17:19:44'),
(19, 22, 'At least write correct spelling....it should be "what''s up" :D :Dv', 57, '2016-12-19 13:59:44', '2016-12-19 16:01:10'),
(20, 30, 'Yo. ', 66, '2016-12-29 17:34:47', '2016-12-29 17:35:05'),
(21, 30, 'Hajahabana aba ana. Ana ababa. Shabana. Aha a baba ahah ahaha a ahaha aha ababa snjavahavanaha a ahaha anan smash a ahaha Shaba Shan ababa ', 66, '2016-12-29 17:35:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_report`
--

CREATE TABLE IF NOT EXISTS `vigilant_report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `crime_type_id` int(11) NOT NULL,
  `crime_date` date NOT NULL,
  `crime_time` time NOT NULL,
  `crime_location` text NOT NULL,
  `gplaceid` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `upload_path` varchar(255) NOT NULL,
  `user_type` enum('custom','admin') NOT NULL,
  `crime_video` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=200 ;

--
-- Dumping data for table `vigilant_report`
--

INSERT INTO `vigilant_report` (`report_id`, `user_id`, `crime_type_id`, `crime_date`, `crime_time`, `crime_location`, `gplaceid`, `latitude`, `longitude`, `date_added`, `date_updated`, `upload_path`, `user_type`, `crime_video`, `description`, `status`) VALUES
(4, 17, 2, '2016-11-21', '15:34:38', 'Rajpath Area, New Delhi, Delhi, India', 'ChIJj0i_N0xaozsR1Xx10YzS8UE', '28.6134806', '77.2189594', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'upload/crime_video/', 'custom', '', '', 0),
(6, 29, 3, '2016-11-21', '16:11:02', 'Kansas, United States', 'ChIJawF8cXEXo4cRXwk-S6m0wmg', '39.011902', '-98.4842465', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'upload/crime_video/', 'custom', 'crime_video_1479724939.mp4', '', 0),
(7, 29, 3, '2016-11-21', '16:13:06', 'Kansas City, MO, United States', 'ChIJl5npr173wIcRolGqauYlhVU', '39.0997265', '-94.5785667', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'upload/crime_video/', 'custom', 'crime_video_1479725080.mp4', 'Hdioenf', 0),
(8, 29, 3, '2016-11-21', '16:15:45', 'Golf Green, Kolkata, West Bengal, India', 'ChIJ946yAeBwAjoRPViIcfTfHIE', '22.4931376', '88.36217809999999', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'upload/crime_video/', 'custom', 'crime_video_1479725481.mp4', 'Cfg\nYusuf snide did did did dogs  z\n\nLucky dogfight oh it''s Ohio it''s igcigxk', 0),
(9, 0, 3, '2016-11-21', '16:26:53', 'EN Block, Kolkata, West Bengal, India', 'ChIJu8hg2K91AjoRi3cELRWQaok', '22.5742586', '88.4313014', '2017-02-23 19:03:59', '0000-00-00 00:00:00', 'upload/crime_video/', 'admin', 'crime_video_1479725874.mp4', '', 0),
(11, 17, 1, '2016-11-23', '18:12:38', 'EN Block, Kolkata, West Bengal, India', 'ChIJu8hg2K91AjoRi3cELRWQaok', '22.5742586', '88.4313014', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'upload/crime_video/', 'custom', 'crime_video_1479907348.mp4', 'Crime description updated', 0),
(13, 1, 1, '2016-10-14', '17:11:10', 'kolkata', 'gp123462', '22.57265', '88.363996', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'custom', '', 'murder', 0),
(15, 17, 2, '2016-11-25', '16:24:36', 'Burj Khalifa - Sheikh Mohammed bin Rashid Boulevard - Dubai - United Arab Emirates', 'ChIJRcbZaklDXz4RYlEphFBu5r0', '25.19686459999999', '55.2743494', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'custom', '', 'Ghost Protocol', 0),
(23, 42, 2, '2016-12-01', '16:29:56', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'custom', '', 'The fact I can get it right away with a lot more fun if you I just want to be go on a the first half of this year is to be the best way rooted for the rest will come to my friends are so many things to o to the game and is now the world is what text yey or not the to be the first half of the day before my alarm goes of my friends to and the other rest is a history exam eand eto e a week early .\n', 0),
(27, 36, 2, '2016-12-01', '17:44:42', 'Vadala, Mumbai, Maharashtra, India', 'ChIJWzeYoxfP5zsR7b9f1W5YTWc', '19.0151285', '72.8580644', '0000-00-00 00:00:00', '2016-12-02 11:25:14', '', 'custom', '', '', 0),
(31, 42, 1, '2016-12-01', '18:03:27', 'Kolkata, West Bengal, India', 'ChIJZ_YISduC-DkRvCxsj-Yw40M', '22.572646', '88.36389500000001', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(33, 1, 1, '2016-12-13', '17:11:10', 'kolkata', 'gp123462', '22.57265', '88.363996', '2016-12-01 00:00:00', '2016-12-01 19:16:05', 'upload/crime_video/', 'custom', '', 'murder', 0),
(34, 44, 1, '2016-10-14', '17:11:10', 'kolkata', 'gp123462', '22.57265', '88.363996', '2016-12-01 19:52:47', '2016-12-01 19:56:30', '', 'custom', '', 'murder', 0),
(37, 36, 2, '2016-12-02', '11:25:24', 'EN Block, Kolkata, West Bengal, India', 'ChIJu8hg2K91AjoRi3cELRWQaok', '22.5742586', '88.4313014', '2016-12-02 11:26:01', '2016-12-02 11:26:34', '', 'custom', '', '', 0),
(38, 44, 2, '2016-10-20', '12:15:00', 'kolkata', 'gp123462', '22.5726', '88.3639', '2016-12-02 20:13:31', '2017-03-15 12:24:06', '', 'custom', '', 'murder', 0),
(42, 48, 7, '2016-12-16', '15:35:47', 'EN Block, Kolkata, West Bengal, India', 'ChIJu8hg2K91AjoRi3cELRWQaok', '22.5742586', '88.4313014', '2016-12-16 15:37:11', '0000-00-00 00:00:00', '', 'custom', '', 'Crime 1 Test 1', 0),
(43, 48, 1, '2016-12-16', '15:35:47', 'Sector 2, Salt Lake City, West Bengal, India', 'ChIJY_6ZFZZ1AjoRQrkrNQG__1M', '22.5913113', '88.4234245', '2016-12-16 15:39:40', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(44, 48, 3, '2016-12-16', '15:51:27', 'Technopolis, AP Block, Kolkata, West Bengal, India', 'ChIJcSUF4qZ1AjoRtf_PtyjUxhY', '22.580616', '88.43792999999999', '2016-12-16 15:52:07', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(48, 30, 9, '2016-12-16', '18:09:11', '3300 Park Avenue, Tustin, CA, United States', 'ChIJ538Rphfc3IARSWjcCQ54sNg', '33.70241859999999', '-117.8193475', '2016-12-20 07:48:09', '0000-00-00 00:00:00', '', 'custom', '', 'Car windshield smashed', 0),
(49, 30, 9, '2016-12-19', '18:18:20', '13 Bear Paw, Irvine, CA, United States', 'ChIJAayDIFDc3IARft_dbPwxWNE', '33.6953262', '-117.7964316', '2016-12-20 07:49:45', '0000-00-00 00:00:00', '', 'custom', '', 'Vandalism ', 0),
(50, 30, 8, '2016-12-14', '18:19:44', '3 Bear Paw, Irvine, CA, United States', 'ChIJQ_jUAlDc3IARX6kVbkAAPvo', '33.6945632', '-117.7957585', '2016-12-20 07:50:37', '0000-00-00 00:00:00', '', 'custom', '', 'Theft', 0),
(51, 30, 8, '2016-12-19', '18:20:31', '15323 Culver Drive, Irvine, CA, United States', 'ChIJ42zOaUXc3IAR-RvpOJJzJQg', '33.69556329999999', '-117.7974885', '2016-12-20 07:51:22', '0000-00-00 00:00:00', '', 'custom', '', 'Theft', 0),
(52, 30, 2, '2016-12-19', '18:22:51', '40 Bear Paw, Irvine, CA, United States', 'ChIJVyIF5k_c3IARBlvcN22a3rQ', '33.6938266', '-117.7979057', '2016-12-20 07:53:45', '0000-00-00 00:00:00', '', 'custom', '', 'Robbery', 0),
(53, 30, 10, '2013-08-21', '13:16:09', '3310 W Cypress Ave, Visalia, CA, United States', 'ChIJE6bpc6solYARY3SMsxq0-64', '36.324215', '-119.327495', '2016-12-22 02:47:26', '0000-00-00 00:00:00', '', 'custom', '', 'Theft', 0),
(54, 59, 10, '2016-09-21', '13:19:05', '3310 W Cypress Ave, Visalia, CA, United States', 'ChIJE6bpc6solYARY3SMsxq0-64', '36.324215', '-119.327495', '2016-12-22 02:49:58', '0000-00-00 00:00:00', '', 'custom', '', 'Theft', 0),
(55, 59, 9, '2016-03-21', '18:19:55', 'Visalia, CA, United States', 'ChIJKYfr04LYlIARDkgLAe7jklU', '36.3302284', '-119.2920585', '2016-12-22 02:50:53', '0000-00-00 00:00:00', '', 'custom', '', 'Vehicle theft', 0),
(56, 59, 2, '2016-12-21', '16:21:05', 'Mooney Boulevard, Visalia, CA, United States', 'EixNb29uZXkgQm91bGV2YXJkLCBWaXNhbGlhLCBDQSwgVW5pdGVkIFN0YXRlcw', '36.2417744', '-119.3130844', '2016-12-22 02:52:12', '0000-00-00 00:00:00', '', 'custom', '', 'Theft', 0),
(57, 63, 9, '2016-12-21', '17:45:01', '14 Bear Paw, Irvine, CA, United States', 'EiYxNCBCZWFyIFBhdywgSXJ2aW5lLCBDQSwgVW5pdGVkIFN0YXRlcw', '33.6936761', '-117.796004', '2016-12-22 07:18:42', '2016-12-22 07:20:57', 'upload/crime_video/', 'custom', 'crime_video_1482371457.mp4', 'At around 8 am when I stepped outside to go to work, I noticed that my passenger side window had been busted out. I found a rock in the passenger seat and nothing was taken from my vehicle. The police were called and they took down a report. ', 0),
(93, 57, 8, '2016-11-10', '14:20:10', 'Kolkata', 'ChIJ946yAeBwAjoRPViIcfTfHIE', '22.4996867', '88.3470047', '2016-12-28 16:43:14', '0000-00-00 00:00:00', '', 'custom', '', 'Asaul asault', 0),
(94, 57, 8, '2016-11-10', '14:20:10', 'Kolkata', 'ChIJ946yAeBwAjoRPViIcfTfHIE', '22.4996867', '88.3470047', '2016-12-28 16:44:56', '0000-00-00 00:00:00', '', 'custom', '', 'Asaul asault', 0),
(95, 57, 8, '2016-11-10', '14:20:10', 'Kolkata', 'ChIJ946yAeBwAjoRPViIcfTfHIE', '22.4996867', '88.3470047', '2016-12-28 16:51:19', '0000-00-00 00:00:00', '', 'custom', '', 'Asaul asault', 0),
(96, 57, 8, '2016-11-10', '14:20:10', 'Kolkata', 'ChIJ946yAeBwAjoRPViIcfTfHIE', '22.4996867', '88.3470047', '2016-12-28 17:03:29', '0000-00-00 00:00:00', '', 'custom', '', 'Asaul asault', 0),
(97, 57, 8, '2016-11-10', '14:20:10', 'Kolkata', 'ChIJ946yAeBwAjoRPViIcfTfHIE', '22.4996867', '88.3470047', '2016-12-28 17:14:01', '0000-00-00 00:00:00', '', 'custom', '', 'Asaul asault', 0),
(99, 57, 8, '2016-11-10', '14:20:10', 'Kolkata', 'ChIJ946yAeBwAjoRPViIcfTfHIE', '22.4996867', '88.3470047', '2016-12-28 18:09:25', '0000-00-00 00:00:00', '', 'custom', '', 'Asaul asault', 0),
(102, 57, 9, '2016-12-28', '18:11:37', 'EN Block, Kolkata, West Bengal, India', 'ChIJu8hg2K91AjoRi3cELRWQaok', '22.5742586', '88.4313014', '2016-12-28 18:12:46', '0000-00-00 00:00:00', '', 'custom', '', 'Jet ghost was beaten severely and badly wounded. Criminal: The girl gang!', 0),
(110, 58, 1, '2016-12-28', '18:30:10', 'Gotham West Market, 11th Avenue, New York, NY, United States', 'ChIJ78IJek5YwokRvVV8rYzRhhw', '40.76227069999999', '-73.9967042', '2016-12-28 18:31:05', '0000-00-00 00:00:00', '', 'custom', '', 'Us hdjd is shd shd shd shd ', 0),
(151, 58, 1, '2016-12-28', '20:06:06', 'Sector 1, Bidhannagar, West Bengal, India', 'ChIJUVFUV-Z1AjoRZ_VSDr4NNGc', '22.5911208', '88.40402910000002', '2016-12-28 20:06:37', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(152, 65, 9, '2016-12-28', '18:50:05', 'Newtown, Kolkata, West Bengal, India', 'ChIJuaWYAzV1AjoRJTQyRLJl4XU', '22.5765243', '88.47963439999999', '2016-12-28 20:08:06', '0000-00-00 00:00:00', '', 'custom', '', 'Check your profile ', 0),
(153, 65, 2, '2016-12-28', '20:08:39', 'Sector III, Bidhannagar, West Bengal, India', 'ChIJAYZcF851AjoRRhDQfcEjfu8', '22.5733423', '88.4137279', '2016-12-28 20:09:11', '0000-00-00 00:00:00', '', 'custom', '', 'Bajaj she d', 0),
(154, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:10:47', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(155, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:11:12', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(156, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:11:38', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(157, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:13:32', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(158, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:13:52', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(159, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:14:39', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(160, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:15:13', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(161, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:20:38', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(162, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:24:08', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(163, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:29:07', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(164, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:29:21', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(165, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:30:39', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(166, 65, 3, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:33:32', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(167, 65, 8, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:35:48', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(168, 65, 8, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:38:04', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(169, 65, 8, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-28 20:38:20', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(170, 65, 3, '2016-12-29', '10:23:30', 'Bidhannagar, West Bengal, India', 'ChIJLZ9vmE10AjoR2ftJs2B-Plw', '22.5867296', '88.41709879999999', '2016-12-29 10:24:03', '0000-00-00 00:00:00', '', 'custom', '', 'Ok ', 0),
(171, 57, 1, '2016-12-29', '16:57:45', 'EN Block, Kolkata, West Bengal, India', 'ChIJu8hg2K91AjoRi3cELRWQaok', '22.5742586', '88.4313014', '2016-12-29 16:59:20', '0000-00-00 00:00:00', '', 'custom', '', 'Murder of Jeet''s privacy.', 0),
(172, 65, 8, '2016-11-10', '14:20:10', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-29 16:59:44', '0000-00-00 00:00:00', '', 'custom', '', 'Criminal''s photo is added', 0),
(173, 66, 3, '2016-12-29', '16:55:10', 'Bidhannagar, West Bengal, India', 'ChIJLZ9vmE10AjoR2ftJs2B-Plw', '22.5867296', '88.41709879999999', '2016-12-29 17:01:13', '2016-12-30 02:47:47', '', 'custom', '', 'Ha I love the way I look at ', 0),
(174, 66, 2, '2016-12-29', '17:01:49', 'Nicco Park, Sector V, Kolkata, West Bengal, India', 'ChIJCTDp1Ld1AjoRumjRcD9FW5o', '22.573529', '88.42120199999999', '2016-12-29 17:03:17', '0000-00-00 00:00:00', 'upload/crime_video/', 'custom', 'crime_video_1483011197.mp4', 'Ok I will work with the app but not proper review but it is a good game too', 0),
(175, 66, 2, '2016-12-29', '17:03:37', 'South City Mall, Prince Anwar Shah Road, Jadavpur, Kolkata, West Bengal, India', 'ChIJn0SJYdhwAjoRkng1fTiGQUg', '22.5013648', '88.3618061', '2016-12-29 17:04:11', '0000-00-00 00:00:00', '', 'custom', '', 'Band she dx dj', 0),
(176, 57, 1, '2016-12-29', '16:57:45', 'EN Block, Kolkata, West Bengal, India', 'ChIJu8hg2K91AjoRi3cELRWQaok', '22.5742586', '88.4313014', '2016-12-29 17:04:56', '0000-00-00 00:00:00', '', 'custom', '', 'Murder of Jeet''s privacy.', 0),
(177, 57, 1, '2016-12-31', '17:46:28', 'Aurelia City Centre 2 New Town, Action Area IID, Kolkata, West Bengal, India', 'ChIJpymoC8QKAjoRWgMCCYJCNA4', '22.6190206', '88.448764', '2016-12-29 17:49:13', '0000-00-00 00:00:00', 'upload/crime_video/', 'custom', 'crime_video_1483013953.mp4', '', 0),
(178, 57, 3, '2017-01-01', '17:41:19', '', 'ChIJpymoC8QKAjoRWgMCCYJCNA4', '22.6190206', '88.448764', '2016-12-29 17:51:03', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(179, 66, 3, '2016-12-29', '18:20:30', 'Chingrighata Flyover, Nabapally, Kolkata, West Bengal, India', 'EjxDaGluZ3JpZ2hhdGEgRmx5b3ZlciwgTmFiYXBhbGx5LCBLb2xrYXRhLCBXZXN0IEJlbmdhbCwgSW5kaWE', '22.5581994', '88.41241900000001', '2016-12-29 18:21:23', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(180, 66, 1, '2016-12-29', '18:21:50', 'AQUATICA, Kolkata, West Bengal, India', 'ChIJDUy0VA51AjoR2uix1BvNgjE', '22.5619112', '88.46526689999999', '2016-12-29 18:22:28', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(181, 66, 8, '2016-12-29', '18:23:00', 'SDF Bus Stop, GP Block, Kolkata, West Bengal, India', 'ChIJXYSLiq11AjoRmxkV9l4mAhA', '22.56890079999999', '88.4308004', '2016-12-29 18:23:30', '0000-00-00 00:00:00', '', 'custom', '', 'Gahd', 0),
(182, 66, 2, '2016-12-29', '18:26:21', 'Sector 1, Bidhannagar, West Bengal, India', 'ChIJUVFUV-Z1AjoRZ_VSDr4NNGc', '22.5911208', '88.40402910000002', '2016-12-29 18:55:01', '0000-00-00 00:00:00', '', 'custom', '', 'Hddhdh\n', 0),
(183, 4, 2, '2017-02-10', '19:01:59', 'Georgia, United States', 'ChIJV4FfHcU28YgR5xBP7BC8hGY', '32.1656221', '-82.9000751', '2017-02-10 19:02:11', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(184, 1, 2, '2016-04-12', '12:04:01', 'haal', '', '39.8459834', '98.87978', '2017-02-14 17:16:38', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(185, 104, 1, '2017-02-14', '19:45:00', 'AH-274, EN Block, Sector V, Salt Lake City, Kolkata, West Bengal 700091, India', 'ChIJQbc2YxC6vzsRkkDzYv-H-Oo', '22.57350035871153', '88.43145048841272', '2017-02-14 17:21:01', '2017-03-01 19:50:30', '', 'custom', '', '', 0),
(186, 104, 2, '2017-02-14', '19:08:40', 'School of Engineering & Technology, EN Block, Sector V, Salt Lake City, Kolkata, West Bengal 700091, India', '', '22.57345157338068', '88.43157486419332', '2017-02-14 19:09:16', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(187, 1, 2, '2016-04-12', '12:04:01', 'haal', '', '39.8459834', '98.87978', '2017-02-15 13:34:04', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(189, 1, 2, '2016-04-12', '12:04:01', 'haal', '', '39.8459834', '98.87978', '2017-02-20 19:33:53', '0000-00-00 00:00:00', '', 'custom', '', '', 0),
(199, 0, 1, '2017-02-23', '19:45:00', 'Kolkata', '', '22.56465557667', '88.5656545788', '2017-02-23 20:49:08', '2017-03-23 19:51:49', '', 'admin', '', 'Murder Muder Murder', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_reported_crime`
--

CREATE TABLE IF NOT EXISTS `vigilant_reported_crime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `is_reported` int(11) NOT NULL,
  `reported_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `vigilant_reported_crime`
--

INSERT INTO `vigilant_reported_crime` (`id`, `report_id`, `is_reported`, `reported_by`) VALUES
(1, 117, 1, 1),
(2, 35, 1, 1),
(3, 118, 1, 1),
(4, 87, 1, 29),
(5, 87, 1, 11),
(6, 95, 1, 11),
(7, 35, 1, 29),
(8, 94, 1, 29),
(9, 88, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_reported_post`
--

CREATE TABLE IF NOT EXISTS `vigilant_reported_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `is_reported` int(11) NOT NULL,
  `reported_by` int(11) NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vigilant_reported_post`
--

INSERT INTO `vigilant_reported_post` (`id`, `post_id`, `is_reported`, `reported_by`, `reason`) VALUES
(1, 32, 1, 1, 'murder'),
(2, 32, 1, 11, 'murder'),
(3, 29, 1, 1, 'Spam'),
(4, 29, 1, 29, 'Spam');

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_user`
--

CREATE TABLE IF NOT EXISTS `vigilant_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_userid` int(11) NOT NULL,
  `third_party_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fp` varchar(255) NOT NULL,
  `profileimage` text NOT NULL,
  `upload_path` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `is_premium` int(11) NOT NULL,
  `login_status` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `vigilant_user`
--

INSERT INTO `vigilant_user` (`user_id`, `q_userid`, `third_party_id`, `first_name`, `last_name`, `username`, `password`, `fp`, `profileimage`, `upload_path`, `email`, `mobile_no`, `date_added`, `date_updated`, `is_premium`, `login_status`) VALUES
(1, 25210161, '', 'avijit', 'samanta', 'avisam1', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'index_1482313165.jpeg', 'upload/profile_pics/', 'avi121@gmail.com', 34234234, '0000-00-00 00:00:00', '2017-03-01 15:07:50', 1, 1),
(3, 0, '', 'Prasanna', 'Gupta', 'prasanna', 'd41d8cd98f00b204e9800998ecf8427e', '', 'userphoto_1478193158.jpg', 'upload/profile_pics/', 'prasanna@digitalaptech.com', 2147483647, '0000-00-00 00:00:00', '2017-02-09 12:22:32', 0, 0),
(4, 25210161, '', 'Jeet', 'Ghosh', 'jeet', '25d55ad283aa400af464c76d713c07ad', '12345678', 'images (1)_1481635422.jpg', 'upload/profile_pics/', 'jeet@digitalaptech.com', 432444, '0000-00-00 00:00:00', '2017-02-10 17:59:07', 1, 1),
(5, 0, '', 'Goot', 'test', 'Ohio', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'a@ggg.com', 32423423, '0000-00-00 00:00:00', '2016-12-14 12:23:33', 0, 0),
(6, 0, '', 'gfgdg', 'get', 'hi', '2cb9df9898e55fd0ad829dc202ddbd1c', 'ret', '', '', 'fgdfg@sd.com', 32123123, '0000-00-00 00:00:00', '2016-12-14 12:23:43', 0, 0),
(7, 25210161, '', 'Jill just', 'hulking', 'ljhkl', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'lhjkl@rrr.com', 213123, '0000-00-00 00:00:00', '2016-12-14 12:23:55', 0, 0),
(9, 0, '', 'fsdf', 'dfszfdsf', 'reg', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', 'abhi@mailinator.com', 21312312, '0000-00-00 00:00:00', '2016-12-14 12:24:02', 0, 0),
(16, 0, '', 'aew', '35', 'ajhlkpp51', '25f9e794323b453885f5181f1b624d0b', '123456789', '', '', 'z@c.com', 2147483647, '0000-00-00 00:00:00', '2016-12-14 12:24:10', 0, 1),
(17, 0, '', 'Jeet', 'Ghosh', 'Jeet', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'userphoto_1478789641.jpg', 'upload/profile_pics/', 'ak@mailinator.com', 2147483647, '0000-00-00 00:00:00', '2016-12-14 12:24:18', 0, 0),
(18, 0, '', 'Jeet', 'Ghosh', 'jeet.ghosh', '32250170a0dca92d53ec9624f336ca24', 'pass123', 'userphoto_1478790131.jpg', 'upload/profile_pics/', 'jeet.ghosh09@gmail.com', 324123123, '0000-00-00 00:00:00', '2016-12-14 12:24:26', 0, 0),
(19, 0, '', 'Brandon', 'Sherrill', 'Blue_Line89', 'c0c4034fb5cdf021b5478b6710f07686', '', 'picture_1482222436.jpg', 'upload/profile_pics/', 'brandonsherrillmedia@gmail.com', 2147483647, '0000-00-00 00:00:00', '2016-12-22 07:05:04', 0, 1),
(21, 0, '', 'avi', 'sam', 'Avijit samanta12', '25d55ad283aa400af464c76d713c07ad', '12345678', 'images_1479202906.jpg', 'upload/profile_pics/', 'avi1234@gmail.com', 234234234, '0000-00-00 00:00:00', '2016-12-14 12:24:49', 0, 1),
(22, 0, '', 'avi', 'sam', 'Avijit samanta123', '25d55ad283aa400af464c76d713c07ad', '12345678', 'images5_1479203573.jpg', 'upload/profile_pics/', 'avi12345@gmail.com', 2147483647, '0000-00-00 00:00:00', '2016-12-14 12:24:59', 0, 0),
(28, 0, '', 'avi', 'sam', 'Avijit samanta1233', '25d55ad283aa400af464c76d713c07ad', '12345678', 'images5_1479208838.jpg', 'upload/profile_pics/', 'avi123455@gmail.com', 324234234, '0000-00-00 00:00:00', '2016-12-14 12:25:46', 0, 1),
(29, 0, '', 'sima', 'kundu', 'sima', '32250170a0dca92d53ec9624f336ca24', '', '', '', 'sima@digitalaptech.com', 42342343, '0000-00-00 00:00:00', '2016-12-14 12:25:58', 0, 0),
(30, 0, '', 'Brandon', 'Sherrill', 'bs66mustang', 'c0c4034fb5cdf021b5478b6710f07686', '', 'userphoto_1486778609.jpg', 'upload/profile_pics/', 'bs66mustang@comcast.net', 2147483647, '0000-00-00 00:00:00', '2017-02-13 14:39:22', 1, 1),
(31, 0, '', 'Brandon', 'Sherrill', 'bsherrill', 'c0c4034fb5cdf021b5478b6710f07686', '', '', '', 'test@test.com', 2147483647, '0000-00-00 00:00:00', '2016-12-14 12:31:39', 0, 1),
(32, 0, '', 'Brandon', 'Sherrill', 'test1', 'c0c4034fb5cdf021b5478b6710f07686', '', '', '', 'test1@test.com', 2147483647, '0000-00-00 00:00:00', '2016-12-14 12:31:51', 0, 0),
(34, 0, '', 'Brandon', 'Sherrill', 'test3', 'c0c4034fb5cdf021b5478b6710f07686', '', '', '', 'test3@test.com', 2147483647, '0000-00-00 00:00:00', '2016-12-14 12:32:01', 0, 0),
(35, 0, '', 'Abhishek', 'Kumar', 'kumar_abhi', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'a_kumar@mailinator.com', 345345345, '0000-00-00 00:00:00', '2016-12-14 12:32:12', 0, 0),
(36, 0, '', 'Jeet', 'Ghosh', 'jeet_ghosh', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'jeet@mailinator.com', 2147483647, '0000-00-00 00:00:00', '2016-12-14 12:32:21', 0, 0),
(40, 0, '', 'Rana', 'Saha', 'rana', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'images5_1481711431.jpg', 'upload/profile_pics/', 'rana@digitalatech.com', 877757867, '0000-00-00 00:00:00', '2016-12-14 16:00:31', 0, 0),
(41, 0, '', 'test', 'user', 'testusr', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'tt@tt.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(42, 0, '', 'sat', 'dat', 'sat.dat', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'sat@gmail.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(44, 0, '', 'avi', 'sam', 'Avijit samant', '25d55ad283aa400af464c76d713c07ad', '12345678', '', '', 'avisam@gmail.com', 44343444, '2016-12-01 19:33:35', '2016-12-14 12:25:33', 0, 0),
(45, 0, '', 'avani', 'nagar', 'avani', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'avani@digitalaptech.com', 876878, '2016-12-02 14:08:05', '2016-12-14 12:35:17', 0, 1),
(46, 0, '', 'Brandon', 'Sherrill', 'test4', 'c0c4034fb5cdf021b5478b6710f07686', '', '', '', 'test4@test.com', 54345345, '2016-12-03 03:21:01', '2016-12-14 12:36:26', 0, 0),
(47, 0, '', 'Brandon', 'Sherrill', 'test5', 'c0c4034fb5cdf021b5478b6710f07686', '', '', '', 'test5@test.com', 2147483647, '2016-12-04 03:23:54', '2016-12-14 12:36:52', 0, 0),
(56, 0, '', 'ak', 'ka', 'aa', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'aa@a.com', 0, '2016-12-16 17:18:55', '0000-00-00 00:00:00', 0, 0),
(57, 22397165, '', 'Abhishek', 'Kumar', 'abhi', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'userphoto_1485252873.jpg', 'upload/profile_pics/', 'abhishek@digitalaptech.com', 0, '2016-12-19 13:34:58', '2017-01-24 16:23:53', 1, 0),
(58, 22472994, '', 'Abhishek ', 'Kumar', 'aa', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'userphoto_1485338161.jpg', 'upload/profile_pics/', 'aa@aa.com', 0, '2016-12-19 13:52:08', '2017-01-25 15:26:01', 1, 1),
(59, 0, '', 'Brandon', 'Sherrill', 'bsherrill', 'c0c4034fb5cdf021b5478b6710f07686', '', '', '', 'brandonsherrillmedia@yahoo.com', 0, '2016-12-20 02:58:32', '0000-00-00 00:00:00', 0, 1),
(60, 0, '', 'Brandon', 'Sherrill', 'test10', 'c0c4034fb5cdf021b5478b6710f07686', '', '', '', 'test10@test.com', 0, '2016-12-20 02:59:51', '0000-00-00 00:00:00', 0, 0),
(61, 22661728, '', 'avijit', 'samanta', 'avijitsa123', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'avi193@gmail.com', 0, '2016-12-20 21:00:41', '0000-00-00 00:00:00', 0, 0),
(62, 21892567, '', 'avijit', 'samanta', 'avijitsa1234', 'adc7d42bcc18d198623b5a88d4281550', 'avi12345678', 'images5_1485243397.jpg', 'upload/profile_pics/', 'avijit7@mailinator.com', 0, '2016-12-21 12:42:12', '2017-01-24 13:06:37', 0, 1),
(63, 21892867, '', 'Molly', 'A', 'SleepyPanda', 'c0c4034fb5cdf021b5478b6710f07686', '', '', '', 'test11@test.com', 0, '2016-12-21 12:55:25', '2016-12-22 07:04:27', 0, 0),
(64, 21920681, '', 'Brandon', 'Sherrill', 'Blue_Line89', 'c0c4034fb5cdf021b5478b6710f07686', '', '', '', 'test12@test.con', 0, '2016-12-22 06:59:33', '0000-00-00 00:00:00', 0, 0),
(65, 22397189, '', 'A', 'Kumar', 'kumar_abhi', '25d55ad283aa400af464c76d713c07ad', '12345678', 'userphoto_1482405176.jpg', 'upload/profile_pics/', 'kumar@mailinator.com', 0, '2016-12-22 16:29:24', '2017-01-24 16:25:42', 0, 0),
(66, 22188625, '', 'Jeet', 'Ghosh', 'jeet', '25d55ad283aa400af464c76d713c07ad', '12345678', 'userphoto_1483016163.jpg', 'upload/profile_pics/', 'jeet.ghosh09@gmail.com', 0, '2016-12-29 16:49:54', '2016-12-29 18:26:03', 0, 1),
(67, 22399538, '', 'Avani', 'Nagar', 'Avani', '25d55ad283aa400af464c76d713c07ad', '12345678', '', '', 'avani@mailintor.com', 0, '2017-01-04 14:38:28', '0000-00-00 00:00:00', 0, 0),
(68, 22399589, '', 'avani', 'nagar', 'avani', '25d55ad283aa400af464c76d713c07ad', '12345678', '', '', 'avani@mailinator.com', 0, '2017-01-04 14:40:20', '0000-00-00 00:00:00', 0, 1),
(69, 22693847, '', '', '', 'avijit sam', '25d55ad283aa400af464c76d713c07ad', '12345678', 'index_1485241553.jpeg', 'upload/profile_pics/', 'avijit4@mailinator.com', 0, '2017-01-12 18:15:16', '2017-01-24 12:35:53', 0, 1),
(70, 22696968, '', '', '', 'avijit1', '25d55ad283aa400af464c76d713c07ad', '12345678', 'images_1484910603.jpg', 'upload/profile_pics/', 'avijit5@mailinator.com', 0, '2017-01-12 20:17:13', '2017-01-20 16:40:03', 0, 1),
(71, 23177672, '', 'saud', 'demo', 'saud', '4297f44b13955235245b2497399d7a93', '123123', '', '', 'h@h.com', 0, '2017-01-25 02:14:56', '0000-00-00 00:00:00', 0, 0),
(72, 23177699, '', 'saud', 'njjs', 'saud', '4297f44b13955235245b2497399d7a93', '123123', '', '', 'saud@gmail.com', 0, '2017-01-25 02:15:43', '0000-00-00 00:00:00', 0, 1),
(73, 23198100, '', 'Avani', 'Nagar', 'Avani', '25d55ad283aa400af464c76d713c07ad', '12345678', 'userphoto_1485334021.jpg', 'upload/profile_pics/', 'avani@digitalaptech.com', 0, '2017-01-25 14:15:57', '2017-01-25 14:17:01', 0, 0),
(74, 23206194, '', 'Digital', 'Aptech', 'DigApt', '25d55ad283aa400af464c76d713c07ad', '12345678', '', '', 'dig@apt.com', 0, '2017-01-25 15:43:58', '0000-00-00 00:00:00', 0, 0),
(75, 23206589, '', 'First', 'last', 'f-last', '25d55ad283aa400af464c76d713c07ad', '12345678', '', '', 'hh@hh.com', 0, '2017-01-25 15:58:07', '0000-00-00 00:00:00', 0, 1),
(76, 23207241, '', 'avi', 'sam', 'avijitsam', '25d55ad283aa400af464c76d713c07ad', '12345678', '600px-Hydrogen_1485775333.png', 'upload/profile_pics/', 'avi@gmail.com', 0, '2017-01-25 16:10:55', '2017-02-09 15:09:47', 1, 1),
(77, 23207308, '', 'First', 'last', 'f-last', '25d55ad283aa400af464c76d713c07ad', '12345678', '', '', 'hhh@hh.com', 0, '2017-01-25 16:11:47', '0000-00-00 00:00:00', 0, 1),
(78, 23208778, '', 'Rana', 'Saha', 'rana', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'rana@digitalaptech.com', 0, '2017-01-25 17:00:12', '0000-00-00 00:00:00', 0, 0),
(79, 23210918, '', 'Tanay', 'hahs', 'tanau', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'userphoto_1485348275.jpg', 'upload/profile_pics/', 'tanay@digitalaptech.com', 0, '2017-01-25 18:09:14', '2017-01-25 18:14:35', 0, 1),
(80, 23245425, '', 'Brandon', 'Sherrill', 'test20', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', '', '', 'test20@test.com', 0, '2017-01-26 13:17:58', '0000-00-00 00:00:00', 0, 0),
(81, 23245957, '', 'Brian', 'Harper', 'BrainH_1988', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', 'userphoto_1485419364.jpg', 'upload/profile_pics/', 'test21@test.com', 0, '2017-01-26 13:42:24', '2017-01-26 13:59:24', 0, 1),
(82, 23246068, '', 'Jenny', 'Harper', 'JenBug', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', 'userphoto_1485419422.jpg', 'upload/profile_pics/', 'test22@test.com', 0, '2017-01-26 13:47:07', '2017-01-26 14:00:22', 0, 0),
(83, 23246119, '', 'Kevin ', 'Harper', 'KevMan92', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', 'userphoto_1485419482.jpg', 'upload/profile_pics/', 'test23@test.com', 0, '2017-01-26 13:49:53', '2017-01-26 14:01:22', 0, 0),
(84, 23246226, '', 'Christine', 'Clancey', 'Sleepy_Panda', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', '', '', 'test42@test.com', 0, '2017-01-26 13:54:42', '0000-00-00 00:00:00', 0, 0),
(85, 23246259, '', 'Christine', 'Clancey', 'SleepyPanda', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', 'userphoto_1485419600.jpg', 'upload/profile_pics/', 'test25@test.com', 0, '2017-01-26 13:56:03', '2017-01-26 14:03:20', 0, 0),
(86, 23247697, '', 'Ashley', 'Fields', 'AshBear', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', 'userphoto_1485422902.jpg', 'upload/profile_pics/', 'test26@test.com', 0, '2017-01-26 14:57:13', '2017-01-26 14:58:22', 0, 0),
(87, 23247762, '', 'Rebecca', 'Wilson', 'Becca1988', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', 'userphoto_1485423077.jpg', 'upload/profile_pics/', 'test27@test.com', 0, '2017-01-26 14:59:37', '2017-01-26 15:01:17', 0, 0),
(88, 23247887, '', 'Patrick', 'Bateman', 'PatrickB', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', 'userphoto_1485423311.jpg', 'upload/profile_pics/', 'test28@test.com', 0, '2017-01-26 15:04:26', '2017-01-26 15:05:11', 0, 0),
(89, 23248002, '', 'Paul ', 'Allen', 'PaulNYU1992', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', 'userphoto_1485423626.jpg', 'upload/profile_pics/', 'test30@test.com', 0, '2017-01-26 15:09:30', '2017-01-26 15:10:26', 0, 0),
(90, 23248071, '', 'Chantel ', 'Rosado', 'Hope_1988', 'c0c4034fb5cdf021b5478b6710f07686', '1966dream', 'userphoto_1485423780.jpg', 'upload/profile_pics/', 'test31@test.com', 0, '2017-01-26 15:12:17', '2017-01-26 15:13:00', 0, 0),
(96, 23427465, 'F121212', '', '', '', '', '', 'http://111.93.227.162/tour_app/uploads/tour_img/garden_district_new_orleans.png', '', 'avi121212122@gmail.com', 0, '2017-01-31 12:05:59', '0000-00-00 00:00:00', 0, 1),
(98, 23604989, '', 'hh', 'bb', '12', '81b9b8ad4600787bc59ab6ef8fd5f979', 'ertyui', '', '', 'fg@gy.hh', 0, '2017-02-04 14:05:12', '0000-00-00 00:00:00', 0, 0),
(100, 23778442, '', '', '', '', '', '', '', '', 'prassana@gmail.com', 0, '2017-02-08 19:38:44', '0000-00-00 00:00:00', 0, 1),
(103, 23779836, 'ee454545', '', '', '', '', '', '', '', 'satabdi2@digitalaptech.com', 0, '2017-02-08 20:24:37', '0000-00-00 00:00:00', 0, 1),
(104, 0, '360846794302438', '', '', 'Dat App', '', '', 'https://scontent.xx.fbcdn.net/v/t1.0-1/s200x200/10354686_10150004552801856_220367501106153455_n.jpg?oh=01447d59838dbd482ae3cd407e85a45d&oe=5939A950', '', 'satabdi@digitalaptech.com', 0, '2017-02-10 12:31:37', '0000-00-00 00:00:00', 1, 0),
(105, 24150495, '', '', '', 'avijit', '25d55ad283aa400af464c76d713c07ad', '12345678', '', '', 'avijit12121@mailinator.com', 0, '2017-02-14 11:49:12', '0000-00-00 00:00:00', 0, 0),
(106, 24180284, '', 'try', 'sgsg', 'agah', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '', 'kk@kk.kk', 0, '2017-02-14 21:19:33', '0000-00-00 00:00:00', 0, 1),
(112, 24242448, '281463948938731', '', '', 'Manjur Alam', '', '', 'https://scontent.xx.fbcdn.net/v/t1.0-1/p200x200/16473808_282414522177007_5382348672910337073_n.jpg?oh=0e48f834beb51013bf676f14a7aef889&oe=593194B2', '', 'manjurul@digitalaptech.com', 0, '2017-02-16 13:53:40', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_user_friend_req`
--

CREATE TABLE IF NOT EXISTS `vigilant_user_friend_req` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `is_request` int(11) NOT NULL,
  `is_accept` int(11) NOT NULL,
  `is_reject` int(11) NOT NULL,
  `is_blocked` int(11) NOT NULL,
  `blocked_by` int(11) NOT NULL,
  `req_date` datetime NOT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `vigilant_user_friend_req`
--

INSERT INTO `vigilant_user_friend_req` (`req_id`, `receiver_id`, `sender_id`, `is_request`, `is_accept`, `is_reject`, `is_blocked`, `blocked_by`, `req_date`) VALUES
(1, 1, 3, 0, 1, 0, 0, 0, '2016-12-21 15:53:27'),
(3, 1, 3, 0, 0, 1, 0, 0, '2016-12-21 16:27:30'),
(4, 1, 4, 0, 1, 0, 0, 0, '2016-12-21 17:47:08'),
(5, 1, 5, 1, 0, 0, 0, 0, '2016-12-21 17:53:16'),
(6, 1, 7, 0, 1, 0, 0, 0, '2016-12-21 19:49:30'),
(7, 58, 57, 0, 1, 0, 0, 0, '2016-12-22 12:16:09'),
(8, 35, 57, 1, 0, 0, 0, 0, '2016-12-22 12:41:07'),
(10, 57, 65, 1, 0, 0, 0, 0, '2016-12-22 16:30:28'),
(11, 58, 65, 0, 1, 0, 0, 0, '2016-12-22 16:30:30'),
(12, 4, 58, 0, 1, 0, 0, 0, '2016-12-22 19:36:59'),
(13, 17, 58, 0, 1, 0, 0, 0, '2016-12-22 19:37:09'),
(14, 63, 17, 1, 0, 0, 0, 0, '2016-12-22 19:47:30'),
(15, 18, 58, 1, 0, 0, 0, 0, '2016-12-28 13:28:31'),
(16, 19, 66, 1, 0, 0, 0, 0, '2016-12-30 02:48:38'),
(17, 65, 66, 1, 0, 0, 0, 0, '2016-12-30 02:48:46'),
(18, 58, 66, 0, 1, 0, 0, 0, '2016-12-30 02:48:47'),
(19, 57, 66, 1, 0, 0, 0, 0, '2016-12-30 02:48:48'),
(20, 19, 30, 0, 1, 0, 0, 0, '2016-12-30 08:56:26'),
(21, 62, 2, 0, 1, 0, 0, 0, '2017-01-11 00:00:00'),
(22, 35, 78, 1, 0, 0, 0, 0, '2017-01-25 17:15:27'),
(23, 57, 78, 1, 0, 0, 0, 0, '2017-01-25 17:15:28'),
(24, 58, 78, 1, 0, 0, 0, 0, '2017-01-25 17:15:30'),
(25, 19, 81, 1, 0, 0, 0, 0, '2017-01-26 13:45:42'),
(26, 81, 82, 0, 1, 0, 0, 0, '2017-01-26 13:47:48'),
(27, 81, 83, 0, 1, 0, 0, 0, '2017-01-26 13:50:29'),
(28, 82, 83, 1, 0, 0, 0, 0, '2017-01-26 13:51:12'),
(29, 81, 85, 0, 1, 0, 0, 0, '2017-01-26 13:56:39'),
(30, 81, 86, 0, 1, 0, 0, 0, '2017-01-26 14:58:55'),
(31, 81, 87, 0, 1, 0, 0, 0, '2017-01-26 15:01:54'),
(32, 81, 88, 0, 1, 0, 0, 0, '2017-01-26 15:05:36'),
(33, 81, 89, 0, 1, 0, 0, 0, '2017-01-26 15:10:50'),
(34, 81, 90, 0, 1, 0, 0, 0, '2017-01-26 15:13:30'),
(35, 81, 30, 1, 0, 0, 0, 0, '2017-02-13 14:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_user_hlocation`
--

CREATE TABLE IF NOT EXISTS `vigilant_user_hlocation` (
  `hloc_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`hloc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `vigilant_user_hlocation`
--

INSERT INTO `vigilant_user_hlocation` (`hloc_id`, `user_id`, `lat`, `long`, `address`) VALUES
(1, 1, '28.7041', '77.1025', 'Delhi'),
(9, 3, '28.7041', '77.1025', 'Delhi'),
(14, 2, '22.4996867', '88.3470047', 'Rajendra Prasad Colony, Tollygunge, Kolkata, West Bengal, India'),
(21, 56, '22.57358292585478', '88.43145020314346', 'pr-d Voskresenskiye Vorota, Moskva, Russia, 109012'),
(53, 30, '33.6953262', '-117.7964316', '13 Bear Paw, Irvine, CA 92604, USA'),
(59, 19, '33.6953262', '-117.7964316', '13 Bear Paw, Irvine, CA 92604, USA'),
(60, 65, '22.5735314', '88.4331189', 'Sector V, Salt Lake City, Kolkata, West Bengal, India'),
(61, 57, '22.57346995133755', '88.43150373688216', 'School of Engineering & Technology, EN Block, Sector V, Salt Lake City, Kolkata, West Bengal 700091, India'),
(66, 17, '22.4996867', '88.3470047', 'Rajendra Prasad Colony, Tollygunge, Kolkata, West Bengal, India'),
(67, 58, '22.57358292585478', '88.43145020314346', 'School of Engineering & Technology, EN Block, Sector V, Salt Lake City, Kolkata, West Bengal 700091, India'),
(68, 10, '22.4996867', '88.3470047', 'Rajendra Prasad Colony, Tollygunge, Kolkata, West Bengal, India'),
(69, 66, '22.50051829500357', '88.35464380689743', '1/24, Rajendra Prasad Colony, Tollygunge, Kolkata, West Bengal 700045, India'),
(70, 73, '22.6229922', '88.45028429999999', 'Shop no a 118 1st floor city centre 2 new town rajarhat, Action Area II, Action Area IID, Newtown, Kolkata, West Bengal 700157, India'),
(71, 78, '22.57347324865178', '88.43147618704329', 'AH-274, EN Block, Sector V, Salt Lake City, Kolkata, West Bengal 700091, India'),
(72, 18, '22.57344466636197', '88.43143117622326', 'AH-274, EN Block, Sector V, Salt Lake City, Kolkata, West Bengal 700091, India'),
(73, 97, '22.57359985729919', '88.43144123450706', 'School of Engineering & Technology, EN Block, Sector V, Salt Lake City, Kolkata, West Bengal 700091, India'),
(74, 4, '22.57358368022607', '88.43146797277818', 'School of Engineering & Technology, EN Block, Sector V, Salt Lake City, Kolkata, West Bengal 700091, India');

-- --------------------------------------------------------

--
-- Table structure for table `vigilant_user_location`
--

CREATE TABLE IF NOT EXISTS `vigilant_user_location` (
  `loc_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `gplaceid` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `custom_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`loc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `vigilant_user_location`
--

INSERT INTO `vigilant_user_location` (`loc_id`, `user_id`, `lat`, `long`, `gplaceid`, `address`, `custom_name`, `status`) VALUES
(1, 1, '28.7041', '77.1025', 'g233443', 'Delhi', 'xgt', 0),
(15, 58, '33.6845955', '-117.8027415', 'ChIJgaagaEvc3IARLIaEw3ZbLXA', '2 Stone Creek S, Irvine, CA 92604, USA', 'Work', 0),
(17, 30, '22.57358292585478', '88.43145020314346', 'ChIJgaagaEvc3IARLIaEw3ZbLXA', 'asdasdasdasd', 'Work', 0),
(18, 65, '39.8019322', '-105.5141639', 'ChIJE3doKKCwa4cRC0c9e22a7Ts', 'Central City, CO, USA', 'Flash''s Home Town', 0),
(19, 65, '33.9428794', '-91.8434668', 'ChIJ3Z0bdLwCLYYRY_CwyoBvj4w', 'Star City, AR 71667, USA', 'Arrow''s Home Town', 0),
(20, 66, '22.5732752', '88.4312918', 'ChIJVVVVVbx1AjoRp008TCY4MiI', '9th Floor,, EN Block, Sector V, Salt Lake City, Kolkata, West Bengal 700091, India', 'Office', 0),
(24, 66, '25.3250029', '51.5304977', 'ChIJcy73y7jERT4RpSkbNzgIxgs', 'City Center Doha Shopping Mall, Conference Centre, Doha, Qatar', 'Merket', 0),
(25, 4, '22.5735314', '88.4331189', 'ChIJDTxwILB1AjoRExYu_OD45uw', 'Sector V, Salt Lake City, Kolkata, West Bengal, India', 'Office', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
