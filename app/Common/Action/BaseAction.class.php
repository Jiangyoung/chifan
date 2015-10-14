<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/5
 * Time: 11:30
 */

namespace Common\Action;

use Common\Tpl\PhpEngine;
use Common\Util\Http;

abstract class BaseAction{
    protected $renderValues = array();
    protected $view = null;

    //请求类型判断
    protected $isGet = false;
    protected $isPost =false;
    //获取 get和post上来的参数（处理后）
    protected $posts = array();
    protected $gets = array();

    final function __construct()
    {
        $this->view = new PhpEngine();

        //用htmlspecialchars('',ENT_QUOTES) 处理参数（get和post的）
        $filterFunc = function($s){
            if(is_string($s)){
                return htmlspecialchars($s,ENT_QUOTES);
            } else{
                return $s;
            }
        };
        if('POST' == $_SERVER['REQUEST_METHOD']){
            $this->isPost = true;
            $this->posts = array_map($filterFunc,$_POST);
            $this->verifyToken(Http::getPOST('_token'));
        }else if('GET' == $_SERVER['REQUEST_METHOD']){
            $this->isGet = true;
            $this->gets = array_map($filterFunc,$_GET);
            $this->addToken();
        }else{
            $this->isGet = false;
            $this->isPost =false;
        }

        $controllerName = Http::getGET('c');
        $actionName = Http::getGET('a');
        $this->setRenderValues('controllerName',$controllerName);
        $this->setRenderValues('actionName',$actionName);
        $this->setRenderValues('errMsg',array());
        $this->init();
    }
    protected function init(){

    }
    function responseMsg($errno,$msg){
        header("Content-Type:text/html;charset=utf-8");
        $msgArr = array('errno'=>$errno,'msg'=>$msg);
        echo json_encode($msgArr,JSON_UNESCAPED_UNICODE);
        exit(0);
    }


    abstract public function execute();

    /**
     * @param string|array $key
     * @param string|null $val
     */
    function setRenderValues($key,$val=null){
        if(!is_array($this->renderValues)){
            $this->renderValues = (array)$this->renderValues;
        }
        if(is_array($key)){
            foreach ($key as $k => $v) {
                $this->renderValues[$k] = $v;
            }
        }else if(is_string($key)){
            $this->renderValues[$key] = $val;
        }else{
            die('Wrong params!');
        }
    }


    public function render($tplName){
        $tplName =
        $res = $this->view->fetch($this->renderValues,$tplName);
        echo $res;
    }


    /**
     * 添加token
     * @param string $salt 干扰值
     * token生成：md5($salt.mt_rand(10000,20000).time());
     * 存入session中 $_SESSION['_token'] = $tokenCode;
     */
    function addToken($salt='!.#$1^*l'){
        if(!isset($_SESSION['_token']) || empty($_SESSION['_token'])){
            $tokenCode = md5($salt.mt_rand(10000,20000).time());
            $_SESSION['_token'] = $tokenCode;
        }
        $this->setRenderValues('_token',$_SESSION['_token']);
    }

    /**
     * 验证token
     * @param $tokenCode
     * 验证完成后重置session中的值（防止重复提交）
     */
    function verifyToken($tokenCode){
        if($_SESSION['_token'] !== $tokenCode){
            Http::redirect(GAPP_TOKEN_VERIFY_FAILED);
        }
        $_SESSION['_token'] = '';
    }
}