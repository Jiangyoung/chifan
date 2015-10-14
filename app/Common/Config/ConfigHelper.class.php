<?php
namespace Common\Config;
class ConfigHelper{
	static function getConfigs($confName){
		return (require "{$confName}.conf.php");
	}
	static function loadConfigs($confName){
		require "{$confName}.conf.php";
	}
}

?>