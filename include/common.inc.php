<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:common.inc.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
//error_reporting(0);
set_magic_quotes_runtime(0);
$mtime = explode(' ', microtime());
$discuz_starttime = $mtime[1] + $mtime[0];

define('ZVH', TRUE);


header('Content-Type: text/html; charset=UTF-8');

if(PHP_VERSION < '4.1.0') {
	$_GET = &$HTTP_GET_VARS;
	$_POST = &$HTTP_POST_VARS;
	$_COOKIE = &$HTTP_COOKIE_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	$_ENV = &$HTTP_ENV_VARS;
	$_FILES = &$HTTP_POST_FILES;
}



require './include/classFile.php';
require './include/classLogin.php';
require './include/lang.php';

$timestamp = time()+(8*60*60);
$PHP_SELF = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
$SCRIPT_FILENAME = str_replace('\\\\', '/', (isset($_SERVER['PATH_TRANSLATED']) ? $_SERVER['PATH_TRANSLATED'] : $_SERVER['SCRIPT_FILENAME']));
$boardurl = 'http://'.$_SERVER['HTTP_HOST'].preg_replace("/\/+(api|archiver|wap)?\/*$/i", '', substr($PHP_SELF, 0, strrpos($PHP_SELF, '/'))).'/';

if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
	$onlineip = getenv('HTTP_CLIENT_IP');
} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
	$onlineip = getenv('HTTP_X_FORWARDED_FOR');
} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
	$onlineip = getenv('REMOTE_ADDR');
} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
	$onlineip = $_SERVER['REMOTE_ADDR'];
}




function random($length, $numeric = 0) {
	mt_srand((double)microtime() * 1000000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = '1234567';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}
function rancolor(){
	switch(random(1)){
		case "1":
		return $c="008000";
		case "2":
		return $c="800000";
		case "3":
		return $c="000080";
		case "4":
		return $c="ff8000";
		case "5":
		return $c="80aa00";
		case "6":
		return $c="0080ff";
		default:
		return $c="cc00cc";
	}
	}
	
	
	function convertem($msg){
		$fo=file("./sm/sm.txt");
		for($i=0;$i<67;$i++){
		$search[]="[em{$i}]";
		$replace[]="<img src=\"./sm/".$i.".gif\" title=\"".$fo[$i]."\" />";
			}
			$msg=str_replace($search,$replace,$msg);
				return $msg;
	
}
	$ra=new rabc();
	$fsys=new chat();
	
?>