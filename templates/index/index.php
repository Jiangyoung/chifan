<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $this->getFileUrl('static/images/logo.jpg'); ?>">

    <?php $this->load('widget/header.php'); ?>


    <title>管理中心</title>
</head>
<frameset frameborder="0" border="0" rows="60,*" >
    <frame scrolling="no"  src="index.php?c=index&a=index&case=top"/>

        <frameset frameborder="0" border="0"  cols="255,*" >
            <frame src="index.php?c=index&a=index&case=left">
            <frame name="container" src="index.php?c=index&a=list" noresize>
        </frameset>

    <frame scrolling="no" src="index.php?c=index&a=index&case=footer"/>
</frameset>
<div class="container-fluid">
</div>
<?php $this->load('widget/footer.php'); ?>
</body>
</html>
