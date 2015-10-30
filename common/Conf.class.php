<?php
/**
 * Created by PhpStorm.
 * User: zhangjianying
 * Date: 2015/9/30
 * Time: 16:16
 */
namespace Common;

class Conf
{
    public static function getConf($confFileName,$confName=''){
        $confFile = self::getConfPath().'/'.$confFileName.'.ini';
        $conf = '';
        if(file_exists($confFile)){
            $conf = parse_ini_file($confFile,true);
        }
        if(!empty($confName) && is_array($conf) && !empty($conf[$confName])){
            return $conf[$confName];
        }
        return $conf;
    }
    public static function getAppConf(){

    }
    public static function getConfPath(){
        return dirname(__FILE__).'/../conf';
    }
}