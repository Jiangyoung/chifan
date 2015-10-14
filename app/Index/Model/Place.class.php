<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/12
 * Time: 17:37
 */
namespace Index\Model;

use Common\Model\BaseModel;

/*
DROP TABLE IF EXISTS `iems_place`;
CREATE TABLE IF NOT EXISTS `iems_place`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `location` TINYINT UNSIGNED DEFAULT 0,
  `name` VARCHAR(32) DEFAULT '',
  `admin_ids` VARCHAR(32) DEFAULT '',
  `remark` VARCHAR(128) DEFAULT '',
  `deleted` ENUM('n','y') DEFAULT 'n'
);
 */

class Place extends BaseModel{
    protected $tbName = 'place';
    protected $tbFields = array('id','location','name','admin_ids','remark','deleted');

    function getLocations(){
        return array(0,1,2,3,4,5,6);
    }

    function getLocationText($location){
        $text = '';
        switch(intval($location)){
            case 0:
                $text = 'A搂';
                break;
            case 1:
                $text = 'B搂';
                break;
            case 2:
                $text = 'C搂';
                break;
            case 3:
                $text = 'E搂';
                break;
            case 4:
                $text = 'F搂';
                break;
            case 5:
                $text = 'G搂';
                break;
            case 6:
                $text = 'H搂';
                break;
            default:
                $text = 'M搂';
        }
        return $text;
    }

    function getLocationTexts(){
        $locations = $this->getLocations();
        $texts = array();
        foreach($locations as $k => $v){
            $texts[$k] = $this->getLocationText($k);
        }
        return $texts;
    }

    function formatList($list){
        if(is_array($list)){
            foreach($list as $k => $v){
                $list[$k]['locationText'] = $this->getLocationText($v['location']);
            }
            return $list;
        }
        return $list;
    }
}