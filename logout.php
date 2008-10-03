<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:logout.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
include("./include/common.inc.php");
$ra->removeOnline();
$ra->sessionLogOut();
$ra->goto("index.php");
?>
