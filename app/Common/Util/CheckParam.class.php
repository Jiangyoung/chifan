<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/10
 * Time: 21:46
 */

namespace Common\Util;

class CheckParam {
    private $error = array();

    function getError(){
        return $this->error;
    }
    function setError($err){
        $this->error[] = $err;
    }

    /**
     * @param string $param
     * @param string $name
     * @param int $min
     * @param int $max
     * @param string $encoding
     * @return bool
     */
    function check_length($param,$min,$max,$name='',$encoding="utf-8"){
        $param = strval($param);
        if(mb_strlen($param,$encoding) < $min){
            $this->setError($name.' 长度'.'太短.');
            return false;
        }else if(mb_strlen($param,$encoding) > $max){
            $this->setError($name.' 长度'.'太长.');
            return false;
        }else{
            return true;
        }
    }

    /**
     * @param string $param
     * @param string $name
     * @return bool
     */
    function check_phone($param,$name='手机号'){
        $patten = '/^1[1-9]{10}$/';
        if(preg_match($patten,$param)){
            return true;
        }
        $this->setError($name.' 格式不正确.');
        return false;
    }

    /**
     * @param string $password1
     * @param string $password2
     * @return bool
     */
    function check_password($password1,$password2){
        if($password1 === $password2){
            return true;
        }
        $this->setError('两次输入密码不同.');
        return false;
    }

    /**
     * @param string $param
     * @param string $name
     * @return bool
     */
    function check_numeric($param,$name=''){
        $pattern = '/^[0-9]*$/';
        if(preg_match($pattern,$param)){
            return true;
        }
        $this->setError($name.' 需要是数字.');
        return false;
    }

    function checkUploadFile($file,$name=""){
        if(!empty($file)){
            $fileUrl = GAPP_ROOT_PATH.'/'.$file;

            if(file_exists($fileUrl)){
                return true;
            }
            $this->setError($name.' 需要上传.');
        }
        return false;
    }



}