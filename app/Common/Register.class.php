<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/15
 * Time: 20:44
 */
namespace Common;

class Register {

    static protected $objects;

    static function _set($name,$object){

        self::$objects[$name] = $object;
    }
    static function _get($name){
        if(isset(self::$objects[$name])){
            return self::$objects[$name];
        }
        return false;
    }
    static function _unset($name){
        if(isset(self::$objects[$name])){
            unset(selft::$objects[$name]);
        }
    }
}