<?php
/**
 * Created by PhpStorm.
 * User: zhangjianying
 * Date: 2015/9/30
 * Time: 14:18
 */

namespace Common\Base;

class Controller
{
    public $actions;
    public function runAction($actionName){
        header("Content-Type:text/html;charset=utf-8");
        if(empty($this->actions[$actionName])){
            exit("Fatal: can not find $actionName");
        }
        $action = $this->actions[$actionName];
        if(!class_exists($action)){
            exit("Fatal: $actionName not exists");
        }
        if(!is_subClass_of($action, "\\Common\\Base\\Action")){
            exit("Fatal: $actionName must extends Common\\Base\\Action!");
        }

        $actionObj = new $action();
        $actionObj->execute();
    }
}