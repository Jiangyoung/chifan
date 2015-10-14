<!DOCTYPE html>
<html>
<head>
    <?php $this->load('widget/header.php'); ?>
    <link rel="stylesheet" href="<?php echo $this->getFileUrl('static/chosen_v1.4.2/chosen.min.css'); ?>" />
</head>
<body class="container">
<div class="page-header">
    <h1><?php echo $actionName?></h1>
</div>
<table class="table table-bordered">
    <tr>
        <td>用户名：</td><td><?php echo $info['username']; ?></td>
    </tr>
    <tr>
        <td>昵称：</td><td><?php echo $info['nickname']; ?></td>
    </tr>
    <tr>
        <td>头像：</td><td><img src="<?php echo $this->getFileUrl($info['photo_path']); ?>" class="thumbnail" style="width:80px;" /></td>
    </tr>
    <tr>
        <td>备注：</td><td><?php echo $info['remark']; ?></td>
    </tr>
</table>


</body>
</html>