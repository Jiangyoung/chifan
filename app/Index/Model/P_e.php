<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/14
 * Time: 0:45
 */
namespace Index\Model;
use Common\Model\BaseModel;

/*
DROP TABLE IF EXISTS `iems_p_e`;
CREATE TABLE IF NOT EXISTS `iems_p_e`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `p_id` INT UNSIGNED DEFAULT 0,
  `e_id` INT UNSIGNED DEFAULT 0,
  `amount` INT UNSIGNED DEFAULT 0,
  `create_time` INT DEFAULT 0,
  `remark` VARCHAR(128) DEFAULT '',
  `deleted` ENUM('n','y') DEFAULT 'n'
);
 */

class P_e extends BaseModel{
    protected $tbName = 'p_e';
    protected $tbFields = array('id','e_id','p_id','create_time','remark','deleted');
}