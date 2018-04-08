<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->uid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'cover',
                'value' => Yii::$app->params['image_domain'].$model->cover,
                'format' => ['image',['width'=>'100']],
            ],
            'email:email',
            'mobile',
            'real_name',
            'sex',
            'id_card',
            'fingerprint',
            'ic_card',
            'role',
            'status',
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->uid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->uid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
