<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>添加</title>

    <link rel="stylesheet" href="<?php echo $this->getFileUrl('static/bootstrap-3.3.4-dist/css/bootstrap.min.css'); ?>" />
    <script src="<?php echo $this->getFileUrl('static/jquery-1.11.2/jquery.min.js'); ?>"></script>
    <script src="<?php echo $this->getFileUrl('static/bootstrap-3.3.4-dist/js/bootstrap.min.js'); ?>"></script>

</head>
<body>
<form method="post" action="">
    用户名：&nbsp;&nbsp;<input type="text" name="username"/><br/><br/>
    密&nbsp;&nbsp;码：&nbsp;<input type="password" name="password1"/><br/><br/>
    确认密码：&nbsp;<input type="password" name="password2"/><br/><br/>
    <input type="submit" value="提交"/>
</form>
</body>
</html>