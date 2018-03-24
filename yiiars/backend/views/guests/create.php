<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Guests */

$this->title = Yii::t('common', 'Create Guests');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Guests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guests-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
