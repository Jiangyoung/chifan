<!DOCTYPE html>
<html>
<head>
    <?php $this->load('widget/header.php'); ?>
</head>
<body class="container">

<div class="page-header">
    <h1><?php echo $listName?></h1>
</div>

<table class="table table-hover">
    <tr>
        <td colspan="4"><h3><strong>用户管理</strong></h3></td>
    </tr>
    <tr>
        <td>所有人员：<a href="index.php?c=user&a=list">【<?php echo $count['user_all']; ?>】</a></td>
        <td>管理员：<a href="index.php?c=user&a=list&type=1">【<?php echo $count['user_type1']; ?>】</a></td>
        <td>维护人员<a href="index.php?c=user&a=list&type=2">【<?php echo $count['user_type2']; ?>】</a></td>
        <td >租借人员<a href="index.php?c=user&a=list&type=3">【<?php echo $count['user_type3']; ?>】</a></td>
    </tr>
    <tr>
        <td colspan="4"><h3><strong>设备管理</strong></h3></td>
    </tr>
    <tr>
        <td>所有设备<a href="index.php?c=equipment&a=list">【<?php echo $count['equipment_all']; ?>】</a></td>
        <td>维护中<a href="index.php?c=equipment&a=list&state=2">【<?php echo $count['equipment_state2']; ?>】</a></td>
        <td>已借出<a href="index.php?c=equipment&a=list&state=3">【<?php echo $count['equipment_state3']; ?>】</a></td>
        <td>在实验室中<a href="index.php?c=equipment&a=list&state=1">【<?php echo $count['equipment_state1']; ?>】</a></td>
    </tr>
    <tr>
        <td>已报废<a href="index.php?c=equipment&a=list&state=4">【<?php echo $count['equipment_state4']; ?>】</a></td>
        <td>大型设备<a href="index.php?c=equipment&a=list&type=3">【<?php echo $count['equipment_type3']; ?>】</a></td>
        <td>电子设备<a href="index.php?c=equipment&a=list&type=2">【<?php echo $count['equipment_type2']; ?>】</a></td>
        <td>精密仪器<a href="index.php?c=equipment&a=list&type=4">【<?php echo $count['equipment_type4']; ?>】</a></td>
    </tr>
    <tr>
        <td colspan="4"><h3><strong>实验室管理</strong></h3></td>
    </tr>
    <tr>
        <td colspan="4">所有实验室<a href="index.php?c=place&a=list">【<?php echo $count['place_all']; ?>】</a></td>
    </tr>
</table>

<?php $this->load('widget/footer.php'); ?>
</body>
</html>