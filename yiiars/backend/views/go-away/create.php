<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GoAway */

$this->title = Yii::t('common', 'Create Go Away');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Go Aways'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="go-away-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
