<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <p>上传照片</p>
    <input type="file" name="file" id="cover" />
    <?= $form->field($model, 'cover', ['options' => ['id' => 'cover_contains']])->hiddenInput()->label(''); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passwd')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'real_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput() ?>

    <?= $form->field($model, 'id_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fingerprint')->textInput() ?>

    <?= $form->field($model, 'ic_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'role')->textInput() ?>

   <!-- <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?> -->


    <!-- <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'access_token')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::button(Yii::t('common', 'Read'), ['class' => 'btn read-card']) ?>
        <?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?= Html::cssFile('/js/bootstrap3-fileinput/css/fileinput.min.css'); ?>
<?= Html::jsFile('/js/bootstrap3-fileinput/js/fileinput.js'); ?>
<?= Html::jsFile('/js/bootstrap3-fileinput/js/fileinput_locale_zh.js'); ?>
<script>
    //@link:https://github.com/kartik-v/bootstrap-fileinput/blob/master/examples/index.html
    $('#cover').fileinput({
        language: 'zh', //设置语言
        uploadUrl: "/user/upload", //上传的地址
        allowedFileExtensions : ['jpg', 'png','gif'],//接收的文件后缀,
        enctype: 'multipart/form-data',
        showUpload: true, //是否显示上传按钮
        showCaption: false,//是否显示标题
        browseClass: "btn btn-primary", //按钮样式
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        maxFileCount:1,
        <?php if ($model->cover): ?>
        initialPreview: [
            "<img src='<?= $model->cover; ?>' class='file-preview-image' >",
        ],
        <?php endif; ?>
    });

    $('#cover').on('fileuploaded', function(event, data, previewId, index){
        $('#cover_contains input[type="hidden"]').val(data.response.image_url);
    });

    //读取身份证信息
    $(".form-group").on('click', '.read-card', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'http://node.ars.com/user/readIDCard',
            type: 'POST',
            dataType: 'json',
            data: {type: 1},
        })
        .done(function(data) {
            console.log(data, "success");
            if (data.code == '200') {
                var user_info = data.result;
                $("#user-id_card").val(user_info.IDNum);
                $("#user-real_name").val(user_info.name);
                $("#user-sex").val(user_info.sex);
                $("#user-passwd").val(user_info.IDNum.slice(12));
                $("#user-role").val(0);
                console.log(user_info);
            }
        })
        .fail(function(data) {
                       console.log(data);

            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        /* Act on the event */
    });
</script>
