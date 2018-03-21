<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Device */

$this->title = Yii::t('common', 'Update Device: {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Devices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->did]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="device-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
