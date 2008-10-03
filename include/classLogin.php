<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:classLogin.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
class rabc
{
  public $userDataFile="./user/users.index.php";
  public $onlineTimeLimit=5;

  public function praseLogInput(){
    $username = $_POST['username'] ? $_POST['username'] : '';
    $password = $_POST['password'] ? $_POST['password'] : '';
    if(!$username || !$password){
      die('please fill all the blank');
    }
    $inputData=Array(
                 'username' => $_POST['username'],
                 'password' => $_POST['password']
               );

    return $inputData;
  }
  public function checkLog($inputData){
    if(!$this->checkIfHas($inputData['username'])){
      $this->addNewUser($inputData);
      die("success register new user,please back for login use your account info <a href=\"index.php\">login</a>");
    }else{
      $upass=$this->getPassByUserName($inputData['username']);
      if($upass != md5($inputData['password'])){
        $this->loginFailure();
        return false;
      } else {
        return true;
      }
    }
  }
  public function checkIfHas($uname){
    $filename=$this->userDataFile;
    if(!file_exists($filename)){
    	touch($filename);
    }
    $handle=file($filename);
    $ch=count($handle);
    for($i=1;$i<$ch;$i++){
      $eh=explode("|",$handle[$i]);
      if($eh[0]==$uname){
        $com[]=$eh[0];
      }
    }
    $cs=count($com);
    if($cs>0){
      return true;
    }else {
      return false;
    }
  }
  public function sessionLogin($info){
    $this->sessionLogOut();
    $this->removeOnline();
    setcookie("uname",$info['username']);
  }
  public function sessionLogOut(){
    setcookie("uname","");
  }
  public function removeOnline(){
    $uname=$this->getUname();
    $this->setOnlineStatus($uname,'online');
  }
  public function listonline(){
    $filename=$this->userDataFile;
    $handle=file($filename);
    $ch=count($handle);
    for($i=1;$i<$ch;$i++){
      $eh=explode("|",$handle[$i]);
      if($eh[3]=="online"){
        $onlinelist.="<a href=\"#\" onclick=\"cct('".$eh[0]."')\">".$eh[0]."</a>&nbsp;&nbsp;\n";
        //$onlinelist.=$eh[0]."<br />\n";
      }
    }
    echo $onlinelist;
  }


  public function setOnlineStatus($uname,$status){
    $filename=$this->userDataFile;
    $handle=file($filename);
    $ch=count($handle);
    for($i=1;$i<$ch;$i++){
      $eh=explode("|",$handle[$i]);
      if($eh[0]==$uname){
        $setData.=$eh[0]."|".$eh[1]."|".$eh[2]."|".$status."|\n";
      }else{
        $setData.=$eh[0]."|".$eh[1]."|".$eh[2]."|".$eh[3]."|\n";
      }
    }
    $this->writeSetData($setData);
  }

  public function setOnlineTime($uname,$ontime){
    $filename=$this->userDataFile;
    $handle=file($filename);
    $ch=count($handle);
    for($i=1;$i<$ch;$i++){
      $eh=explode("|",$handle[$i]);
      if($eh[0]==$uname){
        $setData.=$eh[0]."|".$eh[1]."|".$ontime."|".$eh[3]."|\n";
      }else{
        $setData.=$eh[0]."|".$eh[1]."|".$eh[2]."|".$eh[3]."|\n";
      }
    }
    $this->writeSetData($setData);
  }
  public function getUname(){
    return $_COOKIE['uname'];
  }
  public function checkIsOut(){
    $filename=$this->userDataFile;
    $handle=file($filename);
    $ch=count($handle);
    for($i=1;$i<$ch;$i++){
      $eh=explode("|",$handle[$i]);
      $t1=$this->onlineTimeLimit;
      $t2=$t1*60;
      $timenow=time()-$t2;
      $timen=(int) $timenow;
      $utime=(int) $eh[2];
      if($utime < $timen){
        $this->setOnlineStatus($eh[0],"offline");
      }else{
        $this->setOnlineStatus($eh[0],"online");
      }

    }
  }

  public function writeSetData($setData){
    $filename=$this->userDataFile;
    $Data="<?php if(!defined('ZVH')) {	exit('System Halt');}?>\n".$setData;
    $handle=fopen($filename,"w");
    $fp=fwrite($handle,$Data);
    fclose($handle);
  }

  public function goto($Url){
    echo "<script language=\"javascript\" type=\"text/javascript\">";
    echo "window.location=\"".$Url."\";";
    echo "</script>";
  }
  public function isLoged(){
    if(!$_COOKIE['uname']){
      return false;
    }else {
      return true;
    }
  }
  public function getPassByUserName($pname){
    $filename=$this->userDataFile;
    $handle=file($filename);
    $ch=count($handle);
    for($i=1;$i<$ch;$i++){
      $eh=explode('|',$handle[$i]);
      if($pname==$eh[0]){
        return $eh[1];
      }
    }
  }
  public function addNewUser($inputData){
    $time=time();
    $username=$inputData['username'];
    $password=$inputData['password'];
    if(!file_exists($this->userDataFile)){
    	touch($this->userDataFile);
    }
    $fd=file_get_contents($this->userDataFile);
    $f=$fd.$username."|".md5($password)."|".$time."|online|\n";
 if((filesize($this->userDataFile))>4){
	$data=$f;
  }else{
   	$data="<?php if(!defined('ZVH')) {	exit('System Halt');}?>\n".$f;
  }
   $handle=fopen($this->userDataFile,"w");
    $fp=fwrite($handle,$data);
    fclose($handle);
  }
  public function loginFailure(){
    die("login failure <a href=\"index.php\" >Back</a>");
  }

}

