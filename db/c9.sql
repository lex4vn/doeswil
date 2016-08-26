-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2016 at 11:29 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `c9`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus_content`
--

CREATE TABLE IF NOT EXISTS `aboutus_content` (
  `id` int(215) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `aboutus_content`
--

INSERT INTO `aboutus_content` (`id`, `content`, `date_modified`) VALUES
(1, '<p>Updating....</p>', '2016-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `userid` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6667 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userid`, `username`, `password`) VALUES
(6666, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `pubdate` date NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `pubdate`, `body`, `created`, `modified`) VALUES
(1, 'Chuck is on the Tutsplus team!', 'Chuck-is-on-the-Tutsplus-team', '2012-10-15', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>', '2012-10-26 21:57:59', '2012-10-26 21:57:59'),
(2, 'Darth Vader kills ten at Deathstar Canteen', 'Darth-Vader-kills-ten-at-Deathstar-Canteen', '2012-10-31', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>\n<p>Nullam eros odio, luctus et rutrum sed, varius ac enim. Aliquam nunc ante, lacinia sed porta nec, iaculis a ligula. Phasellus sagittis cursus purus, non interdum elit aliquam non. Nam lorem nibh, facilisis at scelerisque nec, tempus ac lacus maecena.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>', '2012-10-26 21:58:33', '2012-11-01 18:38:49'),
(4, 'This week''s special: Penne Arabiata', 'This-weeks-special-Penne-Arabiata', '2012-10-27', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>\n<p>Nullam eros odio, luctus et rutrum sed, varius ac enim. Aliquam nunc ante, lacinia sed porta nec, iaculis a ligula. Phasellus sagittis cursus purus, non interdum elit aliquam non. Nam lorem nibh, facilisis at scelerisque nec, tempus ac lacus maecena.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>', '2012-10-29 17:34:41', '2012-10-29 17:34:41'),
(5, 'Vader: "I can kill you with a single tought"', 'Vader-I-can-kill-you-with-a-single-tought', '2012-10-26', '<p>Nullam eros odio, luctus et rutrum sed, varius ac enim. Aliquam nunc ante, lacinia sed porta nec, iaculis a ligula. Phasellus sagittis cursus purus, non interdum elit aliquam non. Nam lorem nibh, facilisis at scelerisque nec, tempus ac lacus maecena.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>\n<p>Nullam eros odio, luctus et rutrum sed, varius ac enim. Aliquam nunc ante, lacinia sed porta nec, iaculis a ligula. Phasellus sagittis cursus purus, non interdum elit aliquam non. Nam lorem nibh, facilisis at scelerisque nec, tempus ac lacus maecena.</p>', '2012-10-29 17:35:53', '2012-10-29 17:36:08'),
(6, 'Head of catering resigns', 'Head-of-catering-resigns', '2012-10-29', '<p>Nullam eros odio, luctus et rutrum sed, varius ac enim. Aliquam nunc ante, lacinia sed porta nec, iaculis a ligula. Phasellus sagittis cursus purus, non interdum elit aliquam non. Nam lorem nibh, facilisis at scelerisque nec, tempus ac lacus maecena.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>', '2012-10-29 17:36:47', '2012-10-29 17:36:47'),
(7, 'Jeff Vader autographs', 'Jeff-Vader-autographs', '2012-10-29', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>\n<p>Nullam eros odio, luctus et rutrum sed, varius ac enim. Aliquam nunc ante, lacinia sed porta nec, iaculis a ligula. Phasellus sagittis cursus purus, non interdum elit aliquam non. Nam lorem nibh, facilisis at scelerisque nec, tempus ac lacus maecena.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>', '2012-10-29 17:37:40', '2012-10-29 17:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `catid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `name`, `status`) VALUES
(1, 'IQ', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smtp_host` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_port` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
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
  `id` int(215) NOT NULL AUTO_INCREMENT,
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
  `updated_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `site_description`, `site_keywords`, `site_url`, `copy_right`, `site_logo`, `address`, `phone`, `passing_score`, `is_performance_report_for`, `quizzes_for`, `contact_email`, `paypal_email`, `facebook_url`, `twitter_username`, `linkedin_url`, `feedburner_link`, `google_analytics`, `certificate_logo`, `certificate_content`, `certificate_sign`, `certificate_sign_text`, `added_date`, `updated_date`) VALUES
(1, 'Welcome To Wilmar CLV Awards', 'Wilmar CLV Awards', 'Wilmar CLV Awards', 'http://wilmarclvawards.com/', '2015-2016 Wilmar CLV Awards', 'logo.png', 'Hyderabad', 9490472748, '60', 'Paidusers', 'groupquizzes', 'WilmarCLVAwards@gmail.com', 'digi@gmail.com', 'https://www.facebook.com/samplename', 'sample name', 'sample name', 'Testing.com', '<script>\n\n</script>', 'certificates.jpg', '<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>', 'sign.jpg', '<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>', '2014-05-22', '2016-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(512) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
(12, 'Diploma', 'Active', '0000-00-00'),
(13, 'Students', 'Active', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(2, '10.240.0.33', 'lex4vn@gmail.com', 1471620514);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `nid` int(215) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` longtext NOT NULL,
  `post_date` date NOT NULL,
  `last_date` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'video_channelId', 'UCVHFbqXqoYvEWM1Ddxl0QDg', 'yes'),
(2, 'video_maxResults', '12', 'yes'),
(3, 'video_API', 'AIzaSyD2cspB6QAXVIjip9d5Bjj4QFHaXPqY5Fc', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `order` int(11) unsigned NOT NULL DEFAULT '0',
  `body` text NOT NULL,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `template` varchar(25) NOT NULL,
  `lang` varchar(20) NOT NULL DEFAULT 'english',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `order`, `body`, `parent_id`, `template`, `lang`) VALUES
(1, 'Homepage', '', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>\n<ul>\n<li>One</li>\n<li>two</li>\n</ul>', 0, 'homepage', 'english'),
(3, 'Contact', 'contact', 2, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>', 0, 'page', 'english'),
(4, 'About', 'about', 3, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>', 0, 'page', 'english'),
(5, 'News archive', 'News-archive', 4, '<p>This page will automatically display the news archive.</p>', 0, 'news_archive', 'english'),
(6, 'Term', 'term', 3, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut leo vitae urna eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>', 0, 'page', 'english'),
(7, 'Thể lệ cuộc thi', 'term', 3, '<p>Viet name tren duong chung ta di eleifend fringilla. Ut tincidunt risus et orci viverra non accumsan urna bibendum. Fusce sagittis tortor eu justo fermentum egestas. Sed interdum, leo a tempus con.</p>', 0, 'page', 'vietnamese');

-- --------------------------------------------------------

--
-- Table structure for table `paypal`
--

CREATE TABLE IF NOT EXISTS `paypal` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `paypal_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `currency_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `header_image` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `account_type` enum('Sandbox','Production') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sandbox',
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
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
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `merchant_key` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `salt` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `test_url` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `live_url` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `account_type` enum('TEST','LIVE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'TEST',
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
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
  `questionid` int(255) NOT NULL AUTO_INCREMENT,
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
  `status` enum('Active','Inactive') DEFAULT 'Inactive',
  PRIMARY KEY (`questionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionid`, `subjectid`, `questiontype`, `totalanswers`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `correctanswer`, `hint`, `difficultylevel`, `status`) VALUES
(1, 1, 'SingleAnswer', 4, '<p>adasdasd</p>', '<p>asda</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '', '1', '', 'Medium', 'Active'),
(2, 1, 'SingleAnswer', 4, '<p>GDFHDFGHDFGH</p>', '<p>D</p>', '<p>G</p>', '<p>G</p>', '<p>G</p>', '', '1', '', 'Medium', 'Active'),
(3, 2, 'SingleAnswer', 4, '<p>TESST</p>', '<p>T</p>', '<p>TT</p>', '<p>T</p>', '<p>T</p>', '', '1', '', 'Medium', 'Active'),
(4, 1, 'SingleAnswer', 4, 'In phiuroidea branched arms are seen in', 'Supra oesophageal', 'Lateral oesophageal', 'Dorsal Blood', 'Subneural', 'NULL', '1', NULL, 'Easy', 'Active'),
(5, 1, 'SingleAnswer', 4, 'Note the following;(a) It is fresh water, metarnerically segmented protostome.;(b) The clitellum is absent.;(c) It is unisexual.;(d) Its larva] form is Trochophore.;(e) The nervous system is found in the epidermis.', '4th, 5th and 6th segments', '10th to 20th segnwnts', '26th to the last segments', '13th segment', 'NULL', '3', NULL, 'Medium', 'Inactive'),
(6, 1, 'SingleAnswer', 4, 'The type of connective is Blue that is associated with the Umbilical cord is', 'Anopheles', 'Lucifer', 'Bombyx', 'Apis', 'NULL', '2', NULL, 'High', 'Active'),
(7, 1, 'SingleAnswer', 4, 'In phiuroidea branched arms are seen in', 'Supra oesophageal', 'Lateral oesophageal', 'Dorsal Blood', 'Subneural', 'NULL', '1', NULL, 'Easy', 'Active'),
(8, 1, 'SingleAnswer', 4, 'Note the following;(a) It is fresh water, metarnerically segmented protostome.;(b) The clitellum is absent.;(c) It is unisexual.;(d) Its larva] form is Trochophore.;(e) The nervous system is found in the epidermis.', '4th, 5th and 6th segments', '10th to 20th segnwnts', '26th to the last segments', '13th segment', 'NULL', '3', NULL, 'Medium', 'Inactive'),
(9, 1, 'SingleAnswer', 4, 'The type of connective is Blue that is associated with the Umbilical cord is', 'Anopheles', 'Lucifer', 'Bombyx', 'Apis', 'NULL', '2', NULL, 'High', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `quizid` int(255) NOT NULL AUTO_INCREMENT,
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
  `userattempts` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`quizid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quizid`, `quiztype`, `quiz_for`, `validitytype`, `validityvalue`, `quizcost`, `name`, `catid`, `subcatid`, `negativemarkstatus`, `negativemark`, `difficultylevel`, `hint`, `status`, `startdate`, `enddate`, `deauration`, `userattempts`) VALUES
(1, 'Free', '*', 'Days', 0, '0', 'SSS', 1, 1, 'Inactive', '', 'Medium', 'Inactive', 'Active', '2016-08-17', '2016-08-18', '1', 0),
(2, 'Free', '*', 'Days', 0, '0', 'Test 2', 1, 1, 'Active', '12', 'Medium', 'Inactive', 'Active', '2016-08-01', '2016-08-17', '12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quizquestions`
--

CREATE TABLE IF NOT EXISTS `quizquestions` (
  `quizquestionid` int(255) NOT NULL AUTO_INCREMENT,
  `quizid` int(255) DEFAULT NULL,
  `subjectid` int(255) DEFAULT NULL,
  `totalquestion` int(255) DEFAULT NULL,
  PRIMARY KEY (`quizquestionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `quizquestions`
--

INSERT INTO `quizquestions` (`quizquestionid`, `quizid`, `subjectid`, `totalquestion`) VALUES
(2, 1, 1, 1),
(3, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `quizsubscriptions`
--

CREATE TABLE IF NOT EXISTS `quizsubscriptions` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
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
  `payer_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_for`
--

CREATE TABLE IF NOT EXISTS `quiz_for` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quizid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quiz_for`
--

INSERT INTO `quiz_for` (`id`, `quizid`, `groupid`) VALUES
(1, 1, 12),
(2, 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('2b45a6e7ff29df518062ee448461632d', '10.240.0.230', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1471850687, 'a:3:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:28:"Welcome To Wilmar CLV Awards";s:16:"site_description";s:17:"Wilmar CLV Awards";s:13:"site_keywords";s:17:"Wilmar CLV Awards";s:8:"site_url";s:27:"http://wilmarclvawards.com/";s:10:"copy_right";s:27:"2015-2016 Wilmar CLV Awards";s:9:"site_logo";s:8:"logo.png";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:25:"WilmarCLVAwards@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2016-08-10";}s:9:"last_page";s:44:"http://does-wil-lex4vn.c9users.io:80/article";}'),
('4000f2f6c3ba77a7d6048bbde879e9c5', '10.240.1.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1471841604, 'a:3:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:28:"Welcome To Wilmar CLV Awards";s:16:"site_description";s:17:"Wilmar CLV Awards";s:13:"site_keywords";s:17:"Wilmar CLV Awards";s:8:"site_url";s:27:"http://wilmarclvawards.com/";s:10:"copy_right";s:27:"2015-2016 Wilmar CLV Awards";s:9:"site_logo";s:8:"logo.png";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:25:"WilmarCLVAwards@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2016-08-10";}s:9:"last_page";s:44:"http://does-wil-lex4vn.c9users.io:80/article";}'),
('bacc7a3d850d9b7814a37f838151ca6b', '10.240.0.213', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0_2 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12A36', 1471865345, 'a:3:{s:9:"user_data";s:0:"";s:9:"site_data";O:8:"stdClass":25:{s:2:"id";s:1:"1";s:10:"site_title";s:28:"Welcome To Wilmar CLV Awards";s:16:"site_description";s:17:"Wilmar CLV Awards";s:13:"site_keywords";s:17:"Wilmar CLV Awards";s:8:"site_url";s:27:"http://wilmarclvawards.com/";s:10:"copy_right";s:27:"2015-2016 Wilmar CLV Awards";s:9:"site_logo";s:8:"logo.png";s:7:"address";s:9:"Hyderabad";s:5:"phone";s:10:"9490472748";s:13:"passing_score";s:2:"60";s:25:"is_performance_report_for";s:9:"Paidusers";s:11:"quizzes_for";s:12:"groupquizzes";s:13:"contact_email";s:25:"WilmarCLVAwards@gmail.com";s:12:"paypal_email";s:14:"digi@gmail.com";s:12:"facebook_url";s:35:"https://www.facebook.com/samplename";s:16:"twitter_username";s:11:"sample name";s:12:"linkedin_url";s:11:"sample name";s:15:"feedburner_link";s:11:"Testing.com";s:16:"google_analytics";s:19:"<script>\n\n</script>";s:16:"certificate_logo";s:16:"certificates.jpg";s:19:"certificate_content";s:329:"<p>This is to certify that <b>__USERNAME__</b>, with Userid: <b>__USERID__</b>, Email: <b>__EMAIL__</b> succesfully completed the <b>__COURSENAME__ </b>with <b>__SCORE__/__MAXSCORE__ </b>in the course program from our online academy.&nbsp;</p>\n\n<p><b>Note: </b>This is computer generated copy.</p>\n\n<p>&nbsp;</p>\n\n<h1>&nbsp;</h1>";s:16:"certificate_sign";s:8:"sign.jpg";s:21:"certificate_sign_text";s:59:"<p><b>ADMIN</b></p>\n\n<h3><i>Director of DIGI Exams</i></h3>";s:10:"added_date";s:10:"2014-05-22";s:12:"updated_date";s:10:"2016-08-10";}s:9:"last_page";s:34:"http://does-wil-lex4vn.c9users.io/";}');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
  `subcatid` int(255) NOT NULL AUTO_INCREMENT,
  `catid` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`subcatid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcatid`, `catid`, `name`, `status`) VALUES
(1, 1, 'test-node', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subjectid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`subjectid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectid`, `name`, `status`) VALUES
(1, 'IQ', 'Active'),
(2, 'ENGLISH', 'Active'),
(3, 'GMAT', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `tid` int(222) NOT NULL AUTO_INCREMENT,
  `author` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `author_photo` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `added_date` date NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(6) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(200) NOT NULL,
  `card_id_no` varchar(20) NOT NULL,
  `date_of_issue` date DEFAULT NULL,
  `issued_police` varchar(100) DEFAULT NULL,
  `permanent_address` varchar(100) DEFAULT NULL,
  `temp_address` varchar(100) DEFAULT NULL,
  `major` varchar(100) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL,
  `student_code` varchar(30) DEFAULT NULL,
  `registered_field` varchar(50) NOT NULL,
  `score` float NOT NULL,
  `date_graduation` date DEFAULT NULL,
  `english_proficiency` varchar(100) DEFAULT NULL,
  `extracurricular_activities` text,
  `achievements` text,
  `experiences` text,
  `career_pursuit` text,
  `factor` text,
  `objectives` text,
  `company` varchar(100) DEFAULT NULL,
  `image` varchar(512) NOT NULL,
  `date_of_registration` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `phone`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `full_name`, `first_name`, `last_name`, `gender`, `birthdate`, `birthplace`, `card_id_no`, `date_of_issue`, `issued_police`, `permanent_address`, `temp_address`, `major`, `university`, `student_code`, `registered_field`, `score`, `date_graduation`, `english_proficiency`, `extracurricular_activities`, `achievements`, `experiences`, `career_pursuit`, `factor`, `objectives`, `company`, `image`, `date_of_registration`) VALUES
(1, '1', 'lex4vn', '$2y$08$BgtLrlcIayKQIMamnHzq9utdExAKaDuN78loDV0WRSA.GQzWCdE/K', NULL, 'lex4vn1@gmail.com', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'a', NULL, NULL, 'male', '2016-08-01', 'a', '123123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0000-00-00'),
(2, '1', 'lex4vn', '$2y$08$BgtLrlcIayKQIMamnHzq9utdExAKaDuN78loDV0WRSA.GQzWCdE/K', NULL, 'lex4vn1@gmail.com', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'a', NULL, NULL, 'male', '2016-08-01', 'a', '123123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2016-08-01'),
(3, '10.240.0.240', 'abo', '$2y$08$BMX1VKdCfUjIvxNV9hGnUe9jU9rJfV4YOTWuQi4/99bnfNzdKZeGy', NULL, 'lex4vn@gmail.com', '0912392090', '64803eafcf78cda8ef24aef34257d2c8b612ec38', NULL, NULL, NULL, 1470737726, 1471620535, 1, 'abo', NULL, NULL, '1', '0000-00-00', '', '0', '0000-00-00', '0', '0', '0', '0', '0', '0', '', 0, '0000-00-00', '0', '', '', '', '', '', '', NULL, 'The-Avengers-Movie-Roster-Concept-Art_3.jpg', '2016-08-09'),
(4, '10.240.1.16', 'dsfsdfsdf', '$2y$08$13CHWCk6K8O.uOWVrT8M1ebdiUO40G5zcY7jAI23P4/n8PecZ5fxG', NULL, 'adfa@gmail.com', '23423234234', '6a8d0afedd81654203c67b202f822615a0df712c', NULL, NULL, NULL, 1470889285, 1470889285, 1, 'dsfsdfsdf', NULL, NULL, '0', '0000-00-00', 'ádfasd', '0', '0000-00-00', '0', '0', '0', '0', '0', '0', 'Technical', 0, '0000-00-00', '0', '', '', '', '', '', '', NULL, 'logo_4.png', '2016-08-11'),
(5, '10.240.0.230', '0', '$2y$08$8w/Ymnw0xM38aaAaUFBO/OEchmOSfFTNdUtJZfOPEijAcqpi6tOg.', NULL, 'smartkids210@gmail.com', '1231231231', '5d3ea434559f83e8138b496ddee7e9ebd1913edb', NULL, NULL, NULL, 1471462817, 1471620496, 1, '0', NULL, NULL, '1', '0000-00-00', 'abc', '121123112', '0000-00-00', 'abc', '123', '123', '123', '123', '123', 'Technical', 12, '0000-00-00', '1121', '123', '123', '123', '123', '123', '123', NULL, '025Pikachu_OS_anime_10_5.png', '2016-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 3, 1),
(2, 4, 2),
(3, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_results`
--

CREATE TABLE IF NOT EXISTS `user_quiz_results` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(225) NOT NULL,
  `quiz_id` int(225) NOT NULL,
  `score` float NOT NULL,
  `total_questions` int(215) NOT NULL,
  `approx_rank` varchar(200) NOT NULL,
  `dateoftest` date NOT NULL,
  `timeoftest` varchar(512) NOT NULL,
  `total_attempts` int(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_quiz_results`
--

INSERT INTO `user_quiz_results` (`id`, `userid`, `email`, `username`, `quiz_id`, `score`, `total_questions`, `approx_rank`, `dateoftest`, `timeoftest`, `total_attempts`) VALUES
(1, 5, 'smartkids210@gmail.com', '0', 1, 1, 1, '2000', '2016-08-17', '20:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_results_history`
--

CREATE TABLE IF NOT EXISTS `user_quiz_results_history` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(225) NOT NULL,
  `quiz_id` int(225) NOT NULL,
  `score` float NOT NULL,
  `total_questions` int(215) NOT NULL,
  `dateoftest` date NOT NULL,
  `timeoftest` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_quiz_results_history`
--

INSERT INTO `user_quiz_results_history` (`id`, `userid`, `email`, `username`, `quiz_id`, `score`, `total_questions`, `dateoftest`, `timeoftest`) VALUES
(1, 5, 'smartkids210@gmail.com', '0', 1, 1, 1, '2016-08-17', '20:26');

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
