<?php

/* @var $this yii\web\View */

$this->title = Yii::t('common', 'Dashboard');
Yii::$app->params['breadcrumbs'] = [
    [
        'name' => $this->title,
        'icon' => 'fa fa-dashboard',
        'link' => '/',
    ]
];
?>
<!-- Info boxes -->
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-aqua"><i class="fa fa-users" aria-hidden="true"></i></span>

    <div class="info-box-content">
      <span class="info-box-text"><?= Yii::t('common', 'Total user number'); ?></span>
      <span class="info-box-number"><?= $total['users'] ?></span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-red"><i class="fa fa-instagram" aria-hidden="true"></i></span>

    <div class="info-box-content">
      <span class="info-box-text"><?= Yii::t('common', 'Total device number'); ?></span>
      <span class="info-box-number"><?= $total['device'] ?></span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->

<!-- fix for small devices only -->
<div class="clearfix visible-sm-block"></div>

<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-green"><i class="fa fa-hand-o-up" aria-hidden="true"></i></span>

    <div class="info-box-content">
      <span class="info-box-text"><?= Yii::t('common', 'Today user attendance'); ?></span>
      <span class="info-box-number"><?= $total['today_attend'] ?></span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-yellow"><i class="fa fa-user-secret" aria-hidden="true"></i></span>

    <div class="info-box-content">
      <span class="info-box-text"><?= Yii::t('common', 'Today guests num'); ?></span>
      <span class="info-box-number"><?= $total['guests'] ?></span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->