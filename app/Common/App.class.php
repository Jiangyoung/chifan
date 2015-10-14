<?php
namespace Common;

use \Common\Util\Http;
use \Common\Config\ConfigHelper;

class App{
	static function run(){
		//加载常量配置文件
		ConfigHelper::loadConfigs('constant');

        $queryArr = parse_url($_SERVER['QUERY_STRING']);
        $urlPathStr = $queryArr['path'];
        $urlPathArr = array_filter(explode('/',$urlPathStr));

		$controller = ucfirst($urlPathArr[0]);
		$action  = ucfirst($urlPathArr[1]);


		$actionPath = '\\'.GAPP_APPNAME.'\\'.'Action'.'\\'.$controller;
		$actionName = $actionPath.'\\'.$action.'Action';
		$obj = new $actionName;
		$obj->execute();
	}
}
