<?php
/**
*  Author:netroby<netroby@live.cn>
*  File:index.php
*  Version:1.0beta
*  Time:2008-10-3 0:14:02
*  This software is free for any where.
*  it named zvchat.
*  provied the simple chat service.
*  more information please refer to this site
*  http://www.netroby.cn
*/
include("./include/common.inc.php");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="UTF-8" lang="UTF-8">
	
	<head>
	<title><?php echo $lang['zvchat_room']; ?></title>
	<META  HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="main.css" type="text/css" />
	</head>
		
<body>
	<div align="center">
	<div class="logindex">
	<div id="top"><strong><?php echo $lang['zvchat_room']; ?></strong></div>
	<div id="logmain">
		<form action="login.php" method="post">
			<?php echo $lang['please_login']; ?>
			<table>
					<tr><td><?php echo $lang['nickname']; ?></td><td><input type="text" name="username" maxlength="25" /></td></tr>
					<tr><td><?php echo $lang['password']; ?></td><td><input type="password" name="password" maxlength="30" /></td></tr>
			</table>
					<p><input type="submit" value="<?php echo $lang['login']; ?>" class="submit" /></p>
					<p>
						<?php echo $lang['notice']; ?>
						<?php echo $lang['if_you_have_registered_you_can_login_with_your_nickname_and_password']; ?>
						<br />
						<?php echo $lang['system_will_auto_register_for_you']; ?></p>
			</form>
	</div>
	</div>
	</div>
</body>

</html>