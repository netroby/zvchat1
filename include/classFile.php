<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:classFile.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
class chat{
  public $msgDir='./data/zv_msgs';
  
  
  /**
  *public function: getChatData;
  *usage:$this->getChatData($ptm);
  *description:get all chat data from the data dir
  *$ptm is the timestamp of the last modify time or the user first login genaration time
  *
  */
  //Get all of the chat data
  public	function getChatData($ptm){
$dir=$this->msgDir;
$flist=array();
$fptm=$ptm;
// Open a known directory, and proceed to read its contents
//is dir


if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." ) {
           $fex=explode('.',$file);
            //compare the time if the file time is large than ptm then continue
            if($fex[0]>$ptm){
            	$fcda.=file_get_contents($dir."/".$file);
            	if($fex[0]>=$fptm){$fptm=$fex[0];}
            	            }
        }
    }
    $flist['fptm']=$fptm;
    $flist['fcdt']=$fcda;

}
$this->clearChatData();
    return $flist;
  }
  public function clearChatData(){
  $time=time();
  $dir=$this->msgDir;
 $otm=$time-300;
  if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." ) {
           $fex=explode('.',$file);
            //compare the time if the file time is large than ptm then continue
            if($fex[0]<$otm){
            	unlink($dir."/".$file);
            	            	            }
        }
    }
  
}
  
  }
  
  public function displayChatData($data){
    //计算聊天文件的总条数
    $time=time();
    $fc=count($data);
    //分条处理，递加。
    for($i=$fc-1;$i>0;$i--){
    //base64解码聊天句段
      $fout=base64_decode($data[$i]);
      //分割时间和聊天内容
      $feo=explode("[texp]",$fout);
      //整数化时间
      $ts=(int) $feo[0];
      //格式化时间显示
      $sout=date("[Y/m/d]|[H:i:s]", $ts);
     //debug修正未知的时间显示
 $sout=str_replace("[1970/01/01]|[00:00:00]","",$sout);
 //分割时间
 $sexp=explode("|",$sout);
      //定义日期的序列
      $year=$sexp[0];
      $ctime=$sexp[1];
      //设定显示的结果
      $su="<a href=\"#\" title=\"".$year."\"><span style=\"color:#CBA987\">".$ctime."</span></a>";
      //整合显示的结果
      $sou=$su.$feo[1];
      //修正，并累积聊天显示的结果。
      echo $ptm;
      if($ptm<$ts){
    $vout.= $sou;
  }
    }
    $vo=str_replace("[1970/01/01 00:00:00]","",$vout);
     echo "{$time}|=|{$vo}";
  }
  public function displayChat(){
    $fo=$this->getChatData();
    $this->displayChatData($fo);
  }
  public function deleteData($did){
    $fo=$this->getChatData();
    $fc=count($fo);
    for($i=0;$i<$fc;$i++){
      if($did != $i){
        $fd[]= $fo[$i];
      }
    }
    if($this->writeToData($fd)){
    	return true;
    }else{
    	return false;
    }
    
  }
  public function writeToData($data){
    $filename=$this->cacheFile;
    $handle=@fopen($filename,"w+");
$fd=$data;
$fc=count($fd);
for($i=0;$i<$fc;$i++){
	if($fd[$i]!==""){
		$dat.=$fd[$i]."[EXP]";
	}
}
    while ($handle=== FALSE && $i++ < 20) {
      clearstatcache();
      usleep(rand(5,85));
      $handle = @fopen ($filename, 'w+');
    }

    if($handle !== false){

      $fp=fwrite($handle,$dat);
      fclose($handle);
      return true;
    }else{
    	return false;
    }
  }
  public function postData($ftm,$data){
  	$dir=$this->msgDir;
  	$filename=$dir.'/'.$ftm.'.php';
  	$handle = @fopen ($filename, 'w+');
    if($handle !== false){
      $fp=fwrite($handle,$data);
      fclose($handle);
    }
  }
}
?>
