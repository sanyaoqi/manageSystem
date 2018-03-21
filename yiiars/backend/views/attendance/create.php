<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Attendance */

$this->title = Yii::t('common', 'Create Attendance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Attendances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
