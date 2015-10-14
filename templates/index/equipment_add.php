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
            <div class="input-group-addon">设备名称：<span class="text-danger">*</span></div>
            <input type="text" required="true" class="form-control" name="name" value="<?php echo $postData['name']; ?>" placeholder="设备名称">
        </div><br/><br/>
        <div class="input-group">
            <div required="true" class="input-group-addon">设备类型：</div>
            <select name="type" class="form-control">
                <?php
                $typeTpl = '<option value="%s">%s</option>';
                foreach($postData['typeTexts'] as $key => $type){
                    echo sprintf($typeTpl,$key,$type);
                }
                ?>
            </select>
        </div><br/><br/>
        <div class="input-group">
            <div  class="input-group-addon">型号：<span class="text-danger">*</span></div>
            <input required="true" type="text" class="form-control" name="model" value="<?php echo $postData['model']; ?>" placeholder="设备型号">
        </div><br/><br/>
        <div class="input-group">
            <div class="input-group-addon">描述：<span class="text-danger">*</span></div>
            <textarea name="description" rows="3" placeholder="设备描述"><?php echo $postData['description']; ?></textarea>
        </div><br/><br/>
        <div class="input-group">
            <div class="input-group-addon">备注：</div>
            <textarea name="remark" rows="3" placeholder="备注"><?php echo $postData['remark']; ?></textarea>
        </div><br/><br/>
    </div>
    <div class="form-inline right">
        <div class="input-group">
            <div  class="input-group-addon">数量：<span class="text-danger">*</span></div>
            <input required="true" type="number" min="1" class="form-control" name="amount" value="<?php echo $postData['amount']; ?>" placeholder="数量">
        </div><br/><br/>
        <div class="input-group">
            <div required="true" class="input-group-addon">选择实验室：</div>
            <select name="place" required="true" data-placeholder="选择入库实验室" style="width: 150px;" class="form-control chosen-select">
                <optgroup label="实验室名称（位置）">
                    <?php
                    $optionTpl = '<option value="%s" %s>%s(%s)</option>';
                    foreach($postData['places'] as $place){
                        if($place['id'] == $postData['place']){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }
                        echo sprintf($optionTpl,$place['id'],$selected,$place['name'],$place['locationText']);
                    }
                    ?>

                </optgroup>

            </select>&nbsp;&nbsp;<a href="index.php?c=place&a=add">添加实验室</a>
        </div><br/><br/>
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
<script type="text/javascript" src="<?php echo $this->getFileUrl('static/chosen_v1.4.2/chosen.jquery.min.js'); ?>" ></script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {

        $(".chosen-select").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!"
        });

        var clearErrMsg = function(){
            $("#errMsg").text("");
        };
        setTimeout(clearErrMsg,8000);

        $('#file_upload').uploadify({
            'buttonText':'上传设备图片',
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