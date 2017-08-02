<?php
//核心类
final class KUAIXUEPHP
{
	public static function run(){
		//设置常量
		self::_set_const();
		//创建应用所需文件夹
		self::_create_dir();
		//载入应用所需核心文件
		self::_import_file();
		Application::run();
	}
	//设置应用所需常量
	private static function _set_const(){
		//var_dump(__FILE__);//string(52) "D:\phpStudy\WWW\KUAIXUEAPP\KUAIXUEPHP\KUAIXUEPHP.php"
		//设置框架根目录
		$path = str_replace("\\", "/", __FILE__);
		define("KUAIXUEPHP_PATH",dirname($path));//dirname() 函数返回路径中的目录部分。不带最后一个反斜杠
		//echo KUAIXUEPHP_PATH;//D:/phpStudy/WWW/KUAIXUEAPP/KUAIXUEPHP   

		define("CONFIG_PATH",KUAIXUEPHP_PATH."/Config");
		define("DATA_PATH",KUAIXUEPHP_PATH."/Data");
		define("LIB_PATH",KUAIXUEPHP_PATH."/Lib");
		define("CORE_PATH",LIB_PATH."/Core");
		define("FUNCTION_PATH",LIB_PATH."/Function");


		define("ROOT_PATH",dirname(KUAIXUEPHP_PATH));
		//临时目录
		define("TEMP_PATH",ROOT_PATH.'/Temp');
		//日志目录
		define("LOG_PATH",TEMP_PATH.'/Log');
		//应用目录
		define("APP_PATH",ROOT_PATH.'/'.APP_NAME);
		define("APP_CONFIG_PATH",APP_PATH.'/Config');
		define("APP_CONTROLLER_PATH",APP_PATH.'/Controller');
		define("APP_TPL_PATH",APP_PATH.'/Tpl');
		define("APP_PUBLIC_PATH",APP_TPL_PATH."/Public");
		
	}
	//运行框架核心类系统自动创建应用目录
	private static function _create_dir(){
		$arr = array(
			APP_PATH,
			APP_CONFIG_PATH,
			APP_CONTROLLER_PATH,
			APP_TPL_PATH,
			APP_PUBLIC_PATH,
			TEMP_PATH,
			LOG_PATH
			);

		foreach($arr as $v){
			is_dir($v) || mkdir($v,0777,true);
		}

		//将系统默认的success.html和error.html复制到用户创建项目中
		is_file(APP_TPL_PATH.'/success.html')||copy(DATA_PATH.'/Tpl/success.html',APP_TPL_PATH.'/success.html');
		is_file(APP_TPL_PATH.'/error.html')||copy(DATA_PATH.'/Tpl/error.html',APP_TPL_PATH.'/error.html');
	}


	//载入应用所需核心文件
	private static function _import_file(){
		$flieArr = array(
			FUNCTION_PATH.'/function.php',
			CORE_PATH.'/Log.class.php',
			CORE_PATH.'/Controller.class.php',
			CORE_PATH.'/Application.class.php'
			);
		foreach($flieArr as $v){
			require_once $v;
		}
	}



}

KUAIXUEPHP::run();