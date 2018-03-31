<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GoAwaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="go-away-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gid') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'did') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
