<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\IcCard */

$this->title = Yii::t('common', 'Create Ic Card');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Ic Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ic-card-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
