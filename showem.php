<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:showem.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
$fo=file("./sm/sm.txt");
for($i=0;$i<66;$i++){
echo  "<img src=\"./sm/".$i.".gif\" onclick=\"insertem('".$i."')\" title=\"".$fo[$i]."\">\n";
}
?>
<div align="center">
	<a href="#"   onclick="closeEM()">[X]</a>
	</div>  	 