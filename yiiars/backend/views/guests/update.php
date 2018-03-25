<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Guests */

$this->title = Yii::t('common', 'Update Guests: {nameAttribute}', [
    'nameAttribute' => $model->gid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Guests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gid, 'url' => ['view', 'id' => $model->gid]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="guests-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
