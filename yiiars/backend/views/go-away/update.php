<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GoAway */

$this->title = Yii::t('common', 'Update Go Away: {nameAttribute}', [
    'nameAttribute' => $model->gid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Go Aways'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gid, 'url' => ['view', 'id' => $model->gid]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="go-away-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
