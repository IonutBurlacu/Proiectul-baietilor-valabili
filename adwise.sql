-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2015 at 10:45 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adwise`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `answer_question_id_foreign` (`question_id`),
  KEY `answer_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `question_id`, `user_id`, `content`, `created_at`) VALUES
(9, 12, 3, 'ssdsdds', '2015-05-31 11:27:47'),
(10, 12, 3, 'fsdfsdfs', '2015-05-31 11:27:49'),
(11, 12, 5, 'dasfsdd', '2015-05-31 13:17:33'),
(13, 12, 5, 'dsfsdfs', '2015-05-31 14:42:48'),
(14, 12, 5, 'vvxcvcx', '2015-05-31 14:42:52'),
(15, 12, 6, 'test', '2015-05-31 17:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

CREATE TABLE IF NOT EXISTS `badge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `badge`
--

INSERT INTO `badge` (`id`, `title`, `description`) VALUES
(1, 'Altruist', 'Asked his first question'),
(2, 'Curious', 'Asked atleast 10 questions'),
(3, 'Supporter', 'First up vote'),
(4, 'Critic', 'First down vote'),
(5, 'Nice Question', 'Question upvoted 5 times'),
(6, 'Good Question', 'Question upvoted 15 times'),
(7, 'Nice Answer', 'Answer upvoted 5 times'),
(8, 'Good Answer', 'Answer upvoted 15 times'),
(9, 'Student', 'First question with atleast 1 upvote'),
(10, 'Teacher', 'First answer with atleast 1 upvote');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(3, 'Arts & Humanities'),
(4, 'Beauty & Style'),
(5, 'Business & Finance'),
(6, 'Cars & Transportation'),
(7, 'Computers & Internet'),
(8, 'Entertainment & Music'),
(9, 'Environment'),
(10, 'Food & Drink'),
(11, 'Pets'),
(12, 'Science & Mathematics'),
(13, 'Society & Culture'),
(14, 'Sports'),
(15, 'Travel');

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE IF NOT EXISTS `interest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`id`, `title`) VALUES
(1, 'Sports'),
(2, 'Photography'),
(3, 'Movies'),
(4, 'Video games'),
(5, 'Traveling'),
(6, 'Reading'),
(7, 'Listening to music'),
(8, 'Playing a musical instrument'),
(9, 'Dancing'),
(10, 'Acting'),
(11, 'Surfing the internet'),
(12, 'Programming'),
(13, 'Gardening'),
(14, 'Collecting'),
(15, 'Bowling'),
(16, 'Iceskating'),
(17, 'Taking care of pets'),
(18, 'Trekking'),
(19, 'Fitness'),
(20, 'Social work');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_05_23_145005_create_user_table', 1),
('2015_05_23_145014_create_badge_table', 1),
('2015_05_23_145022_create_interest_table', 1),
('2015_05_23_145032_create_category_table', 1),
('2015_05_23_145059_create_question_table', 1),
('2015_05_23_145111_create_answer_table', 1),
('2015_05_23_145130_create_vote_answer_table', 1),
('2015_05_23_145136_create_vote_question_table', 1),
('2015_05_23_145141_create_tag_table', 1),
('2015_05_23_145248_create_user_interest_table', 1),
('2015_05_23_145258_create_user_badge_table', 1),
('2015_05_23_145307_create_report_question_table', 1),
('2015_05_23_145313_create_report_answer_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_user_id_foreign` (`user_id`),
  KEY `question_category_id_foreign` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `user_id`, `category_id`, `title`, `content`, `created_at`) VALUES
(12, 3, 3, 'fsdfsds', 'fsdffsd', '2015-05-31 11:27:40'),
(13, 5, 4, 'gsdfgs dfdf bdf fgd bdfgdfb bdfg', 'bgfdb gfgb\r\n fgdb\r\ngfb\r\n gdf\r\n bgfd \r\nbgdf\r\nb gdf\r\n', '2015-05-31 14:43:41');

