<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->load('widget/header.php'); ?>
    <link href="<?php echo $this->getFileUrl('static/css/index/dashboard.css'); ?>" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li class="active nav-tag">信息管理 <span class="sr-only">(current)</span></li>
            <li><a href="index.php?c=index&a=list" target="container">概况管理</a></li>
            <li><a href="index.php?c=index&a=query" target="container">查询管理</a></li>
        </ul>
        <ul class="nav nav-sidebar">
            <li class="active nav-tag">用户管理 <span class="sr-only">(current)</span></li>
            <li><a href="index.php?c=user&a=add" target="container">添加用户</a></li>
            <li><a href="index.php?c=user&a=list" target="container">用户管理</a></li>
        </ul>
        <ul class="nav nav-sidebar">
            <li class="active nav-tag">设备管理 <span class="sr-only">(current)</span></li>
            <li><a href="index.php?c=equipment&a=add" target="container">添加设备</a></li>
            <li><a href="index.php?c=equipment&a=list" target="container">设备管理</a></li>
        </ul>
        <ul class="nav nav-sidebar">
            <li class="active nav-tag">实验室管理 <span class="sr-only">(current)</span></li>
            <li><a href="index.php?c=place&a=add" target="container">添加实验室</a></li>
            <li><a href="index.php?c=place&a=list" target="container">实验室管理</a></li>
        </ul>
        <ul class="nav nav-sidebar">
            <li class="active nav-tag">设备借还/维护管理 <span class="sr-only">(current)</span></li>
            <li><a href="index.php?c=circulate&a=add" target="container">添加设备借还/维护</a></li>
            <li><a href="index.php?c=circulate&a=list" target="container">设备借还管理</a></li>
            <li><a href="index.php?c=maintain&a=list" target="container">维护信息统计</a></li>
        </ul>
    </div>
</div>
</div>

</body>
</html>