<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:frame.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );
include("./include/common.inc.php");

if(!$ra->isLoged()){
  $ra->goto('index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title><?php echo $lang['zvchat_room']; ?></title>
<META  HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8" />
<LINK href="main.css" rel="stylesheet" type="text/css" />
<script src="./js/prototype.js" type="text/javascript"></script>
<script src="./js/main.js" type="text/javascript"></script>
<script type='text/javascript'>
var agt = navigator.userAgent.toLowerCase();
var timelimit=3000;
var is_op = (agt.indexOf("opera") != -1);
var is_ie = (agt.indexOf("msie") != -1) && document.all && !is_op;
var is_ie5 = (agt.indexOf("msie 5") != -1) && document.all && !is_op;

var req=null;
var AThread=null;
var console=null;
var READY_STATE_UNINITIALIZED=0;
var READY_STATE_LOADING=1;
var READY_STATE_LOADED=2;
var READY_STATE_INTERACTIVE=3;
var READY_STATE_COMPLETE=4;

function loadXMLDoc(url) {
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (is_ie) {
		/* Guaranteed to be ie5 or ie6 */
		var control = (is_ie5) ? "Microsoft.XMLHTTP" : "Msxml2.XMLHTTP";
		try {
			req = new ActiveXObject(control);
		} catch (ex) {
			/* TODO: better help message */
			 alert("You need to enable active scripting and activeX controls");  
		}
	} 
    if (req) {
        req.onreadystatechange = processReqChange;
        req.open("GET", url, true);
        req.send(null);
        }
}
function clearchat(){
	$('console').innerHTML='';
}
function processReqChange(){
  var ready=req.readyState;
  var data=null;
  if(ready != 4){
  	clearTimeout(AThread);
  	AThread=setTimeout("loaddata()",timelimit);
  }
  if (ready==READY_STATE_COMPLETE){
    data=req.responseText;
  }else{
  	data="";
  }
  if(data != ""){
  toConsole(data);
}
}

function toConsole(data){
console=document.getElementById('console');
hidstamp=document.getElementById('hs');
asc=document.getElementById('autoscroll');
  if (console!=null){
//    console.innerHTML+=data;
    dt=data.split("|=|");
   // alert(dt[0]);
    console.innerHTML+=dt[1];
    hidstamp.value=dt[0];
    if(asc.checked){
  window.scrollTo(0,document.body.scrollHeight)}
  }
}

window.onload=function(){
loaddata();

}
function loaddata(){
var hidstamp=document.getElementById('hs');
var htm=hidstamp.value;
var pars="?tm="+htm;
	loadXMLDoc("./mainframe.php"+pars);
}
</script>

</head>

<body>
       <input type="hidden" value="0" id="hs" />
       <div id="d1"> 	
<div id='console'></div>
</div>
       <div id="d3">
       	<div id="onlinephp"></div>
       <div id="emdiv"></div>
       <?php echo $lang['to']; ?>
       <input type="text" id="touser" value="<?php echo $lang['allbody']; ?>" size="5" />
       <a href="#" onclick="cct('<?php echo $lang['allbody']; ?>')"><?php echo $lang['allbody']; ?></a>
       <?php echo $lang['say']; ?>
       &nbsp;<a href="#" onclick="showEM()">[<?php echo $lang['emot_face']; ?>]</a>
       &nbsp;<a href="#" onclick="showOnline()"><?php echo $lang['online_list']; ?></a>
       &nbsp;<a href="#" onclick="clearchat()"><?php echo $lang['clear_screen']; ?></a>
       &nbsp;<a href="#" onclick="exit()"><?php echo $lang['exit_room']; ?></a>
       <input type="checkbox" id="autoscroll"  />
 <?php echo $lang['auto_scroll']; ?>
       
       <br />

       <div id="ad">
<pre>       	
 <?php
 echo file_get_contents("ad.txt");
 ?>
</pre>
       	
      </div>
            <textarea rows="5" cols="59" id="msg" onkeydown="ctlent(event)">	</textarea>	<br />
            <input type="button" id="submitmsg" onclick="postmsg()" name="submitmsg" value="(CTRL+Enter)<?php echo $lang['send_msg']; ?>" class="submit"  />
       <span id="msg_status" style="visiblity:hidden"></span>
<a href="http://www.netroby.cn">1.0beta</a>
       </div>
</body>

</html>
