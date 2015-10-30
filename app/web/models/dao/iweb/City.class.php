<?php
/**
 * Created by PhpStorm.
 * User: zhangjianying
 * Date: 2015/9/30
 * Time: 15:58
 */
namespace Dao\Iweb;

use \Common\Base\MysqliDao;
class City extends MysqliDao{
    protected $_table_name = 'city';
    protected $_table_fields=array('city_id','city_name');

    public function getAllCity(){
        $sql = 'SELECT '.implode(',',$this->_table_fields).' FROM '.$this->_table_name;
        $ret = $this->execute_dql($sql);
        return $ret;
    }
}