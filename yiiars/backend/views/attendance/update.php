<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Attendance */

$this->title = Yii::t('common', 'Update Attendance: {nameAttribute}', [
    'nameAttribute' => $model->aid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Attendances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aid, 'url' => ['view', 'id' => $model->aid]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="attendance-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
