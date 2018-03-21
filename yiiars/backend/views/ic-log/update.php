<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IcLog */

$this->title = Yii::t('common', 'Update Ic Log: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Ic Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="ic-log-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
