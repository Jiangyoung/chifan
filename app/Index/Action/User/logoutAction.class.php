<?php
/**
 * Created by PhpStorm.
 * User: Jiangyoung
 * Date: 2015/5/26
 * Time: 17:05
 */
namespace Index\Action\User;

use Common\Action\BaseAction;
use Common\Util\Http;

class logoutAction extends BaseAction {
    function execute(){
        unset($_SESSION['_USER_INFO']);
        Http::redirect('index.php');
    }
}