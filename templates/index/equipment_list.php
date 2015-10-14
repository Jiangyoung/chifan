<!DOCTYPE html>
<html>
<head>
    <?php $this->load('widget/header.php'); ?>
</head>
<body class="container">
<div class="page-header">
    <h1><?php echo $actionName?></h1>
</div>
<table class="table table-hover">
    <thead>
    <tr>
        <th>#</th><th>设备名称</th><th>类型</th><th>型号</th><th>状态</th><th>图片</th><th>描述</th><th>备注</th><th>数量</th><th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($list as $k => $v){ ?>
        <tr>
            <td><?php echo $k+1; ?></td>
            <td><?php echo $v['name']; ?></td>
            <td><?php echo $v['typeText']; ?></td>
            <td><?php echo $v['model']; ?></td>
            <td><?php echo $v['stateText']; ?></td>
            <td><img src="<?php echo $this->getFileUrl($v['photo_path']); ?>" class="thumbnail" style="width:80px;" /></td>
            <td>
                <?php echo $v['description']; ?>
            </td>
            <td><?php echo $v['remark']; ?></td>
            <td><?php echo $v['amount']; ?></td>
            <td>
                <p><a href="#" class="btn btn-default">修改</a></p>
                <p><button data="<?php echo $v['id']; ?>" class="btn-delete btn btn-default">删除</button></p>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php echo $pageNav; ?>
<?php $this->load('widget/footer.php'); ?>
<script>
    $(function() {
        $("button.btn-delete").click(function () {
            var id = $(this).attr("data");
            var _token = "<?php echo $_token; ?>";
            var url = "index.php?c=equipment&a=delete";
            var post_data = {"id": id, "_token": _token};
            $.post(url, post_data, function (data, status) {
                if ("success" == status) {
                    confirm(data.msg);
                    location.reload();
                }
            }, "json");
        });
    });
</script>
</body>
</html>