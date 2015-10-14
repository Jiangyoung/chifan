<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/14
 * Time: 0:31
 */
namespace Index\Model;

use Common\Model\BaseModel;

/*
DROP TABLE IF EXISTS `iems_circulate`;
CREATE TABLE IF NOT EXISTS `iems_circulate`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `type` TINYINT UNSIGNED DEFAULT 0,
  `e_id` INT UNSIGNED DEFAULT 0,
  `amount` INT UNSIGNED DEFAULT 0,
  `u_id` INT UNSIGNED DEFAULT 0,
  `admin_id` INT UNSIGNED DEFAULT 0,
  `create_time` INT DEFAULT 0,
  `remark` VARCHAR(128) DEFAULT '',
  `deleted` ENUM('n','y') DEFAULT 'n'
);
 */

class Circulate extends BaseModel{
    protected $tbName = 'circulate';
    protected $tbFields = array('id','type','e_id','amount','u_id','admin_id','create_time','remark','deleted');

    function getTypes(){
        return array(1,2);
    }
    function getTypeText($type){
        $text = '';
        switch(intval($type)){
            case 1:
                $text = '出借';
                break;
            case 2:
                $text = '归还';
                break;
            default:
                $text = '状态未知';
        }
        return $text;
    }
    function formatList($list){
        foreach($list as $k => $v){
            $list[$k]['typeText'] = $this->getTypeText($v['type']);
            $list[$k]['create_timeText'] = date('Y-m-d H:i:s',$v['create_time']);
        }
        return $list;
    }

}