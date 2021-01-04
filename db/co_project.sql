-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2020-04-02 18:26:43
-- 服务器版本： 10.4.10-MariaDB
-- PHP 版本： 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `co_project`
--

-- --------------------------------------------------------

--
-- 表的结构 `calendar`
--

DROP TABLE IF EXISTS `calendar`;
CREATE TABLE IF NOT EXISTS `calendar` (
  `calendar_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_group` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`calendar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `calendar`
--
/*
INSERT INTO `calendar` (`calendar_id`, `calendar_group`) VALUES
(1, '1'),
(2, '1');
*/
-- --------------------------------------------------------

--
-- 表的结构 `calendar_events`
--

DROP TABLE IF EXISTS `calendar_events`;
CREATE TABLE IF NOT EXISTS `calendar_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `all_day` int(1) DEFAULT NULL,
  `color` varchar(128) DEFAULT NULL,
  `remark` int(1) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `FK_calendar_events_calendar_id` (`calendar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `calendar_events`
--

/*INSERT INTO `calendar_events` (`event_id`, `calendar_id`, `title`, `description`, `start_date`, `end_date`, `all_day`, `color`, `remark`) VALUES
(3, 1, 'åŽ»ä¸œæµ·', NULL, '2020-04-02 00:00:00', NULL, 1, '#360', 0);*/

-- --------------------------------------------------------

--
-- 表的结构 `calendar_rights`
--

DROP TABLE IF EXISTS `calendar_rights`;
CREATE TABLE IF NOT EXISTS `calendar_rights` (
  `rights_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) NOT NULL,
  `user_id` varchar(128) NOT NULL,
  `permission` bit(1) DEFAULT NULL,
  PRIMARY KEY (`rights_id`),
  KEY `FK_calendar_rights_user_id` (`user_id`),
  KEY `FK_calendar_rights_calendar_id` (`calendar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `calendar_rights`
--

/*INSERT INTO `calendar_rights` (`rights_id`, `calendar_id`, `user_id`, `permission`) VALUES
(1, 1, '1', b'1'),
(2, 2, '2', b'1');
*/
-- --------------------------------------------------------

--
-- 表的结构 `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `eq_id` int(11) NOT NULL AUTO_INCREMENT,
  `eq_name` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`eq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `project`
--

/*INSERT INTO `project` (`pro_id`, `pro_name`) VALUES
(1, 'å¼€å‘æ—¥ç¨‹ç®¡ç†æ¨¡å—'),
(2, 'finish the task');*/

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

/*INSERT INTO `users` (`user_id`, `account`, `password`) VALUES
(1, '20187189', '20142018'),
(2, '20187199', '20142018');*/

-- --------------------------------------------------------

--
-- 表的结构 `user_eq`
--
DROP TABLE IF EXISTS `user_eq`;
CREATE TABLE IF NOT EXISTS `user_eq` (
   `ue_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `eq_id` varchar(128) NOT NULL,
  PRIMARY KEY (`ue_id`),
  KEY `FK_user_eq_eq_id` (`eq_id`),
  KEY `FK_user_eq_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*DROP TABLE IF EXISTS `user_eq`;
CREATE TABLE IF NOT EXISTS `user_eq` (
  `ue_id` int(11) NOT NULL AUTO_INCREMENT,
  `eq_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `FK_equipment` (`eq_id`),
  KEY `FK_ue_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/
-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`info_id`),
  KEY `FK_user_info_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_info`
--

/*INSERT INTO `user_info` (`info_id`, `user_id`, `username`, `email`, `phone`) VALUES
(1, 1, 'vean', '912266908@qq.com', '13727581380'),
(2, 2, 'via', '912266908@qq.com', '13727581380');*/

-- --------------------------------------------------------

--
-- 表的结构 `user_pro`
--

DROP TABLE IF EXISTS `user_pro`;
CREATE TABLE IF NOT EXISTS `user_pro` (
  `up_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
   PRIMARY KEY (`up_id`),
  KEY `FK_user_pro_pro_id` (`pro_id`),
  KEY `FK_user_pro_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 群组表
DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(50) DEFAULT NULL,
  `team_describe` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 关系表
DROP TABLE IF EXISTS `user_team`;
CREATE TABLE IF NOT EXISTS `user_team` (
  `ut_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
   PRIMARY KEY (`ut_id`),
  KEY `FK_user_team_team_id` (`team_id`),
  KEY `FK_user_team_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- meeting表

DROP TABLE IF EXISTS `meeting`;
CREATE TABLE IF NOT EXISTS `meeting` (
  `meeting_id` int(11) NOT NULL AUTO_INCREMENT,
  `meeting_task` varchar(225) NOT NULL,
  `meeting_describe` varchar(225) DEFAULT NULL,
  `meeting_location` varchar(225) NOT NULL,
  `meeting_time` datetime NOT NULL,
  `meeting_member` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`meeting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
