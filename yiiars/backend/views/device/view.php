<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Device */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Devices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'did',
            'name',
            'position',
            'status',
            'created_at',
            'info:ntext',
            'data_dir',
            'config:ntext',
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->did], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->did], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
