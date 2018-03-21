<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IcCard */

$this->title = Yii::t('common', 'Update Ic Card: {nameAttribute}', [
    'nameAttribute' => $model->cid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Ic Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cid, 'url' => ['view', 'id' => $model->cid]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="ic-card-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
