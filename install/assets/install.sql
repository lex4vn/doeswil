-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2014 at 10:19 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ttiimblo_does_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus_content`
--

CREATE TABLE IF NOT EXISTS `aboutus_content` (
`id` int(215) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `aboutus_content`
--

INSERT INTO `aboutus_content` (`id`, `content`, `date_modified`) VALUES
(1, '<p>We are offering an unique opportunity for the examiners to create and conduct unlimited online exams for unlimited students without wasting any resources to develop personalize examination software&rsquo;s.</p>\n\n<p>DOES FEATURES IMAGES:</p>\n\n<ol>\n	<li>White labelled and Responsive Design</li>\n	<li>Made for Education and Recruitment Organizations</li>\n	<li>Audio, Video, Image and Multiple choice questions</li>\n	<li>Question Banks with difficulty levels</li>\n	<li>Awesome Graphic Presence for Statistics</li>\n	<li>PDF Certificate Generation</li>\n	<li>Individual Performances, Exam wise Performances</li>\n	<li>Top Rankers list from Exams</li>\n	<li>Retake Exam facility</li>\n	<li>Users Statistics</li>\n	<li>Forgot Password with Link Expiration Facility</li>\n	<li>IP block facility</li>\n	<li>Negative Marking</li>\n	<li>Mark for review</li>\n	<li>SEO Settings</li>\n	<li>Bulk upload Questions by CSV</li>\n	<li>Need more? Drop an email&nbsp;</li>\n</ol>', '2014-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`userid` int(255) NOT NULL,
  `username` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6667 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userid`, `username`, `password`) VALUES
(6666, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`catid` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
`id` int(250) NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `country`) VALUES
(1, 'AUD', 'Australian Dollar'),
(2, 'BRL', 'Brazilian Real'),
(3, 'CAD', 'Canadian Dollar'),
(4, 'CZK', 'Czech Koruna'),
(5, 'DKK', 'Danish Krone'),
(6, 'EUR', 'Euro'),
(7, 'HKD', 'Hong Kong Dollar'),
(8, 'HUF', 'Hungarian Forint'),
(9, 'ILS', 'Israeli New Sheqel'),
(10, 'JPY', 'Japanese Yen'),
(11, 'MYR', 'Malaysian Ringgit'),
(12, 'MXN', 'Mexican Peso'),
(13, 'NOK', 'Norwegian Krone'),
(14, 'NZD', 'New Zealand Dollar'),
(15, 'PHP', 'Philippine Peso'),
(16, 'PLN', 'Polish Zloty'),
(17, 'GBP', 'Pound Sterling'),
(18, 'SGD', 'Singapore Dollar'),
(19, 'SEK', 'Swedish Krona'),
(20, 'CHF', 'Swiss Franc'),
(21, 'TWD', 'Taiwan New Dollar'),
(22, 'THB', 'Thai Baht'),
(23, 'TRY', 'Turkish Lira'),
(24, 'USD', 'U.S. Dollar');

-- --------------------------------------------------------

--
-- Table structure for table `email_setting`
--

