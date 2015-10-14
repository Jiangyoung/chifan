<?php
namespace Common\Tpl;
use Common\Util\Http;

class PhpEngine{
	private $templatesDir = GAPP_TPLDIR;
	private $currentTplDir = '';
	function __construct(){

	}

	/**
	 * @param string $params 参数
	 * @param string $fileName 文件 (路径为 templates/$fileName)
	 * @return string 返回渲染完成后的html代码
	 */
	function fetch($params,$fileName){
		$filePath = $this->templatesDir.'/'.$fileName;
		$this->currentTplDir = dirname($filePath);
		if(!file_exists($filePath)){
			die('File "'.$filePath.'" does not exists!');
		}
		ob_start();
		extract((array)$params);
		include $filePath;
		$ret = ob_get_contents();
		ob_end_clean();
		return $ret;
	}
	function load($fileName,$params = array()){
		$filePath = $this->currentTplDir.'/'.$fileName;
		if(!file_exists($filePath)){
			return ;
			//die('File "'.$filePath.'" does not exists!');
		}else{
			extract((array)$params);
			include $filePath;
		}
	}

	function getHtmlByUrl($url,$data=''){
		$res = Http::https_request($url,$data);
		return $res;
	}


	/**
	 * @param $file 文件名
	 * @return string 返回对应文件名的URL
	 */
	function getFileUrl($file){
        if(empty($file)){
            return '';
        }
        $baseUrl = rtrim(GAPP_ROOT_URL,'/\\');
		return $baseUrl.'/'.$file;
	}
}