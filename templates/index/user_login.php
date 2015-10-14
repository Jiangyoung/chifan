<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="<?php echo $this->getFileUrl('static/css/index/user_login.css'); ?>" rel="stylesheet"/>
    <style>body {
            background-color:#f6f8f9;
            background-image:none;
        }
        .login h1 img{ vertical-align:bottom;}
    </style>
</head>
<body>
<div class="login">
    <h1>
        <img src="<?php echo $this->getFileUrl('static/images/logo.jpg'); ?>" width="32" style="float:left; margin-right:10px;"/>设备管理系统</h1>
    <form action="" method="post" id="myform">
        <div class="login-top">
            <img src="<?php echo $this->getFileUrl('static/images/user_login/login-top.jpg'); ?>" />
        </div>
        <div class="login-center">
            <ul><li> 用户名:<br /><input name="username" type="text" class="input-text1" value="" style="width:320px;padding:0px 8px;"/></li>
                <li> 密 码:<br /><input name="password" type="password" class="input-text1" style="width:320px;padding:0px 8px;"/></li>
                <li> 验证码:<br /><input name="_verifyCode" type="text" class="input-text1" style="width:160px;padding:0px 8px;"/><img src="index.php?c=index&a=getVerify"  title="点击刷新验证码" class="verify_img" id="verify"  style="cursor:pointer; vertical-align:bottom; margin-left:5px;"></li>
            </ul>
        </div>
        <div>
            <img src="<?php echo $this->getFileUrl('static/images/user_login/login_bottom.jpg'); ?>" />
        </div>
        <input type="hidden" name="_token" value="<?php echo $_token; ?>">
        <input type="submit" value=" " name="do" class="login-button" style="cursor:pointer;"/>
    </form></div>

<?php $this->load('widget/footer.php'); ?>

</script>
<script>
    $(function(){


        $(".verify_img").click(function(){
            var timenow = new Date().getTime();
            $(this).attr("src","index.php?c=index&a=getVerify&"+timenow)
        });
    });
</script>
</body>
</html>