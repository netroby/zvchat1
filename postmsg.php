<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:postmsg.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
include("./include/common.inc.php");
if(!$ra->isLoged()){
  $ra->goto('index.php');
}
$msg=nl2br(htmlspecialchars($_POST['msg']));
if((strlen($msg) > 1000)||(strlen($msg) < 2)){
	exit();
}else {
$msg=convertem($msg);
$touser=nl2br(htmlspecialchars($_POST['touser']));
$touser=$touser ? $touser : "大家";
$color1="#".rancolor();
$color2="#".rancolor();
$color3="#".rancolor();
$color4="#".rancolor();
$username=$_COOKIE['uname'];
$time=time();
$ftime=date("Y-m-d H:i:s",$time);
$data.="<a href=\"#\" onclick=\"pcct('".$username."')\" title=\"{$ftime}\">";
$data.="<span style=\"color:$color2\">".$username."</span>";
$data.="</a>{$lang['say']}<a href=\"#\" onclick=\"pcct('".$touser."')\" title=\"{$ftime}\">";
$data.="<span style=\"color:$color3\">".$touser."</span></a>";
$data.="{$lang['to']}:<span style=\"color:$color4\">";
$data.=$msg."</span><br />";
$dat.=$data;
$otime=time();
$uname=$ra->getUname();
$ra->setOnlineTime($uname,$otime);
$fsys->postData($time,$dat);
}
?>
