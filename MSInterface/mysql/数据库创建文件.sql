-- attendance record system 考勤系统数据库
CREATE SCHEMA `db_ars` DEFAULT CHARACTER SET utf8 ;

-- 用户信息表
CREATE TABLE `db_ars`.`tbl_user` (
  `uid` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(64) NULL,
  `mobile` INT(11) NULL,
  `passwd` VARCHAR(64) NOT NULL,
  `real_name` VARCHAR(45) NULL,
  `id_card` CHAR(30) NULL COMMENT '身份证号',
  `fingerprint` INT NULL COMMENT '指纹id',
  `ic_card` VARCHAR(64) NULL COMMENT 'IC卡号',
  `created_at` INT(10) NULL,
  PRIMARY KEY (`uid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '用户信息表';

-- 添加性别
ALTER TABLE `db_ars`.`tbl_user` 
ADD COLUMN `sex` TINYINT(2) NULL AFTER `real_name`;

-- 添加用户角色
ALTER TABLE `db_ars`.`tbl_user` 
ADD COLUMN `role` INT NULL COMMENT '用户角色' AFTER `created_at`;

-- 考勤记录表
CREATE TABLE `db_ars`.`tbl_attendance` (
  `aid` INT NOT NULL AUTO_INCREMENT,
  `uid` INT NOT NULL,
  `type` INT NOT NULL,
  `date` INT(10) NOT NULL COMMENT '签到日期',
  `created_at` INT(10) NULL COMMENT '创建时间',
  PRIMARY KEY (`aid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '签到记录表';

-- 设备表
CREATE TABLE `db_ars`.`tbl_device` (
  `did` INT(11) NOT NULL AUTO_INCREMENT,
  `name` INT(10) NOT NULL COMMENT '签到日期',
  `position` VARCHAR(45) NULL,
  `status` INT NULL DEFAULT 0,
  `created_at` INT(10) NULL DEFAULT NULL COMMENT '创建时间',
  `info` TEXT NULL,
  `data_dir` VARCHAR(1024) NULL,
  `config` TEXT NULL,
  PRIMARY KEY (`did`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '考勤设备表';

-- IC卡信息表
CREATE TABLE `db_ars`.`tbl_ic_card` (
  `cid` INT NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(64) NOT NULL COMMENT '卡号',
  `status` INT NOT NULL DEFAULT 0 COMMENT '状态',
  `uid` INT NULL COMMENT '绑定的用户',
  `money` DECIMAL(10,2) NOT NULL DEFAULT 0.0,
  `created_at` INT(10) NULL COMMENT '生成日期',
  `end_time` INT(10) NULL COMMENT '过期时间',
  PRIMARY KEY (`cid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'IC卡表';

-- IC卡操作日志
CREATE TABLE `db_ars`.`tbl_ic_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` INT(10) NOT NULL,
  `event` INT NOT NULL COMMENT '事件',
  `uid` VARCHAR(45) NOT NULL,
  `money` DECIMAL(10,2) NULL,
  `flash` TEXT NULL COMMENT '快照',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'IC卡操作日志表';

-- 添加卡id
ALTER TABLE `db_ars`.`tbl_ic_log` 
CHANGE COLUMN `uid` `uid` INT(11) NOT NULL ,
ADD COLUMN `cid` INT(11) NULL AFTER `flash`;



