<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html Public "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>项目管理系统</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="../Public/css/css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="147" background="../Public/images/top02.gif"><img src="../Public/images/top03.gif" width="776" height="147" /></td>
  </tr>
</table>
<table width="562" border="0" align="center" cellpadding="0" cellspacing="0" class="right-table03">
  <tr>
    <td width="221"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="login-text01">
      
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="login-text01">
          <tr>
            <td align="center"><img src="../Public/images/ico13.gif" width="107" height="97" /></td>
          </tr>
          <tr>
            <td height="40" align="center">&nbsp;</td>
          </tr>
          
        </table></td>
        <td><img src="../Public/images/line01.gif" width="5" height="292" /></td>
      </tr>
    </table></td>
    <td>
      <form action='<?php echo U("check");?>' method='post'>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="31%" height="35" class="login-text02">用 户：<br /></td>
            <td width="69%"><input name="username" type="text" size="30" /></td>
          </tr>
          <tr>
            <td height="35" class="login-text02">密 码：<br /></td>
            <td><input name="password" type="password" size="33" /></td>
          </tr>
          <tr>
            <td class='login-text02'>验证码图片:</td> 
            <td><img src="<?php echo U('verify');?>" style='cursor:pointer'/></td>
            <!-- <img src="<?php echo U('verify');?>" onclick='this.src="<?php echo U('verify');?>/random/"+Math.random()' style='cursor:pointer'/> -->
          </tr>
          <tr>
            <td class='login-text02'>验证码:<br /></td>
            <td><input type="text" name='fcode'/></td>
          </tr>
          <tr>
            <td height="35">&nbsp;</td>
            <td><input name="Submit2" type="submit" class="right-button01" value="登陆" onClick="window.location='index.html'" />
              <input name="Submit232" type="reset" class="right-button02" value="重置" /></td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
</body>
</html>