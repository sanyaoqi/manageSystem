<?php 
use yii\helpers\Url;
?>
<?php if(!empty(Yii::$app->params['breadcrumbs'])): ?>
  <ol class="breadcrumb">
    <?php 
    $len = count(Yii::$app->params['breadcrumbs']);
    foreach(Yii::$app->params['breadcrumbs'] as $key => $bc): ?>
        <?php if ($key == $len - 1) : ?>
            <li><a href="<?= Url::to($bc['link']) ?>">
                <i class="<?= $bc['icon'] ?>"></i> <?= $bc['name'] ?>
            </a></li>
        <?php else : ?>
            <li class="active"><?= $bc['name'] ?></li>
        <?php endif; ?> 
    <?php endforeach; ?>
  </ol>
<?php endif; ?>