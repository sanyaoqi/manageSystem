-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: db_ars
-- ------------------------------------------------------
-- Server version	5.7.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_attendance`
--

DROP TABLE IF EXISTS `tbl_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_attendance` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` int(10) NOT NULL COMMENT '签到日期',
  `created_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `did` int(10) DEFAULT NULL COMMENT '设备ID',
  `status` int(10) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='签到记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_device`
--

DROP TABLE IF EXISTS `tbl_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_device` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL COMMENT '签到日期',
  `position` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `info` text,
  `data_dir` varchar(1024) DEFAULT NULL,
  `config` text,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='考勤设备表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_guests`
--

DROP TABLE IF EXISTS `tbl_guests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_guests` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(10) DEFAULT NULL COMMENT '拜访时间',
  `uuid` int(11) DEFAULT NULL COMMENT '百度识别的用户ID',
  `image` varchar(1024) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '状态，0未处理1已处理',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_ic_card`
--

DROP TABLE IF EXISTS `tbl_ic_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ic_card` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL COMMENT '卡号',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `uid` int(11) DEFAULT NULL COMMENT '绑定的用户',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` int(10) DEFAULT NULL COMMENT '生成日期',
  `end_time` int(10) DEFAULT NULL COMMENT '过期时间',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='IC卡表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_ic_log`
--

DROP TABLE IF EXISTS `tbl_ic_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ic_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(10) NOT NULL,
  `event` int(11) NOT NULL COMMENT '事件',
  `uid` int(11) NOT NULL,
  `money` decimal(10,2) DEFAULT NULL,
  `flash` text COMMENT '快照',
  `cid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='IC卡操作日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) DEFAULT NULL,
  `mobile` char(11) DEFAULT NULL,
  `passwd` varchar(64) NOT NULL,
  `real_name` varchar(45) DEFAULT NULL,
  `sex` tinyint(2) DEFAULT NULL,
  `id_card` char(30) DEFAULT NULL COMMENT '身份证号',
  `fingerprint` int(11) DEFAULT NULL COMMENT '指纹id',
  `ic_card` varchar(64) DEFAULT NULL COMMENT 'IC卡号',
  `created_at` int(10) DEFAULT NULL,
  `role` int(11) DEFAULT NULL COMMENT '用户角色',
  `auth_key` varchar(128) DEFAULT NULL,
  `password_reset_token` varchar(128) DEFAULT NULL,
  `access_token` varchar(128) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `cover` varchar(1024) DEFAULT NULL COMMENT '用户图片',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户信息表';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-24 22:41:57
