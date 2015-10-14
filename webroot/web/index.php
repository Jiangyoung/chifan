<?php
//加载自动加载文件
include_once '../../core/Autoload.class.php';
use \Core\Autoload;

//开始自动加载
Autoload::setAppName('web');
Autoload::start();

//默认controller和action
$controller = 'Index';
$action = 'Index';

//解析controller和action
$arrRequest = parse_url($_SERVER['REQUEST_URI']);
$arrPath = array_filter(explode('/',$arrRequest['path']));
if(!empty($arrPath)){
    $controller = ucfirst(array_shift($arrPath));
}
if(!empty($arrPath)) {
    $action = array_shift($arrPath);
}
$controller = '\\Controller\\'.$controller;

//实例化controller，执行action
$conObj = new $controller();
$conObj->runAction($action);

