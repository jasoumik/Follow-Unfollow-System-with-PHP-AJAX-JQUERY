-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2020 at 11:44 AM
-- Server version: 10.3.23-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jasoumik_mypostbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_table`
--

CREATE TABLE `comment_table` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_table`
--

INSERT INTO `comment_table` (`comment_id`, `post_id`, `user_id`, `comment`, `timestamp`) VALUES
(2, 45, 1, '                hh', '2020-06-10 19:28:33'),
(3, 45, 1, '                hi', '2020-06-11 16:11:50'),
(4, 50, 1, '                hello', '2020-06-12 19:29:57'),
(5, 118, 1, '                dfdfdf', '2020-06-13 12:40:48'),
(6, 117, 2, '                ffgfgfg', '2020-06-13 12:43:51'),
(7, 118, 1, '                dfdfdf', '2020-06-13 12:47:41'),
(8, 113, 2, 'hekko', '2020-06-13 18:28:38'),
(9, 113, 2, 'ffdf', '2020-06-13 18:29:46'),
(10, 114, 2, '                fdff', '2020-06-13 18:30:05'),
(11, 113, 2, 's', '2020-06-13 18:34:49'),
(12, 113, 2, 'ghghgh', '2020-06-13 18:37:40'),
(13, 127, 2, '                    sdsds', '2020-06-13 19:14:43'),
(14, 115, 1, '                    dffdf', '2020-06-14 19:52:54'),
(15, 115, 1, 'sdfs', '2020-06-14 19:53:06'),
(16, 127, 16, '                hello dew kn.....kun abul 2mi....?????ðŸ¤£ðŸ¤£ðŸ¤£ðŸ¤£', '2020-06-14 20:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `follow_table`
--

CREATE TABLE `follow_table` (
  `follow_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow_table`
--

INSERT INTO `follow_table` (`follow_id`, `sender_id`, `receiver_id`) VALUES
(74, 1, 2),
(75, 2, 1),
(76, 2, 8),
(77, 1, 8),
(81, 4, 1),
(82, 9, 1),
(85, 13, 1),
(87, 15, 1),
(89, 1, 16),
(90, 2, 16),
(92, 15, 16),
(93, 14, 16),
(94, 6, 16),
(95, 5, 16),
(96, 4, 16),
(97, 3, 16),
(98, 16, 1),
(99, 1, 15),
(100, 18, 1),
(102, 14, 1),
(103, 2, 19),
(104, 1, 19),
(105, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `like_table`
--

CREATE TABLE `like_table` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_table`
--

INSERT INTO `like_table` (`like_id`, `user_id`, `post_id`) VALUES
(16, 1, 47),
(17, 1, 45),
(18, 2, 47),
(19, 2, 45),
(20, 2, 48),
(21, 2, 46),
(22, 1, 50),
(23, 1, 120),
(24, 2, 123),
(25, 2, 106),
(26, 2, 107),
(27, 2, 113),
(28, 2, 115),
(29, 1, 115),
(30, 1, 114),
(31, 2, 127),
(32, 2, 111),
(33, 2, 126),
(34, 2, 112),
(35, 1, 127),
(36, 16, 126),
(37, 16, 115),
(38, 16, 127),
(39, 1, 128),
(40, 20, 130);

-- --------------------------------------------------------

--
-- Table structure for table `ntf_table`
--

CREATE TABLE `ntf_table` (
  `ntf_id` int(11) NOT NULL,
  `ntf_rcv_id` int(11) NOT NULL,
  `ntf_text` text NOT NULL,
  `read_ntf` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ntf_table`
--

INSERT INTO `ntf_table` (`ntf_id`, `ntf_rcv_id`, `ntf_text`, `read_ntf`) VALUES
(1, 4, ' <b>jasoumik</b> has share new Post', 'no'),
(2, 2, ' <b>jasoumik</b> has share new Post', 'yes'),
(3, 1, ' <b>jasoumik</b> has share new Post', 'yes'),
(4, 1, ' <b>jasoumik</b> has share new Post', 'yes'),
(5, 4, ' <b>shouvick</b> has share new Post', 'no'),
(6, 1, ' <b>shouvick</b> has share new Post', 'yes'),
(7, 4, ' <b>jasoumik</b> has shared new Post', 'no'),
(8, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(9, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(10, 2, ' <b>jasoumik</b> has shared new Post', 'yes'),
(11, 4, ' <b>jasoumik</b> has shared new Post', 'no'),
(12, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(13, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(14, 2, ' <b>jasoumik</b> has shared new Post', 'yes'),
(15, 4, ' <b>shouvick</b> has shared new Post', 'no'),
(16, 1, ' <b>shouvick</b> has shared new Post', 'yes'),
(17, 2, '<b>jasoumik</b> has \r\n               commented on your Post- \"fdfdfdfdfdfdf...\"', 'yes'),
(18, 2, '<b>jasoumik</b> has \r\n                            has reposted your Post-\r\n                             \"fdfdfdfdfdfdf...\"', 'yes'),
(19, 1, '<b>shouvick</b> has \r\n                            has reposted your Post-\r\n                             \"fdfdfdfdfdfdf...\"', 'yes'),
(20, 2, '<b>jasoumik</b> has \r\n            liked your Post- \"fdfdfdfdfdfdf...\"', 'yes'),
(21, 1, '<b>minhaz</b> has \r\n            has followed you', 'yes'),
(22, 2, '<b>jasoumik</b> has \r\n             followed you', 'yes'),
(23, 1, '<b>shouvick</b> has \r\n             followed you', 'yes'),
(24, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(25, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(26, 4, ' <b>jasoumik</b> has shared new Post', 'no'),
(27, 2, ' <b>jasoumik</b> has shared new Post', 'yes'),
(28, 4, ' <b>shouvick</b> has shared new Post', 'no'),
(29, 1, ' <b>shouvick</b> has shared new Post', 'yes'),
(30, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(31, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(32, 4, ' <b>jasoumik</b> has shared new Post', 'no'),
(33, 2, ' <b>jasoumik</b> has shared new Post', 'yes'),
(34, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(35, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(36, 4, ' <b>jasoumik</b> has shared new Post', 'no'),
(37, 2, ' <b>jasoumik</b> has shared new Post', 'yes'),
(38, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(39, 1, ' <b>jasoumik</b> has shared new Post', 'yes'),
(40, 4, ' <b>jasoumik</b> has shared new Post', 'no'),
(41, 2, ' <b>jasoumik</b> has shared new Post', 'yes'),
(42, 1, '<b>shouvick</b> has \r\n            liked your Post- \" ...\"', 'yes'),
(43, 1, '<b>shouvick</b> has \r\n            liked your Post- \"https://jasoumik.com/...\"', 'yes'),
(44, 1, '<b>shouvick</b> has \r\n            liked your Post- \"https://jasoumik.com/...\"', 'yes'),
(45, 1, '<b>shouvick</b> has \r\n               commented on your Post- \"cvccvc...\"', 'yes'),
(46, 1, '<b>shouvick</b> has \r\n               commented on your Post- \"cvccvc...\"', 'yes'),
(47, 2, '<b>shouvick</b> has \r\n               commented on your Post- \"hello...\"', 'yes'),
(48, 1, '<b>shouvick</b> has \r\n               commented on your Post- \"cvccvc...\"', 'yes'),
(49, 1, '<b>shouvick</b> has \r\n            liked your Post- \"cvccvc...\"', 'yes'),
(50, 2, '<b>shouvick</b> has \r\n            liked your Post- \"...\"', 'yes'),
(51, 1, '<b>shouvick</b> has \r\n               commented on your Post- \"cvccvc...\"', 'yes'),
(52, 2, '<b>jasoumik</b> has \r\n            liked your Post- \"...\"', 'yes'),
(53, 2, '<b>jasoumik</b> has \r\n                            has reposted your Post-\r\n                             \"...\"', 'yes'),
(54, 2, '<b>jasoumik</b> has \r\n            liked your Post- \"hello...\"', 'yes'),
(55, 2, '<b>jasoumik</b> has \r\n                            has reposted your Post-\r\n                             \"hello...\"', 'yes'),
(56, 1, '<b>shouvick</b> has \r\n            liked your Post- \"hello...\"', 'yes'),
(57, 1, '<b>shouvick</b> has \r\n            liked your Post- \"...\"', 'yes'),
(58, 1, '<b>shouvick</b> has \r\n               commented on your Post- \"hello...\"', 'yes'),
(59, 1, '<b>shouvick</b> has \r\n            liked your Post- \"...\"', 'yes'),
(60, 6, '<b>shouvick</b> has \r\n             followed you', 'no'),
(61, 5, '<b>shouvick</b> has \r\n             followed you', 'no'),
(62, 4, '<b>shouvick</b> has \r\n             followed you', 'no'),
(63, 1, '<b>shouvick</b> has \r\n             followed you', 'yes'),
(64, 1, '<b>shouvick</b> has \r\n             followed you', 'yes'),
(65, 1, '<b>shouvick</b> has \r\n            liked your Post- \"...\"', 'yes'),
(66, 2, '<b>jasoumik</b> has \r\n             followed you', 'yes'),
(67, 2, '<b>nobin</b> has \r\n             followed you', 'yes'),
(68, 1, '<b>nobin</b> has \r\n             followed you', 'yes'),
(69, 1, '<b></b> has \r\n            liked your Post- \"hello...\"', 'yes'),
(70, 1, '<b>jasoumik</b> has \r\n            liked your Post- \"hello...\"', 'yes'),
(71, 2, '<b>jasoumik</b> has \r\n               commented on your Post- \"...\"', 'yes'),
(72, 2, '<b>jasoumik</b> has \r\n               commented on your Post- \"...\"', 'yes'),
(73, 14, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(74, 13, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(75, 12, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(76, 4, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(77, 9, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(78, 14, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(79, 14, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(80, 13, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(81, 14, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(82, 15, '<b>jasoumik</b> has \r\n             followed you', 'yes'),
(83, 14, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(84, 1, '<b>KhairulIstiyak</b> has \r\n             followed you', 'yes'),
(85, 2, '<b>KhairulIstiyak</b> has \r\n             followed you', 'yes'),
(86, 1, '<b>KhairulIstiyak</b> has \r\n            liked your Post- \"...\"', 'yes'),
(87, 2, '<b>KhairulIstiyak</b> has \r\n            liked your Post- \"...\"', 'yes'),
(88, 16, '<b>jasoumik</b> has \r\n             followed you', 'yes'),
(89, 1, ' <b>KhairulIstiyak</b> has shared new Post', 'yes'),
(90, 1, '<b>KhairulIstiyak</b> has \r\n            liked your Post- \"hello...\"', 'yes'),
(91, 15, '<b>KhairulIstiyak</b> has \r\n             followed you', 'yes'),
(92, 14, '<b>KhairulIstiyak</b> has \r\n             followed you', 'no'),
(93, 6, '<b>KhairulIstiyak</b> has \r\n             followed you', 'no'),
(94, 5, '<b>KhairulIstiyak</b> has \r\n             followed you', 'no'),
(95, 4, '<b>KhairulIstiyak</b> has \r\n             followed you', 'no'),
(96, 3, '<b>KhairulIstiyak</b> has \r\n             followed you', 'no'),
(97, 16, '<b>jasoumik</b> has \r\n             followed you', 'yes'),
(98, 16, '<b>jasoumik</b> has \r\n            liked your Post- \"Hello....akom ali ...\"', 'yes'),
(99, 1, '<b>abbu</b> has \r\n             followed you', 'yes'),
(100, 1, '<b>KhairulIstiyak</b> has \r\n               commented on your Post- \"hello...\"', 'yes'),
(101, 18, '<b>jasoumik</b> has \r\n             followed you', 'yes'),
(102, 17, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(103, 14, '<b>jasoumik</b> has \r\n             followed you', 'no'),
(104, 2, ' <b>jasoumik</b> has shared new Post', 'yes'),
(105, 8, ' <b>jasoumik</b> has shared new Post', 'no'),
(106, 16, ' <b>jasoumik</b> has shared new Post', 'no'),
(107, 15, ' <b>jasoumik</b> has shared new Post', 'no'),
(108, 2, '<b>nboin270@gmail.com</b> has \r\n             followed you', 'no'),
(109, 1, '<b>nboin270@gmail.com</b> has \r\n             followed you', 'yes'),
(110, 20, '<b>nobin</b> has \r\n            liked your Post- \"hi\r\n...\"', 'no'),
(111, 2, ' <b>jasoumik</b> has shared new Post', 'no'),
(112, 8, ' <b>jasoumik</b> has shared new Post', 'no'),
(113, 16, ' <b>jasoumik</b> has shared new Post', 'no'),
(114, 15, ' <b>jasoumik</b> has shared new Post', 'no'),
(115, 19, ' <b>jasoumik</b> has shared new Post', 'no'),
(116, 3, '<b>jasoumik</b> has \r\n             followed you', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `post_table`
--

CREATE TABLE `post_table` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_table`
--

INSERT INTO `post_table` (`post_id`, `user_id`, `post_content`, `post_datetime`) VALUES
(37, 1, 'hi', '2020-06-09 16:44:20'),
(38, 1, 'hello', '2020-06-09 16:48:16'),
(52, 1, '<p><img src=\"images/D77_0026.JPG\" class=\"img-responsive img-thumbnail\">hello</p>', '2020-06-12 19:42:24'),
(85, 1, '<div class=\"embed-responsive embed-responsive-16by9\">\r\n            <video class=\"embed-responsive-item\" controls=\"controls\" src=\"images/AKTA MALER NUMBER DETO.....mp4\" __idm_id__=\"620078081\"></video>\r\n             </div> <br>', '2020-06-12 20:44:48'),
(103, 1, '<p><img src=\"images/D77_0026.JPG\" class=\"img-responsive img-thumbnail\"></p> <br>', '2020-06-12 21:51:05'),
(104, 1, '<p><img src=\"images/gta.JPG\" class=\"img-responsive img-thumbnail\"></p> <br>', '2020-06-12 21:52:43'),
(105, 1, '<p><img src=\"images/D77_0026.JPG\" class=\"img-responsive img-thumbnail\"></p> <br>', '2020-06-12 21:55:33'),
(106, 1, 'https://jasoumik.com/', '2020-06-12 22:30:43'),
(107, 1, 'https://jasoumik.com/', '2020-06-12 22:31:41'),
(108, 1, 'https://www.jasoumik.com/', '2020-06-12 22:32:22'),
(109, 1, 'https://www.jasoumik.com/', '2020-06-12 22:33:20'),
(110, 1, 'https://www.webslesson.info/2019/01/twitter-like-follow-unfollow-system-in-php-using-ajax-jquery.html', '2020-06-12 22:34:18'),
(111, 1, '<p><a href=\"https://www.webslesson.info/2019/01/twitter-like-follow-unfollow-system-in-php-using-ajax-jquery.html\">https://www.webslesson.info/2019/01/twitter-like-follow-unfollow-system-in-php-using-ajax-jquery.html</a></p><img src=\"https://lh3.googleusercontent.com/proxy/YniN-QNi9NFLo6D2ZAvMIr6UBPdwJUyAMdqIK65ykrIUmd2JpNlCMZ5ZMtH5hwCuWg-khfqfbEl2g6xVBtfCZhNTv2baVevmP6hm8zO9kqy6UK1_EWm1eGbORXWC1RFr0AChygsguJP-iV9FpmvN9PeFOVdtTKjcy3yBdcqc4E1EAycPC8wWNg=w1200-h630-p-k-no-nu\" class=\"img-responsive img-thumbnail\"><h3><b>Twitter Like Follow Unfollow System in PHP using Ajax jQuery</b></h3><p>        From this post, you can learn how to make Follow and Unfollow system like Twitter which you can create in PHP using Ajax jQuery Mysq...</p>', '2020-06-12 22:39:38'),
(113, 1, 'cvccvc', '2020-06-13 11:51:53'),
(114, 2, 'hello', '2020-06-13 11:53:37'),
(115, 2, '<p><img src=\"images/gta.JPG\" class=\"img-responsive img-thumbnail\"></p> <br>', '2020-06-13 11:53:47'),
(126, 1, '<p><img src=\"images/gta.JPG\" class=\"img-responsive img-thumbnail\"></p> <br>', '2020-06-13 18:44:02'),
(127, 1, 'hello', '2020-06-13 19:12:29'),
(128, 16, 'Hello....akom ali ', '2020-06-14 20:55:40'),
(129, 1, '<p><img src=\"images/eid2020.JPG\" class=\"img-responsive img-thumbnail\"></p> <br>', '2020-06-14 22:11:35'),
(130, 20, 'hi\r\n', '2020-06-16 20:40:02'),
(131, 1, 'Hello', '2020-06-20 08:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `repost_table`
--

CREATE TABLE `repost_table` (
  `repost_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repost_table`
--

INSERT INTO `repost_table` (`repost_id`, `post_id`, `user_id`) VALUES
(3, 45, 1),
(4, 47, 2),
(5, 48, 1),
(6, 104, 2),
(7, 118, 1),
(8, 119, 2),
(9, 115, 1),
(10, 114, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `profile_image` varchar(150) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `follower_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `password`, `name`, `profile_image`, `bio`, `follower_number`) VALUES
(1, 'jasoumik', '$2y$10$8ZtegDYFjnQ3sVioSgsF8evw11yk2ZepJWVJ/xcprM.7vV4wGXJT.', 'JARIF AHMED SOUMIK', '1916222905.jpg', 'O (+)ve', 8),
(2, 'shouvick', '$2y$10$0lkTdHNMCfk97k9XQGfu9ehx4hvQc1cQynsrVv91QBWc2koFyBALW', 'Shouvick', '1436702279.jpg', '', 4),
(3, 'borno', '$2y$10$YfROeheXGNQR2Tyj2YIQV.i5glxrjIgJ6MpeHabJ91xK88K9.kGq.', '', '', '', 4),
(4, 'minhaz', '$2y$10$V/9jQnfLrJDYrBRZG5Xp3e2I9Oqr7F1Rhagl8SzF3b5YHv6sflC46', '', '', '', 4),
(5, 'shakir', '$2y$10$eQXc9Fispcfl5t2Ez./mTe4ObruLYvz0UYAjtVIvU2xIvmy80nkEy', '', '', '', 2),
(6, 'safak', '$2y$10$UFaoGpRxFrBqsYlq72fNpOqjSpdQNyohAE4qOQaD8.Iuj2CbfvlJe', '', '', '', 3),
(14, 'zmymuna', '$2y$10$x8xG1/KAO6Wo.Ly1mPXTYuiuXDsreTf/niUnCIRVRwU26o49bogey', NULL, NULL, NULL, 1),
(19, 'nboin270@gmail.com', '$2y$10$3yo4Y9lT1w/k1//pxoOeI.iuWxCfxZ2wj7uDSYFFNbgy85B1tslpK', NULL, NULL, NULL, 0),
(20, 'nobin', '$2y$10$U2fx1JZE9KRIgwkN16wzMeaVZrJ.YgHjPJLxU3mWGmKjMS49YvUQK', 'khairul', '351105045.JPG', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_table`
--
ALTER TABLE `comment_table`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `follow_table`
--
ALTER TABLE `follow_table`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `like_table`
--
ALTER TABLE `like_table`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `ntf_table`
--
ALTER TABLE `ntf_table`
  ADD PRIMARY KEY (`ntf_id`);

--
-- Indexes for table `post_table`
--
ALTER TABLE `post_table`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `repost_table`
--
ALTER TABLE `repost_table`
  ADD PRIMARY KEY (`repost_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `follow_table`
--
ALTER TABLE `follow_table`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `like_table`
--
ALTER TABLE `like_table`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ntf_table`
--
ALTER TABLE `ntf_table`
  MODIFY `ntf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `post_table`
--
ALTER TABLE `post_table`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `repost_table`
--
ALTER TABLE `repost_table`
  MODIFY `repost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
