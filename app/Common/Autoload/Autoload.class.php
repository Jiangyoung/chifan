<?php
namespace Common\Autoload;
class Autoload
{
	static function start(){
		spl_autoload_register('\\Common\\Autoload\\Autoload::autoload');
	}
	static function reset(){
		spl_autoload_unregister('\\Common\\Autoload\\Autoload::autoload');
	}
	static function autoload($className){
		$fileName = str_replace('\\','/',GAPP_BASEDIR.'/'.$className.'.class.php');
		if(file_exists($fileName)){
			require_once $fileName;
		}else{
			die("File({$fileName}) does not exists!");
		}
	}

}
?>