<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:online.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
include("./include/common.inc.php");
//如果用户没有登陆就退出程序
if(!$ra->isLoged()){
  $ra->goto('index.php');
}

?>
 <div>
 	         <div> <?php echo $lang['online_list']; ?>
 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         
 	
 	<a href="#"  onclick="closeSO()">[X]</a>	
 	         	</div><br />

<?php
$ra->checkIsOut();
$ra->listonline();

?>
</div>