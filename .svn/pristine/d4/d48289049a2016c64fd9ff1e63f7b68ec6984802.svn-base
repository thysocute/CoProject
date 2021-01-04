-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2020-03-31 17:36:54
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


-- --------------------------------------------------------

--
-- 表的结构 `user_eq`
--

DROP TABLE IF EXISTS `user_eq`;
CREATE TABLE IF NOT EXISTS `user_eq` (
  `eq_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `FK__equipment` (`eq_id`),
  KEY `FK_ue_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`info_id`),
  KEY `FK_user_info_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_pro`
--

DROP TABLE IF EXISTS `user_pro`;
CREATE TABLE IF NOT EXISTS `user_pro` (
  `pro_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `FK__user` (`user_id`),
  KEY `FK_up_project` (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 限制导出的表
--


--
-- 限制表 `user_eq`
--
ALTER TABLE `user_eq`
  ADD CONSTRAINT `FK__equipment` FOREIGN KEY (`eq_id`) REFERENCES `equipment` (`eq_id`),
  ADD CONSTRAINT `FK_ue_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- 限制表 `user_pro`
--
ALTER TABLE `user_pro`
  ADD CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_up_project` FOREIGN KEY (`pro_id`) REFERENCES `project` (`pro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
