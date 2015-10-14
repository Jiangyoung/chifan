<!DOCTYPE html>
<html>
<head>
    <?php $this->load('widget/header.php'); ?>
</head>
<body class="container">
<div class="page-header">
    <h1><?php echo $actionName?></h1>
</div>

<form action="" method="post">
    <div id="errMsg">
        <?php
        $errMsgTpl = '<p class="bg-danger">%s</p>';
        foreach($errMsg as $e){
            echo sprintf($errMsgTpl,$e);
        }
        ?>
    </div>

    <div class="form-inline left">
        <h3>选择设备：</h3>

        <div class="input-group">
            <div class="input-group-addon">选择实验室：</div>
            <select name="places[]" required="true" data-placeholder="选择设备" style="width:190px;" class="form-control chosen-select">
                <?php $p_idTpl = '<option value="%d" %s>%s</option>';
                foreach($postData['placeTexts'] as $k => $v){
                    $selected='';
                    if($postData['place'] == $k)$selected='selected';
                    echo sprintf($p_idTpl,$k,$selected,$v);
                }
                ?>
            </select>
        </div><br/><br/>
        <div class="input-group">
            <div class="input-group-addon">选择设备：</div>
            <select name="places[]" required="true" data-placeholder="选择设备" style="width:190px;" class="form-control chosen-select">
                <?php $p_idTpl = '<option value="%d" %s>%s</option>';
                foreach($postData['placeTexts'] as $k => $v){
                    $selected='';
                    if($postData['place'] == $k)$selected='selected';
                    echo sprintf($p_idTpl,$k,$selected,$v);
                }
                ?>
            </select>
        </div><br/><br/>
        <div class="input-group">
            <div class="input-group-addon">选择维护用户：</div>
            <select name="places[]" required="true" data-placeholder="选择设备" style="width:190px;" class="form-control chosen-select">
                <?php $p_idTpl = '<option value="%d" %s>%s</option>';
                foreach($postData['placeTexts'] as $k => $v){
                    $selected='';
                    if($postData['place'] == $k)$selected='selected';
                    echo sprintf($p_idTpl,$k,$selected,$v);
                }
                ?>
            </select>&nbsp;&nbsp;<a href="index.php?c=user&a=add">添加用户</a>
        </div><br/><br/>
        <div class="input-group">
            <div class="input-group-addon">备注：</div>
            <textarea rows="3" class="form-control" name="remark" value="" placeholder="备注"><?php echo $postData['remark']; ?></textarea>
        </div><br/><br/>
    </div>


    <div class="submit">
        <input type="hidden" name="_token" value="<?php echo $_token; ?>" />
        <input type="submit" class="btn btn-primary" value="保&nbsp;&nbsp;&nbsp;存" />
    </div>
</form>
<?php $this->load('widget/footer.php'); ?>
<script type="text/javascript">

    $(function() {
        var clearErrMsg = function(){
            $("#errMsg").text("");
        };
        setTimeout(clearErrMsg,8000);


    });
</script>
</body>
</html>