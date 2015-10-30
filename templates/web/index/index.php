<!DOCTYPE html>
<html>
<head>
    <?php $this->load('index/widget/head.php'); ?>
</head>
<body>
<p>
    Index.
    <pre><?php print_r($data); ?></pre>
</p>
<div>
    <p>日期控件<input type="text" id="datepicker" value="" /></p>
</div>

<div style="margin-top:100px;">
    <span title="这里是tooltip空间">tooltip</span>
</div>
</body>

</html>