<?php
/**
 * Created by PhpStorm.
 * User: zhangjianying
 * Date: 2015/9/30
 * Time: 14:31
 */
namespace Core\Base;
class Action
{
    public function __construct(){
        $this->tpl = new Template();
    }
    public function execute(){
        if(method_exists($this,'call')){
            $this->call();
        }else{
            exit("Fatal: ".get_class($this). " must have 'function call()' method");
        }
    }
    public function assign($key,$value){
        $this->tpl->assign($key,$value);
    }
    public function display($tplName){
        $this->tpl->display($tplName);
    }

}