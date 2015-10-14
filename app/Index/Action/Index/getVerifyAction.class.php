<?php
namespace Index\Action\Index;

use Common\Util\Image;

class getVerifyAction {
    function execute(){
        Image::buildImageVerify(4,0,'png',50,24,'_verifyCode');
    }
}