CREATE TABLE IF NOT EXISTS `email_setting` (
`id` int(11) NOT NULL,
  `smtp_host` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_port` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_setting`
--

INSERT INTO `email_setting` (`id`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`) VALUES
(1, 'ssl://smtp.googlemail.com', 'digionlineexam@gmail.com', '*****', '465');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE IF NOT EXISTS `general_settings` (
`id` int(215) NOT NULL,
  `site_title` varchar(512) NOT NULL,
  `site_description` varchar(512) NOT NULL,
  `site_keywords` varchar(512) NOT NULL,
  `site_url` varchar(512) NOT NULL,
  `copy_right` varchar(512) NOT NULL,
  `site_logo` varchar(512) NOT NULL,
  `address` varchar(512) NOT NULL,
  `phone` bigint(16) NOT NULL,
  `passing_score` varchar(512) NOT NULL,
  `is_performance_report_for` enum('Allusers','Paidusers') NOT NULL,
  `quizzes_for` varchar(512) NOT NULL,
  `contact_email` varchar(512) NOT NULL,
  `paypal_email` varchar(512) NOT NULL,
  `facebook_url` varchar(512) NOT NULL,
  `twitter_username` varchar(512) NOT NULL,
  `linkedin_url` varchar(512) NOT NULL,
  `feedburner_link` varchar(512) NOT NULL,
  `google_analytics` varchar(512) NOT NULL,
  `certificate_logo` varchar(512) NOT NULL,
  `certificate_content` longtext NOT NULL,
  `certificate_sign` varchar(512) NOT NULL,
  `certificate_sign_text` varchar(512) NOT NULL,
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `site_description`, `site_keywords`, `site_url`, `copy_right`, `site_logo`, `address`, `phone`, `passing_score`, `is_performance_report_for`, `quizzes_for`, `contact_email`, `paypal_email`, `facebook_url`, `twitter_username`, `linkedin_url`, `feedburner_link`, `google_analytics`, `certificate_logo`, `certificate_content`, `certificate_sign`, `certificate_sign_text`, `added_date`, `updated_date`) VALUES
(1, 'Welcome To Digi Online Examination System (DOES)', 'Digi Online Examination System (DOES)', 'Digi, Online Examination System, Online Examination, DOES, Exam', 'http://envato.digitalvidhya.com/codecanyon/doesv3/', '2012-2014 DOES', 'logo.jpg', 'Hyderabad', 9490472748, '60', 'Paidusers', 'groupquizzes', 'digionlineexam@gmail.com', 'digi@gmail.com', 'https://www.facebook.com/samplename', 'sample name', 'sample name', 'Testing.com', '<script>\n\n</script>', 'certificates.jpg', '<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>', 'sign.jpg', '<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>', '2014-05-22', '2014-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'superadmin', 'Super Admin'),
(2, 'members', 'General User'),
(3, 'admin', 'Admin'),
(4, 'moderator', 'Moderator');

-- --------------------------------------------------------

--
-- Table structure for table `group_settings`
--

CREATE TABLE IF NOT EXISTS `group_settings` (
`id` int(11) NOT NULL,
  `group_name` varchar(512) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `date_added` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `group_settings`
--

INSERT INTO `group_settings` (`id`, `group_name`, `status`, `date_added`) VALUES
(4, 'Degree', 'Active', '0000-00-00'),
(5, 'Btech', 'Active', '0000-00-00'),
(6, 'Ssc', 'Active', '0000-00-00'),
(8, 'Inter', 'Active', '0000-00-00'),
(10, 'pharmacy', 'Active', '0000-00-00'),
(11, 'Itermediate', 'Active', '0000-00-00'),
(12, 'Diploma', 'Active', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=436 ;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(432, '::1', 'user@user.com', 1416209471),
(433, '::1', 'user@user.com', 1416209566),
(434, '::1', 'user@user.com', 1416209576),
(435, '::1', 'user@user.com', 1416209800);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`nid` int(215) NOT NULL,
  `title` text NOT NULL,
  `description` longtext NOT NULL,
  `post_date` date NOT NULL,
  `last_date` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paypal`
--

CREATE TABLE IF NOT EXISTS `paypal` (
`id` int(250) NOT NULL,
  `paypal_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `currency_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `header_image` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `account_type` enum('Sandbox','Production') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sandbox',
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `paypal`
--

INSERT INTO `paypal` (`id`, `paypal_email`, `currency_code`, `header_image`, `account_type`, `status`) VALUES
(1, 'digionlineexam@gmail.com', 'AUD', 'logo.jpg', 'Sandbox', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payu`
--

CREATE TABLE IF NOT EXISTS `payu` (
`id` int(25) NOT NULL,
  `merchant_key` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `salt` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `test_url` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `live_url` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `account_type` enum('TEST','LIVE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'TEST',
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payu`
--

INSERT INTO `payu` (`id`, `merchant_key`, `salt`, `test_url`, `live_url`, `account_type`, `status`) VALUES
(1, 'JBZaLc', 'GQs7yium', 'https://test.payu.in', 'https://secure.payu.in', 'TEST', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
`questionid` int(255) NOT NULL,
  `subjectid` int(255) DEFAULT NULL,
  `questiontype` enum('SingleAnswer','MultiAnswer') DEFAULT 'SingleAnswer',
  `totalanswers` int(222) DEFAULT NULL,
  `question` text,
  `answer1` varchar(500) DEFAULT NULL,
  `answer2` varchar(500) DEFAULT NULL,
  `answer3` varchar(500) DEFAULT NULL,
  `answer4` varchar(500) DEFAULT NULL,
  `answer5` varchar(500) DEFAULT NULL,
  `correctanswer` varchar(255) DEFAULT NULL,
  `hint` varchar(400) DEFAULT NULL,
  `difficultylevel` enum('Easy','Medium','High') DEFAULT 'Easy',
  `status` enum('Active','Inactive') DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
`quizid` int(255) NOT NULL,
  `quiztype` enum('Free','Paid') DEFAULT 'Free',
  `quiz_for` varchar(222) NOT NULL,
  `validitytype` enum('Days','Attempts','','') NOT NULL DEFAULT 'Days',
  `validityvalue` int(255) NOT NULL DEFAULT '1',
  `quizcost` varchar(20) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `catid` int(255) DEFAULT NULL,
  `subcatid` int(255) DEFAULT NULL,
  `negativemarkstatus` enum('Active','Inactive') DEFAULT NULL,
  `negativemark` varchar(255) DEFAULT NULL,
  `difficultylevel` enum('Easy','Medium','High') DEFAULT 'Easy',
  `hint` enum('Active','Inactive') DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `deauration` varchar(512) NOT NULL DEFAULT '10',
  `userattempts` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quizquestions`
--

CREATE TABLE IF NOT EXISTS `quizquestions` (
`quizquestionid` int(255) NOT NULL,
  `quizid` int(255) DEFAULT NULL,
  `subjectid` int(255) DEFAULT NULL,
  `totalquestion` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quizsubscriptions`
--

CREATE TABLE IF NOT EXISTS `quizsubscriptions` (
`id` bigint(255) NOT NULL,
  `user_id` bigint(255) NOT NULL,
  `quizid` int(255) NOT NULL,
  `validitytype` enum('Days','Attempts') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Days',
  `validityvalue` int(255) NOT NULL,
  `expirydate` date NOT NULL,
  `remainingattempts` int(11) NOT NULL DEFAULT '0',
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `dateofsubscription` date NOT NULL,
  `transaction_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `payer_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `payer_email` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `payer_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_for`
--

CREATE TABLE IF NOT EXISTS `quiz_for` (
`id` int(11) NOT NULL,
  `quizid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('b0683be1a4fb9381064e77c5325badd9', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36', 1416214660, 'a:8:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:48:"Welcome To Digi Online Examination System (DOES)";s:16:"site_description";s:37:"Digi Online Examination System (DOES)";s:13:"site_keywords";s:63:"Digi, Online Examination System, Online Examination, DOES, Exam";s:8:"site_url";s:50:"http://envato.digitalvidhya.com/codecanyon/doesv3/";s:10:"copy_right";s:14:"2012-2014 DOES";s:9:"site_logo";s:8:"logo.jpg";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:24:"digionlineexam@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2014-11-14";}s:8:"identity";s:15:"admin@admin.com";s:8:"username";s:18:"Administrator DOES";s:5:"email";s:15:"admin@admin.com";s:5:"image";s:19:"profile-image_1.jpg";s:7:"user_id";s:1:"1";s:14:"old_last_login";s:10:"1416209258";}');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
`subcatid` int(255) NOT NULL,
  `catid` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
`subjectid` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
`tid` int(222) NOT NULL,
  `author` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `author_photo` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `added_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `group` int(222) NOT NULL DEFAULT '0',
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(512) NOT NULL,
  `date_of_registration` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `group`, `company`, `phone`, `image`, `date_of_registration`) VALUES
(1, '127.0.0.1', 'Administrator DOES', '$2y$08$XdaJTguakirQ32ghjwZpTOaKcVXie2GBFjCU/Ny2fhPygTIEjX8Xe', '', 'admin@admin.com', '', '/YLq7vMwO/t/wonA8Mx8R.c021ee241c55d3065b', 1415604669, NULL, 1268889823, 1416214231, 1, 'Administrator', 'DOES', 0, '0', '99999999999', 'profile-image_1.jpg', '2014-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_results`
--

CREATE TABLE IF NOT EXISTS `user_quiz_results` (
`id` int(225) NOT NULL,
  `userid` int(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(225) NOT NULL,
  `quiz_id` int(225) NOT NULL,
  `score` float NOT NULL,
  `total_questions` int(215) NOT NULL,
  `approx_rank` varchar(200) NOT NULL,
  `dateoftest` date NOT NULL,
  `timeoftest` varchar(512) NOT NULL,
  `total_attempts` int(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_results_history`
--

CREATE TABLE IF NOT EXISTS `user_quiz_results_history` (
`id` int(225) NOT NULL,
  `userid` int(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(225) NOT NULL,
  `quiz_id` int(225) NOT NULL,
  `score` float NOT NULL,
  `total_questions` int(215) NOT NULL,
  `dateoftest` date NOT NULL,
  `timeoftest` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus_content`
--
ALTER TABLE `aboutus_content`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_setting`
--
ALTER TABLE `email_setting`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_settings`
--
ALTER TABLE `group_settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `paypal`
--
ALTER TABLE `paypal`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payu`
--
ALTER TABLE `payu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
 ADD PRIMARY KEY (`questionid`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
 ADD PRIMARY KEY (`quizid`);

--
-- Indexes for table `quizquestions`
--
ALTER TABLE `quizquestions`
 ADD PRIMARY KEY (`quizquestionid`);

--
-- Indexes for table `quizsubscriptions`
--
ALTER TABLE `quizsubscriptions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_for`
--
ALTER TABLE `quiz_for`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
 ADD PRIMARY KEY (`subcatid`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
 ADD PRIMARY KEY (`subjectid`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
 ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `user_quiz_results`
--
ALTER TABLE `user_quiz_results`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_quiz_results_history`
--
ALTER TABLE `user_quiz_results_history`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus_content`
--
ALTER TABLE `aboutus_content`
MODIFY `id` int(215) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6667;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `catid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
MODIFY `id` int(250) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `email_setting`
--
ALTER TABLE `email_setting`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
MODIFY `id` int(215) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `group_settings`
--
ALTER TABLE `group_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=436;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `nid` int(215) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paypal`
--
ALTER TABLE `paypal`
MODIFY `id` int(250) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payu`
--
ALTER TABLE `payu`
MODIFY `id` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
MODIFY `questionid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
MODIFY `quizid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizquestions`
--
ALTER TABLE `quizquestions`
MODIFY `quizquestionid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizsubscriptions`
--
ALTER TABLE `quizsubscriptions`
MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_for`
--
ALTER TABLE `quiz_for`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
MODIFY `subcatid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
MODIFY `subjectid` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
MODIFY `tid` int(222) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `user_quiz_results`
--
ALTER TABLE `user_quiz_results`
MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_quiz_results_history`
--
ALTER TABLE `user_quiz_results_history`
MODIFY `id` int(225) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
