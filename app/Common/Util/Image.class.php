<?php
namespace Common\Util;

use \Common\Util\String;

class Image {

    /**
     * 取得图像信息
     * @param string $img 图像文件名
     * @return mixed
     */
    static function getImageInfo($img) {
        $imageInfo = getimagesize($img);
        if ($imageInfo !== false) {
            $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1));
            $imageSize = filesize($img);
            $info = array(
                "width" => $imageInfo[0],
                "height" => $imageInfo[1],
                "type" => $imageType,
                "size" => $imageSize,
                "mime" => $imageInfo['mime']
            );
            return $info;
        } else {
            return false;
        }
    }


    /**
     * 生成缩略图
     *@param string $image  原图
     *@param string $type 图像格式
     *@param string $thumbname 缩略图文件名
     *@param int $maxWidth  宽度
     *@param int $maxHeight  高度
     *@param boolean $interlace 启用隔行扫描
     *@return void
     */
    static function thumb($image, $thumbname, $type='', $maxWidth=200, $maxHeight=50, $interlace=true) {
        // 获取原图信息
        $info = self::getImageInfo($image);
        if ($info !== false) {
            $srcWidth = $info['width'];
            $srcHeight = $info['height'];
            $type = empty($type) ? $info['type'] : $type;
            $type = strtolower($type);
            $interlace = $interlace ? 1 : 0;
            unset($info);
            $scale = min($maxWidth / $srcWidth, $maxHeight / $srcHeight); // 计算缩放比例
            if ($scale >= 1) {
                // 超过原图大小不再缩略
                $width = $srcWidth;
                $height = $srcHeight;
            } else {
                // 缩略图尺寸
                $width = (int) ($srcWidth * $scale);
                $height = (int) ($srcHeight * $scale);
            }

            // 载入原图
            $createFun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);
            if(!function_exists($createFun)) {
                return false;
            }
            $srcImg = $createFun($image);

            //创建缩略图
            if ($type != 'gif' && function_exists('imagecreatetruecolor'))
                $thumbImg = imagecreatetruecolor($width, $height);
            else
                $thumbImg = imagecreate($width, $height);
            //png和gif的透明处理 by luofei614
            if('png'==$type){
                imagealphablending($thumbImg, false);//取消默认的混色模式（为解决阴影为绿色的问题）
                imagesavealpha($thumbImg,true);//设定保存完整的 alpha 通道信息（为解决阴影为绿色的问题）
            }elseif('gif'==$type){
                $trnprt_indx = imagecolortransparent($srcImg);
                if ($trnprt_indx >= 0) {
                    //its transparent
                    $trnprt_color = imagecolorsforindex($srcImg , $trnprt_indx);
                    $trnprt_indx = imagecolorallocate($thumbImg, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                    imagefill($thumbImg, 0, 0, $trnprt_indx);
                    imagecolortransparent($thumbImg, $trnprt_indx);
                }
            }
            // 复制图片
            if (function_exists("ImageCopyResampled"))
                imagecopyresampled($thumbImg, $srcImg, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
            else
                imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);

            // 对jpeg图形设置隔行扫描
            if ('jpg' == $type || 'jpeg' == $type)
                imageinterlace($thumbImg, $interlace);

            // 生成图片
            $imageFun = 'image' . ($type == 'jpg' ? 'jpeg' : $type);
            $imageFun($thumbImg, $thumbname);
            imagedestroy($thumbImg);
            imagedestroy($srcImg);
            return $thumbname;
        }
        return false;
    }
    /**
     * 生产图像验证码(直接输出图像)
     * void
     * @param int $length 位数
     * @param int $mode 字符类型（1.0-9 2.A-Za-z 3.A-Za-z0-9 4.中文 其他.A-Za-z0-9(去掉LlIiOo01)）
     * @param string $type 图像格式
     * @param int $width 图像宽
     * @param int $height 图像高
     * @param string $verifyName 验证码名称
     *
     */
    static function buildImageVerify($length=4, $mode=1, $type='png', $width=50, $height=24, $verifyName='verify'){
        $verifyCode = String::randString(4,1);
        $_SESSION[$verifyName] = md5($verifyCode);

        $img = null;
        if ($type != 'gif' && function_exists('imagecreatetruecolor')) {
            $img = imagecreatetruecolor($width, $height);
        } else {
            $img = imagecreate($width, $height);
        }
        $r = Array(225, 255, 255, 223);
        $g = Array(225, 236, 237, 255);
        $b = Array(225, 236, 166, 125);
        $key = mt_rand(0, 3);

        //背景色
        $backColor = imagecolorallocate($img, $r[$key], $g[$key], $b[$key]);
        //边框色
        $borderColor = imagecolorallocate($img, 100, 100, 100);
        imagefilledrectangle($img, 0, 0, $width - 1, $height - 1, $backColor);
        imagerectangle($img, 0, 0, $width - 1, $height - 1, $borderColor);
        $stringColor = imagecolorallocate($img, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
        // 干扰
        for ($i = 0; $i < 10; $i++) {
            imagearc($img, mt_rand(-10, $width), mt_rand(-10, $height), mt_rand(30, 300), mt_rand(20, 200), 55, 44, $stringColor);
        }
        for ($i = 0; $i < 25; $i++) {
            imagesetpixel($img, mt_rand(0, $width), mt_rand(0, $height), $stringColor);
        }
        for ($i = 0; $i < $length; $i++) {
            imagestring($img, 5, $i * 10 + 5, mt_rand(1, 8), $verifyCode{$i}, $stringColor);
        }
        self::output($img);
    }

    static function output($img,$type = 'png'){
        header('Content-type:image/'.$type);
        $imgFunc = 'image'.$type;
        $imgFunc($img);
        imagedestroy($img);
    }
}