<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker; 


/* @var $this yii\web\View */
/* @var $model common\models\AttendanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['excel'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-6 col-xs-12">
        <label>开始时间</label>
        <?= DateTimePicker::widget([ 
            'name' => 'start_date', 
            'options' => ['placeholder' => ''], 
            //注意，该方法更新的时候你需要指定value值 
            'value' => date('Y-m-d', time()-3600*24), 
            'pluginOptions' => [
                'autoclose' => true, 
                'format' => 'yyyy-mm-dd', 
                'todayHighlight' => true 
            ] 
        ]); ?>
    </div>
    <div class="col-sm-6 col-xs-12">
        <label>结束时间</label>
        <?= DateTimePicker::widget([ 
            'name' => 'end_date', 
            'options' => ['placeholder' => ''], 
            //注意，该方法更新的时候你需要指定value值 
            'value' => date('Y-m-d', time()), 
            'pluginOptions' => [
                'autoclose' => true, 
                'format' => 'yyyy-mm-dd', 
                'todayHighlight' => true 
            ] 
        ]); ?>
    </div>
    <div class="col-xs-12">
        <?= Html::submitButton(Yii::t('common', '导出'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- <script>
    $(function(){
        $(".form_datetime").datetimepicker({
            startView:2,                          //2:显示月视图(有0-4的选择)
            format:"yyyy-mm-dd",                 //显示格式
            minView: 'month',                   //选择日期后，不会再跳转去选择时分秒
            language: "zh-CN",
            autoclose:true,
            pickerPosition:'bottom-left',
        });

        $('.form_datetime').datetimepicker({
            startView:2,                          //2:显示月视图(有0-4的选择)
            format:"yyyy-mm-dd",                 //显示格式
            minView: 'month',                   //选择日期后，不会再跳转去选择时分秒
            language: "zh-CN",
            autoclose:true,
            pickerPosition:'bottom-left',
        });
    });
</script> -->