-- --------------------------------------------------------

--
-- Table structure for table `report_answer`
--

CREATE TABLE IF NOT EXISTS `report_answer` (
  `user_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`answer_id`),
  KEY `report_answer_answer_id_foreign` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_question`
--

CREATE TABLE IF NOT EXISTS `report_question` (
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`question_id`),
  KEY `report_question_question_id_foreign` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_question_id_foreign` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `question_id`, `content`) VALUES
(10, 12, 'fsfs'),
(11, 12, 'fsdfsd'),
(12, 12, 'fsd'),
(13, 13, 'aaa'),
(14, 13, 'aaac'),
(15, 13, 'cccc');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `first_name`, `last_name`, `phone`, `gender`, `avatar`) VALUES
(2, 'vxc', '47bce5c74f589f4867dbd57e9ca9f808', '0', 'fsds', '', 1, 'male.png'),
(3, 'burlacu_ionut_mihai@yahoo.com', '17f143b0b18c1097bd7dcafa8d1acc1a', '0', 'Burlacu', '', 1, 'male.png'),
(4, 'burlacu_ionut_mihai@yahoo.com', '17f143b0b18c1097bd7dcafa8d1acc1a', '0', 'Burlacu', '', 1, 'male.png'),
(5, 'aaa', '47bce5c74f589f4867dbd57e9ca9f808', 'Ionut', 'Burlacu', '123456543', 1, 'TivVuZVgg21LyVRFdD2FABGZvQlnkM.jpg'),
(6, 'Ioana@Ioana.com', '47bce5c74f589f4867dbd57e9ca9f808', 'Ioana', 'Ioana', '', 2, 'female.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_badge`
--

CREATE TABLE IF NOT EXISTS `user_badge` (
  `user_id` int(10) unsigned NOT NULL,
  `badge_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`badge_id`),
  KEY `user_badge_badge_id_foreign` (`badge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_badge`
--

INSERT INTO `user_badge` (`user_id`, `badge_id`) VALUES
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_interest`
--

CREATE TABLE IF NOT EXISTS `user_interest` (
  `user_id` int(10) unsigned NOT NULL,
  `interest_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`interest_id`),
  KEY `user_interest_interest_id_foreign` (`interest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_interest`
--

INSERT INTO `user_interest` (`user_id`, `interest_id`) VALUES
(5, 1),
(5, 20);

-- --------------------------------------------------------

--
-- Table structure for table `vote_answer`
--

CREATE TABLE IF NOT EXISTS `vote_answer` (
  `user_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`answer_id`),
  KEY `vote_answer_answer_id_foreign` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vote_answer`
--

INSERT INTO `vote_answer` (`user_id`, `answer_id`, `type`) VALUES
(5, 11, 2),
(6, 14, 1),
(6, 15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vote_question`
--

CREATE TABLE IF NOT EXISTS `vote_question` (
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`question_id`),
  KEY `vote_question_question_id_foreign` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vote_question`
--

INSERT INTO `vote_question` (`user_id`, `question_id`, `type`) VALUES
(2, 12, 1),
(3, 12, 1),
(5, 13, 2),
(6, 12, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answer_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `report_answer`
--
ALTER TABLE `report_answer`
  ADD CONSTRAINT `report_answer_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_answer_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `report_question`
--
ALTER TABLE `report_question`
  ADD CONSTRAINT `report_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_question_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_badge`
--
ALTER TABLE `user_badge`
  ADD CONSTRAINT `user_badge_badge_id_foreign` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_badge_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_interest`
--
ALTER TABLE `user_interest`
  ADD CONSTRAINT `user_interest_interest_id_foreign` FOREIGN KEY (`interest_id`) REFERENCES `interest` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_interest_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vote_answer`
--
ALTER TABLE `vote_answer`
  ADD CONSTRAINT `vote_answer_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_answer_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vote_question`
--
ALTER TABLE `vote_question`
  ADD CONSTRAINT `vote_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_question_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
