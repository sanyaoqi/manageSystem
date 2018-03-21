<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\IcCard */

$this->title = $model->cid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Ic Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ic-card-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cid',
            'code',
            'status',
            'uid',
            'money',
            'created_at',
            'end_time:datetime',
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->cid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->cid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
