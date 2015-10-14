<?php
/**
 * Created by PhpStorm.
 * User: zhangjianying
 * Date: 2015/9/30
 * Time: 14:34
 */
namespace Core\Base;

use \Core\Autoload;

class Template{
    public $tplVal = array();

    function __construct(){

    }

    /**
     * @param $key
     * @param $value
     */
    public function assign($key,$value){
        $this->tplVal[$key] = $value;
    }

    /**
     * @param $tplName
     */
    public function display($tplName){
        $tplFile = $this->getTplFile($tplName);
        ob_start();
        ob_implicit_flush(0);
        extract($this->tplVar, EXTR_OVERWRITE);
        include $tplFile;
        $content = ob_get_clean();
        echo $content;
    }

    /**
     * @param $fileName
     * @param array $params
     */
    function load($fileName,$params = array()){
        $tplFile = $this->getTplFile($fileName);
        if(file_exists($tplFile)){
            extract((array)$params);
            include $tplFile;
        }
    }

    /**
     * @param $tplName
     * @return string
     */
    public function getTplFile($tplName){
        $templatesPath = dirname(__FILE__).'/../../templates';
        $appName = Autoload::getAppName();
        $tplFile = $templatesPath.'/'.$appName.'/'.$tplName;
        if(!file_exists($tplFile)){
            exit("Fatal: Not find the tpl file '{$tplFile}'!");
        }
        return $tplFile;
    }
}