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
        <div class="input-group">
            <div class="input-group-addon">用户名：<span class="text-danger">*</span></div>
            <input required="true" type="text" class="form-control" name="username" value="<?php echo $postData['username']; ?>" placeholder="数字+字母">
        </div><br/><br/>
        <div class="input-group">
            <div class="input-group-addon">昵称：</div>
            <input  type="text" class="form-control" name="nickname" value="<?php echo $postData['nickname']; ?>" placeholder="昵称">
        </div><br/><br/>
        <div class="input-group">
            <div required="true" class="input-group-addon">类型：</div>
            <select name="type" class="form-control">
                <?php $typeTpl = '<option value="%d" %s>%s</option>';
                foreach($postData['typeTexts'] as $k => $v){
                    $selected='';
                    if($postData['type'] == $k)$selected='selected';
                    echo sprintf($typeTpl,$k,$selected,$v);
                }
                ?>

            </select>
        </div><br/><br/>
        <div class="input-group">
            <div required="true" class="input-group-addon">密码：<span class="text-danger">*</span></div>
            <input type="password" class="form-control" name="password" value="<?php echo $postData['password']; ?>" placeholder="六位数字字母">
        </div><br/><br/>
        <div class="input-group">
            <div required="true" class="input-group-addon">确认密码：<span class="text-danger">*</span></div>
            <input type="password" class="form-control" name="password2" value="<?php echo $postData['password2']; ?>" placeholder="再次输入">
        </div><br/><br/>
        <div class="input-group">
            <div class="input-group-addon">备注：</div>
            <textarea rows="3" class="form-control" name="remark" value="" placeholder="备注"><?php echo $postData['remark']; ?></textarea>
        </div><br/><br/>
        <div class="input-group">
            <div required="true" class="input-group-addon">手机号：<span class="text-danger">*</span></div>
            <input type="number" class="form-control" name="phone" value="<?php echo $postData['phone']; ?>" placeholder="手机号">
        </div><br/><br/>
        <div class="input-group">
            <div class="input-group-addon">邮箱：</div>
            <input type="email" class="form-control" name="email" value="<?php echo $postData['email']; ?>" placeholder="邮箱">
        </div><br/><br/>
    </div>
    <div class="right">
        <img src="<?php echo $this->getFileUrl($postData['photo_path']); ?>" id="photoThumb" class="thumbnail" style="width: 200px;"/>
        <input id="file_upload" name="file_upload" type="file" multiple="true">
        <input type="hidden" name="photo_path" value="<?php echo $postData['photo_path']; ?>"/>
        <input type="hidden" name="_token" value="<?php echo $_token; ?>"
        <div id="queue"></div>
    </div><br/>


    <div class="submit">
        <input type="submit" class="btn btn-primary" value="保&nbsp;&nbsp;&nbsp;存">
    </div>
</form>
<?php $this->load('widget/footer.php'); ?>
<script src="<?php echo $this->getFileUrl('uploadify/jquery.uploadify.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {

        $("input[name='username']").on('keyup',function(){
            var username = $(this).val();
            $("input[name='nickname']").val(username);
        });

        var clearErrMsg = function(){
            $("#errMsg").text("");
        };
        setTimeout(clearErrMsg,8000);

        $('#file_upload').uploadify({
            'buttonText':'上传头像',
            'fileTypeExts':"*.jpg;*.jpeg;*.png;*.gif;*.bmp",
            'formData'     : {
                'timestamp' : '<?php echo $timestamp;?>',
                'token'     : '<?php echo md5('ix@u&*^&Nmnm' . $timestamp);?>'
            },
            'swf'      : 'uploadify/uploadify.swf',
            'uploader' : 'imageupload.php',
            'onUploadSuccess' : function(file, data, response) {
                var ret = $.parseJSON(data);
                if(0 == ret.errno){
                    $("#photoThumb").attr("src",ret.data);
                    $("input:hidden[name=photo_path]").val(ret.data);
                }else{
                    alert("Error:"+ret.message);
                }

            }
        });
    });
</script>
</body>
</html>