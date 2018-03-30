CREATE TABLE `db_ars`.`tbl_go_away` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` int(10) NOT NULL COMMENT '签到日期',
  `created_at` int(10) DEFAULT NULL COMMENT '创建时间',
  `did` int(10) DEFAULT NULL COMMENT '设备ID',
  `status` int(10) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='签到记录表';
