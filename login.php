<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:login.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
include './include/common.inc.php';

$inputData=$ra->praseLogInput();
if(!$ra->checkLog($inputData)){
	$ra->logFailure();
} else {
	$ra->sessionLogin($inputData);
	$otime=time();
	$uname=$inputData['username'];
	$ra->setOnlineTime($uname,$otime);
	$ra->setOnlineStatus($uname,"online");
	$ra->goto('frame.php');
}
?>