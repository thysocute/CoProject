--
-- 数据库： `coProject`
--
CREATE DATABASE  `coProject` ;

USE `coProject`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `device`
--

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `device_id` int(11) NOT NULL AUTO_INCREMENT,
  `device_type` char(50) NOT NULL,
  `device_brand` char(50) DEFAULT NULL,
  `device_model` char(50) DEFAULT NULL,
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
-- 表的结构 `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(50) NOT NULL,
  `team_describe` varchar(128) DEFAULT NULL,
  `team_code` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `task_team_user`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
