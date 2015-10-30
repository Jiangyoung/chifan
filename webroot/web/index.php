<?php
var_dump($_SERVER['REQUEST_URI']);
//加载自动加载文件
include_once '../../Common/Autoload.class.php';
use \Common\Autoload;

//开始自动加载
Autoload::setAppName('web');
Autoload::start();

//默认controller和action
$controller = 'Index';
$action = 'index';

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
if(class_exists($controller)){
    $conObj = new $controller();
    $conObj->runAction($action);
}else{
    echo "Fatal: Class {$controller} not find!";
    exit();
}


