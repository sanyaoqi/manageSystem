<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Guests */

$this->title = $model->gid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Guests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guests-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gid',
            'created_at',
            'uuid',
            'image',
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
