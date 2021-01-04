-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2020-06-24 01:47:56
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
-- 数据库： `coproject`
--

-- --------------------------------------------------------

--
-- 表的结构 `calendar`
--

DROP TABLE IF EXISTS `calendar`;
CREATE TABLE IF NOT EXISTS `calendar` (
  `calendar_id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(128) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`calendar_id`),
  KEY `FK_calendar_id_account` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `calendar`
--

INSERT INTO `calendar` (`calendar_id`, `account`, `username`) VALUES
(1, '20187189', 'vean'),
(2, '20187199', 'prenny'),
(3, '20187188', 'chen');

-- --------------------------------------------------------

--
-- 表的结构 `calendar_events`
--

DROP TABLE IF EXISTS `calendar_events`;
CREATE TABLE IF NOT EXISTS `calendar_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_public` int(1) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `all_day` int(1) DEFAULT NULL,
  `color` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `FK_calendar_events_calendar_id` (`calendar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `calendar_events`
--

INSERT INTO `calendar_events` (`event_id`, `calendar_id`, `title`, `description`, `is_public`, `start_date`, `end_date`, `all_day`, `color`) VALUES
(1, 1, '图像识别', '图像中人物关系识别', 1, '2020-06-23 21:39:00', '2020-06-27 23:59:59', 1, '#8470FF'),
(2, 3, '写论文', '修改提纲写论文', 1, '2020-06-10 09:35:00', '2020-06-10 22:35:00', 0, '#F08080'),
(6, 2, '修改提纲', '', 0, '2020-06-15 10:01:00', '2020-06-18 10:01:00', 1, '#FF6666'),
(7, 3, '回老家', '', 0, '2020-06-24 10:14:00', '1970-01-01 10:14:00', 1, '#F08080'),
(8, 2, '做开发', '日程管理，图像识别', 0, '2020-06-25 07:04:00', '2020-06-25 23:04:00', 0, '#FF99CC'),
(9, 1, '去检测', '去做核酸检测', 0, '2020-06-22 09:19:00', '2020-06-22 11:19:00', 0, '#8470FF'),
(11, 1, '去检测', '', 0, '2020-06-18 17:12:00', '2020-06-18 23:59:59', 0, '#8470FF'),
(12, 1, '图像识别', '', 0, '2020-06-16 15:40:00', '2020-06-20 23:59:59', 1, '#FF6666'),
(16, 1, '上学', '', 0, '2020-06-18 10:52:00', '2020-06-18 23:59:59', 1, '#FF0000'),
(17, 1, '看望奶奶', '', 0, '2020-06-15 11:18:00', '2020-06-16 23:59:59', 1, '#CC0000'),
(18, 1, '汇报', '', 0, '2020-06-22 11:34:00', '2020-06-23 23:59:59', 1, '#FF0000'),
(19, 1, '完善功能', '', 0, '2020-06-14 14:19:00', '2020-06-15 14:19:00', 0, '#8470FF'),
(20, 1, '测试', '', 0, '2020-06-14 14:21:00', '2020-06-16 14:21:00', 0, '#FF99CC'),
(21, 1, '画图', '', 0, '2020-06-19 14:23:00', '2020-06-20 23:59:59', 1, '#8470FF'),
(22, 1, '图像检测', '', 0, '2020-06-21 14:39:00', '2020-06-24 14:39:00', 0, '#8470FF'),
(23, 1, '设备管理', '', 0, '2020-06-23 14:56:00', '2020-06-25 14:56:00', 0, '#8470FF'),
(24, 1, '摄像头设置', '', 0, '2020-06-25 14:57:00', '2020-06-25 23:59:59', 1, '#FF99CC'),
(25, 1, '看书', '', 0, '2020-06-25 15:01:00', '2020-06-26 23:59:59', 1, '#CC0000'),
(26, 1, '写作业', '', 0, '2020-06-25 15:09:00', '2020-06-27 15:09:00', 0, '#FFCCFF'),
(27, 1, '构思', '', 0, '2020-06-25 15:11:00', '2020-06-26 15:11:00', 0, '#FF0000'),
(28, 1, '撰写论文', '', 0, '2020-06-25 15:12:00', '2020-06-29 23:59:59', 1, '#FF99FF'),
(29, 1, '采购', '', 0, '2020-06-25 15:14:00', '2020-06-25 23:59:59', 1, '#FF6666'),
(30, 1, '看望奶奶', '', 0, '2020-06-14 15:31:00', '2020-06-14 19:31:00', 0, '#8470FF'),
(31, 1, '注销银行卡', '', 0, '2020-06-16 09:33:00', '2020-06-16 17:33:00', 0, '#FF0000'),
(32, 2, '去做核酸检测', '记得带身份证', 0, '2020-06-15 09:46:00', '2020-06-16 15:46:00', 0, '#CC0000'),
(36, 2, '整理计算机书籍', '做好分类注册', 0, '2020-06-17 08:36:00', '2020-06-17 23:59:59', 1, NULL),
(37, 2, '整理论文', '', 0, '2020-06-09 00:00:00', '2020-06-09 23:59:59', 1, '#1E90FF'),
(38, 2, '练英语', '', 0, '2020-06-16 00:00:00', '2020-06-16 23:59:59', 1, '#FF0000');

-- --------------------------------------------------------

--
-- 表的结构 `device`
--

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `device_id` int(11) NOT NULL AUTO_INCREMENT,
  `device_name` char(50) NOT NULL,
  PRIMARY KEY (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `device_user`
--

DROP TABLE IF EXISTS `device_user`;
CREATE TABLE IF NOT EXISTS `device_user` (
  `du_id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` int(11) NOT NULL,
  `account` varchar(128) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`du_id`),
  KEY `FK_device_user_device_id` (`device_id`),
  KEY `FK_device_user_account` (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(128) NOT NULL,
  `task_describe` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `task_describe`) VALUES
(1, '优化前端', '就风格、交互等方面进行优化'),
(2, '完善数据库 ', '优化数据库各表之间的关系'),
(3, '完善数据库 ', '优化数据库各表之间的关系');

-- --------------------------------------------------------

--
-- 表的结构 `task_team`
--

DROP TABLE IF EXISTS `task_team`;
CREATE TABLE IF NOT EXISTS `task_team` (
  `tt_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `account` varchar(128) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `is_creator` int(1) DEFAULT NULL,
  PRIMARY KEY (`tt_id`),
  KEY `FK_task_team_team_id` (`team_id`),
  KEY `FK_task_team_task_id` (`task_id`),
  KEY `FK_team_user_account` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `task_team`
--

INSERT INTO `task_team` (`tt_id`, `task_id`, `team_id`, `team_name`, `account`, `username`, `is_creator`) VALUES
(1, 3, 3, '后端组', '20187189', 'vean', 1);

-- --------------------------------------------------------

--
-- 表的结构 `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(50) NOT NULL,
  `team_describe` varchar(128) DEFAULT NULL,
  `team_code` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `team_describe`, `team_code`) VALUES
(2, '前端组', '负责前端优化', '054829'),
(3, '后端组', '负责逻辑优化', '372076');

-- --------------------------------------------------------

--
-- 表的结构 `team_user`
--

DROP TABLE IF EXISTS `team_user`;
CREATE TABLE IF NOT EXISTS `team_user` (
  `tu_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `account` varchar(128) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `is_creator` int(1) DEFAULT NULL,
  PRIMARY KEY (`tu_id`),
  KEY `FK_team_user_team_id` (`team_id`),
  KEY `FK_team_user_account` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `team_user`
--

INSERT INTO `team_user` (`tu_id`, `team_id`, `account`, `username`, `is_creator`) VALUES
(1, 2, '20187189', 'vean', 1),
(2, 2, '20187199', 'prenny', 0),
(3, 3, '20187189', 'vean', 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `account` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`account`, `password`, `username`, `email`, `phone`) VALUES
('20187188', '20142018', 'chen', '912266908@qq.com', '13727581380'),
('20187189', '20142018', 'vean', '912266908@qq.com', '13727581380'),
('20187199', '20142018', 'prenny', 'vean@nearylee.cn', '13727579004');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
