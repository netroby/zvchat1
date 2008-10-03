<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:mainframe.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
include("./include/common.inc.php");


header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );
$time=time();
$ptm=$_REQUEST['tm']?$_REQUEST['tm']:$time;
$getChats=$fsys->getChatData($ptm);
echo $getChats['fptm']."|=|".$getChats['fcdt'];

?>
