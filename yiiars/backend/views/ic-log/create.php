<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\IcLog */

$this->title = Yii::t('common', 'Create Ic Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Ic Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ic-log-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
