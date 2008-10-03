/**
*  Author:netroby<netroby@live.cn>
*  File:main.js
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/

function ctlent(event) {
  if((event.ctrlKey && event.keyCode == 13) || (event.altKey && event.keyCode == 83)) {

    postmsg();
  }
}
function postmsg() {
  var requesturl = 'postmsg.php';
  var msg= $F('msg');
  var touser = $F('touser');
  var hidstamp = $F('hs');
  var pars = 'msg=' + msg+'&touser='+touser+'&hs='+hidstamp ;
 var  my  =   new  Ajax.Request(
   requesturl, 
     {
    method: 'POST',
    parameters: pars,
    asynchronous:  true ,
    onFailure:resenddata(pars),
    oncomplete: showResponse(pars)
   } ); 
  $('msg').value="";
}
function showResponse(pars){
//	resenddata(pars);
}
function resenddata(data){
	var requesturl= 'postmsg.php';
	var pars=data;
	var p= new  Ajax.Request(
   requesturl, 
     {
    method: 'POST',
    parameters: pars,
    asynchronous:  true ,
    oncomplete: showResponse(pars)
   } ); 
  }
function cct(user){
  $('touser').value=user;
}
function pcct(user){
	parent.document.getElementById("touser").value=user;
}
function insertem(i){
  $('msg').value += "[em"+i+"]";
}
function exit(){
  self.location="logout.php";
}
function check(event){
  if((event.ctrlKey && event.keyCode == 13) || (event.altKey && event.keyCode == 83)&&(pcmsg.value!=null)) {
    $F('go').submit();
  }
}
function gopc(val){

  var gt = unescape('%3e');
  var popup = null;
  var over = "Launch Pop-up Navigator";
  popup = window.open('', 'popupnav', 'width=560,height=460,resizable=1,scrollbars=auto');
  if (popup != null) {
    if (popup.opener == null) {
      popup.opener = self;
    }
    popup.location.href = val;
  }
}

function showEM(){
	var cmem;
	var mem= new Ajax.Updater("emdiv","./showem.php",{method:"post"});
$("emdiv").style.visibility="visible";
}
function closeEM(){
	$("emdiv").innerHTML="";
	$("emdiv").style.visibility="hidden";
}
function showOnline(){
var cson;
	var son= new Ajax.Updater("onlinephp","./online.php",{method:"post"});
	$("onlinephp").style.visibility="visible";
}
function closeSO(){
	$("onlinephp").innerHTML="";
	$("onlinephp").style.visibility="hidden";
}