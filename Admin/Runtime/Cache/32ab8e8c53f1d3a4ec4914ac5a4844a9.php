<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>项目管理系统 by www.nongfuit.com</title>
    <link href='__PUBLIC__/plugins/font-awesome/css/font-awesome.min.css' rel="stylesheet" type="text/css" />
    <link href='__PUBLIC__/plugins/bootstrap/css/bootstrap.min.css' rel="stylesheet" type="text/css" />
    <link href="../Public/css/css.css" rel="stylesheet" type="text/css" />
    <link href="../Public/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <table width="198" border="0" cellpadding="0" cellspacing="0" class="left-table01">
        <tr>
            <TD>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="207" height="55" background="../Public/images/nav01.gif">
                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="25%" rowspan="2"><img src="../Public/images/ico02.gif" width="35" height="35" /></td>
                                    <td width="75%" height="22" class="left-font01">您好，<span class="left-font02"><?php echo $_SESSION['username'] ?></span></td>
                                </tr>
                                <tr>
                                    <td height="22" class="left-font01">
                                        [&nbsp;<a href="<?php echo U('Login/logout');?>" target="_top" class="left-font01">退出</a>&nbsp;]</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--  任务管理    -->
                <div>
                	<div class="toggle-parent left-table03">
                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                        用户管理
                	</div>
                	<ul class="toggle-son">
	                	<li><a href="<?php echo U('User/index');?>" target="mainFrame">查看用户</a></li>
	                	<li><a href="<?php echo U('User/add');?>" target="mainFrame">增加用户</a></li>              		
                	</ul>
                </div>
            </TD>
        </tr>
    </table>
</body>
<script src='__PUBLIC__/plugins/jquery/jquery.min.js'></script>
<script src='__PUBLIC__/plugins/bootstrap/js/bootstrap.min.js'></script>
<script>    
$(function(){
    $(".toggle-parent").click(function(){
        $(this).next(".toggle-son").toggle();
        $(this).children(".fa").toggle();
    })
})
</script>
</html>