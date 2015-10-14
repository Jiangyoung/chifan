<?php
namespace Index\Action\User;

use Common\Action\BaseAction;
use Common\Util\Http;
use Index\Model\User;

class loginAction extends BaseAction{
    function execute(){
        if($this->isPost){
            $this->verifyVerifyCode(Http::getPOST('_verifyCode'));
            $username = Http::getPOST('username');
            $password = md5(Http::getPOST('password'));
            $user = new User();
            $res = $user->validatePassword($username,$password);
            if(!$res){
                Http::redirect(GAPP_PASSWORD_VERIFY_FAILED);
            }
            $_SESSION['_USER_INFO'] = $res;

            Http::redirect('index.php');
        }else{
            $this->render('index/user_login.php');
        }
    }
    private function verifyVerifyCode($verifyCode){
        if($_SESSION['_verifyCode'] != md5($verifyCode)){
            Http::redirect(GAPP_WRONG_VERIFYCODE);
        }
    }
    private function validatePassword(){
        $username = Http::getPOST('username');
        $password = md5(Http::getPOST('password'));
        $user = new User();
        if(!$user->validatePassword($username,$password)){
            Http::redirect(GAPP_PASSWORD_VERIFY_FAILED);
        }
    }
}