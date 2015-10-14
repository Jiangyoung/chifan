<?php
/**
 * Created by PhpStorm.
 * User: zhangjianying
 * Date: 2015/9/30
 * Time: 11:42
 */
namespace Core;
class Autoload
{
    private static $arrMap = array();
    private static $appName = null;
    private static $layerPath = array(
        'Core'  =>  '../../core',
        'Action' => 'actions',
        'Controller' => 'controllers',
        'Service' => 'models/service',
        'Dao' => 'models/dao'
    );
    public static function start(){
        spl_autoload_register("\\Core\\Autoload::autoload");
    }
    public static function reset(){

        spl_autoload_unregister("\\Core\\Autoload::autoload");
    }
    public static function autoload($className){
        $className = str_replace('\\','/',$className);

        if(!empty(self::$arrMap[$className])){
            include_once self::$arrMap[$className];
        }else{
            $rootPath = dirname(__FILE__).'/..';
            $pathArr = explode('/',$className);
            $layerPathIndex = array_shift($pathArr);
            if(!empty(self::$layerPath[$layerPathIndex])){
                $fileName = implode('/',$pathArr).'.class.php';
                $file = $rootPath.'/app/'.self::$appName.'/'.self::$layerPath[$layerPathIndex].'/'.$fileName;
            }

            if(!empty($file) && file_exists($file)){
                include_once $file;
            }else{
                exit("Fatal: class '{$className}' not exists!");
            }


        }
    }
    public static function setAppName($appName){
        self::$appName = $appName;
    }
    public static function getAppName(){
        return self::$appName;
    }
    public static function addArrMap($arrMap){
        self::$arrMap = array_merge(self::getDefaultArrMap(),$arrMap);
    }
    private static function getDefaultArrMap(){
        return array();
    }
    private static function getArrMap(){
        return self::$arrMap;
    }
}