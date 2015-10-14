<?php
namespace Index\Model;

use Common\Model\BaseModel;

/*
CREATE TABLE IF NOT EXISTS `iems_user`(
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(32) DEFAULT '' COMMENT '用户名',
  `nickname` VARCHAR(32) DEFAULT '' COMMENT '昵称',
  `password` VARCHAR(64) DEFAULT '' COMMENT '密码',
  `phone` VARCHAR(16) DEFAULT '' COMMENT '手机号',
  `email` VARCHAR(48) DEFAULT '' COMMENT '邮箱',
  `create_time` INT DEFAULT 0 COMMENT '添加时间',
  `photo_path` VARCHAR(128) DEFAULT '' COMMENT '头像路径',
  `type` TINYINT UNSIGNED DEFAULT 0 COMMENT '用户类型',
  `remark` VARCHAR(128) DEFAULT '' COMMENT '备注',
  `deleted` ENUM('n','y') DEFAULT 'n'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
 */

class User extends BaseModel{
    protected $tbName = 'user';
    protected $tbFields = array('id','username','nickname','password','phone','email','photo_path','type','remark','deleted');

    /**
     * @param string $username
     * @param string $password
     * @return array|bool
     */
    function validatePassword($username,$password){
        $conn = $this->getConnect();
        $username = $conn->real_escape_string($username);
        $password = $conn->real_escape_string($password);
        $sql = $conn->assembleSelectSQL($this->tbName,$this->tbFields," WHERE `username`='{$username}' AND `deleted`='n' LIMIT 1");

        $res = $conn->execute_dql($sql);
        if(isset($res[0])){
            $sql = $conn->assembleSelectSQL($this->tbName,$this->tbFields," WHERE `password`='{$password}' AND `deleted`='n' LIMIT 1");

            $res = $conn->execute_dql($sql);
            if(isset($res[0])){
                $res = $this->formatList($res);
                return $res[0];
            }
        }else{
            return false;
        }
    }

    function formatList($list){
        foreach($list as $k => $v){
            $list[$k]['typeText'] = $this->getTypeText($v['type']);
        }
        return $list;
    }

    /**
     * @param string $username
     * @return bool
     */
    function getUserByUsername($username){
        $conn = $this->getConnect();
        $username = $conn->real_escape_string($username);
        $sql = $conn->assembleSelectSQL($this->tbName,$this->tbFields," WHERE `username`='{$username}' AND `deleted`='n' LIMIT 1");
        $res = $conn->execute_dql($sql);
        if(isset($res[0])){
            return $res[0];
        }else{
            return false;
        }
    }
    function checkParams($params){
        $check = $this->getCheck();
        $check->check_password($params['password'],$params['password2']);
        $check->check_length($params['username'],1,15,'用户名');
        $check->check_phone($params['phone']);
        $check->checkUploadFile($params['photo_path'],'头像');
        if(!empty($params['username'])){
            $this->checkUsername($params['username'],$check);
        }
        $err = $check->getError();
        if(empty($err)){
            return true;
        }
        return false;
    }
    function checkUsername($username,$check){
        $conn = $this->getConnect();
        $username = $conn->real_escape_string($username);
        $sql = $conn->assembleSelectSQL($this->tbName,array('id')," WHERE `username`='{$username}' AND `deleted`='n' ");
        $res = $conn->execute_dql($sql);
        if(!$res){
            return true;
        }
        $check->setError('用户名已存在.');
        return false;
    }

    function getTypes(){
        return array(1,2,3);
    }
    function getTypeText($type){
        $text = '';
        switch($type){
            case 1:
                $text = '实验室管理员';
                break;
            case 2:
                $text = '维护人员';
                break;
            case 3:
                $text = '租借人员';
                break;
            case 5:
                $text = '全局管理员';
                break;
            default:
                $text = '普通新添';
        }
        return $text;
    }
    function getTypeTexts(){

        $res = array();
        $types = $this->getTypes();
        foreach($types as $type){
            $res[$type] = $this->getTypeText($type);
        }
        return $res;
    }
}