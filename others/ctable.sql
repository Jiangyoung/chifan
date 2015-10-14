drop table if exists `city`;
CREATE TABLE `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '城市id、自增',
  `city_name` varchar(20) NOT NULL DEFAULT '' COMMENT '城市名称',
  `short_name` varchar(20) NOT NULL DEFAULT '' COMMENT '城市简称',
  `domain` varchar(50) NOT NULL DEFAULT '' COMMENT 'domain',
  `pinyin` varchar(50) NOT NULL DEFAULT '' COMMENT '拼音',
  `display_order` int(11) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `province_id` int(11) NOT NULL DEFAULT '0' COMMENT '省份id',
  `city_code` int(11) NOT NULL DEFAULT '0' COMMENT 'city_code暂时留着，能不用的一定一要用，马上废弃',
  PRIMARY KEY (`city_id`),
  UNIQUE KEY `domain`(`domain`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='城市表';

drop table if exists `district`;
CREATE TABLE `district` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '区域id、自增',
  `district_name` varchar(20) NOT NULL DEFAULT '' COMMENT '区域名称',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '城市id',  
  `url` varchar(50) NOT NULL DEFAULT '' COMMENT '二级目录URL',
  `pinyin` varchar(50) NOT NULL DEFAULT '' COMMENT '区域拼音',
  `location` varchar(60) NOT NULL DEFAULT '' COMMENT '区域位置',
  `display_order` int(11) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  PRIMARY KEY (`district_id`),
  UNIQUE KEY `url`(`city_id`,`url`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='区域表';

drop table if exists `street`;
CREATE TABLE `street` (
  `street_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '街道id、自增',
  `street_name` varchar(20) NOT NULL DEFAULT '' COMMENT '街道名称',
  `district_id` int(11) NOT NULL DEFAULT '0' COMMENT '区域id',  
  `url` varchar(50) NOT NULL DEFAULT '' COMMENT '二级目录URL',
  `pinyin` varchar(50) NOT NULL DEFAULT '' COMMENT '街道拼音',
  `location` varchar(60) NOT NULL DEFAULT '' COMMENT '街道位置',
  `display_order` int(11) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  PRIMARY KEY (`street_id`),
  UNIQUE KEY `url`(`district_id`,`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='街道表';



drop table if exists `subway_station`;

CREATE TABLE `subway_station` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '所在城市id',
  `line_id` int(11) NOT NULL DEFAULT '0' COMMENT '地铁线路id',
  `line_name` varchar(60) NOT NULL DEFAULT '' COMMENT '地铁线路名称',
  `show_line_name` varchar(60) NOT NULL DEFAULT '' COMMENT '显示的线路名字',
  `station_id` int(11) NOT NULL DEFAULT '0' COMMENT '站点id',
  `station_name` varchar(20) NOT NULL DEFAULT '' COMMENT '站点名称',
  `lat` varchar(30) NOT NULL DEFAULT '' COMMENT 'y坐标',
  `lng` varchar(30) NOT NULL DEFAULT '' COMMENT 'x坐标',
  `modify_time` int(11) NOT NULL DEFAULT '0' COMMENT '更改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx` (`city_id`,`line_id`,`station_id`),
  KEY `city_line` (`city_id`,`line_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='地铁站点表';


drop table if exists `city_opened_config`;
CREATE TABLE `city_opened_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '城市id',
  `district_id` int(11) NOT NULL DEFAULT '0' COMMENT '区域id',
  `street_id` int(11) NOT NULL DEFAULT '0' COMMENT '街道id',  
  `city_name` varchar(20) NOT NULL DEFAULT '' COMMENT '城市名称',
  `district_name` varchar(20) NOT NULL DEFAULT '' COMMENT '区域名称',
  `street_name` varchar(20) NOT NULL DEFAULT '' COMMENT '街道名称',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态 0、有效；1、无效',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx` (`city_id`,`district_id`,`street_id`),
  KEY `city_district`(`city_id`,`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='开通城市配置表';

