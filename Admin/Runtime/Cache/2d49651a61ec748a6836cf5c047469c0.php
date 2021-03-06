<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>项目管理系统 by www.nongfuit.com</title>
    <link href='__PUBLIC__/plugins/font-awesome/css/font-awesome.min.css' rel="stylesheet" type="text/css" />
    <link href='__PUBLIC__/plugins/bootstrap/css/bootstrap.min.css' rel="stylesheet" type="text/css" />
    <link href="../Public/css/css.css" rel="stylesheet" type="text/css" />
    <link href="../Public/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body id="updateUserPage">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>修改用户</h3>
        </div>
        <div class="panel-body">
            <form id="updateForm" onsubmit="return false" action="##" method="post">
                <label class="form-label">Username</label>
                <input class="form-control" id="name" name="name" value="<?php echo ($row[name]); ?>" />
                <label class="form-label">Password</label>
                <input class="form-control" name="password" id="pass" type="password" />
                <input type="hidden" name="id" id="id" value="<?php echo ($row[id]); ?>">
                <button class="button btn-primary form-control" type="submit" style="margin-top:20px;">Submit</button>
            </form>
        </div>
    </div>
</body>
<script src='__PUBLIC__/plugins/jquery/jquery.min.js'></script>
<script src='__PUBLIC__/plugins/bootstrap/js/bootstrap.min.js'></script>
<script>
    $(function() {
        $("#updateForm").submit(function(e){
            $.ajax({
                url:"<?php echo U('update');?>",
                type:'POST',
                data:{'name': $("#name").val(),'password':$('#pass').val(),'id':$('#id').val()},
                success:function(result){
                    // console.log(result);

                    var obj = JSON.parse(result);
                    console.log(obj);
                    if(obj.code){
                        alert(obj.errMsg);
                        console.log(obj.sql);
                    }else{
                        alert("Update successfully!");
                        window.location.href="<?php echo U('index');?>"; 
                    }
                }
            })
        });
    });
</script>
</html>