<!DOCTYPE html>
<html>
<head>
    <?php $this->load('widget/header.php'); ?>
    <link rel="stylesheet" href="<?php echo $this->getFileUrl('static/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css'); ?>" type="text/css" media="screen" />
</head>
<body class="container">
<div class="page-header">
    <h1><?php echo $actionName?></h1>
</div>
<table class="table table-hover">
    <thead>
    <tr>
        <th>#</th><th>相关设备</th><th>负责管理员</th><th>类型</th><th>数量</th><th>时间</th><th>备注</th><th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($list as $k => $v){ ?>
        <tr>
            <td><?php echo $k+1; ?></td>
            <td>
                <a class="equipment-info" href="index.php?c=equipment&a=info&id=<?php echo $v['e_id']; ?>"><?php echo $v['equipmentText']; ?> </a>
            </td>
            <td>
                <a class="user-info" href="index.php?c=user&a=info&id=<?php echo $v['admin_id']; ?>"><?php echo $v['adminText']; ?> </a>
            </td>
            <td><?php echo $v['typeText']; ?></td>
            <td><?php echo $v['amount']; ?></td>
            <td><?php echo $v['create_timeText']; ?></td>

            <td><?php echo $v['remark']; ?></td>
            <td>
                <p></p><a href="#" class="btn btn-default">修改</a></p>
                <p><button data="<?php echo $v['id']; ?>" class="btn-delete btn btn-default">删除</button></p>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php echo $pageNav; ?>
<?php $this->load('widget/footer.php'); ?>
<script type="text/javascript" src="<?php echo $this->getFileUrl('static/jquery-1.4/jquery.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo $this->getFileUrl('static/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->getFileUrl('static/jquery.fancybox-1.3.4/fancybox/jquery.easing-1.3.pack.js'); ?>"></script>
<script type="text/javascript" >
    $(function(){
        $("a.user-info a.equipment-info").fancybox({
            'width':'45%',
            'height':'85%',
            'type':'iframe',
            'transitionIn'	:	'elastic',
            'transitionOut'	:	'elastic',
            'speedIn'		:	300,
            'speedOut'		:	200,
            'overlayShow'	:	false
        });
        $("button.btn-delete").click(function(){
            var id = $(this).attr("data");
            var _token = "<?php echo $_token; ?>";
            var url = "index.php?c=equipment&a=delete";
            var post_data = {"id":id,"_token":_token};
            $.post(url,post_data,function(data,status){
                if("success" == status){
                    confirm(data.msg);
                    location.reload();
                }
            },"json");
        });
    });
</script>
</body>
</html>