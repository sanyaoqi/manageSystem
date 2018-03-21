<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Device */

$this->title = Yii::t('common', 'Create Device');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Devices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
