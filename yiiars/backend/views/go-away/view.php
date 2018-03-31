<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GoAway */

$this->title = $model->gid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Go Aways'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="go-away-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gid',
            'uid',
            'type',
            'date',
            'created_at',
            'did',
            'status',
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->gid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->gid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
