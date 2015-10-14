<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/14
 * Time: 0:23
 */
namespace Index\Model;
use Common\Model\BaseModel;

/*
DROP TABLE IF EXISTS `iems_maintain`;
CREATE TABLE IF NOT EXISTS `iems_maintain`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `type` TINYINT UNSIGNED DEFAULT 0,
  `state` TINYINT UNSIGNED DEFAULT 0,
  `e_id` INT UNSIGNED DEFAULT 0,
  `u_id` INT UNSIGNED DEFAULT 0,
  `create_time` INT DEFAULT 0,
  `remark` VARCHAR(128) DEFAULT '',
  `deleted` ENUM('n','y') DEFAULT 'n'
);
 */

class Maintain extends BaseModel{
    protected $tbName = 'maintain';
    protected $tbFields = array('id','type','state','e_id','u_id','create_time','remark','deleted');
}