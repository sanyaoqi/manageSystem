<?php 
use yii\helpers\Url;
$uri = Yii::$app->request->getUrl();

foreach ($main_nav as $key => $value) {
    foreach ($value['items'] as $k => $v) {
        if ($v['action'] == $uri) {
            $main_nav[$key]['active'] = true;
        }
    }
}


?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?= isset($user->real_name)?$user->real_name:''; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header"><?= Yii::t('common', 'MAIN NAVIGATION')?></li>
      <?php if ($main_nav): foreach ($main_nav as $nav) : ?>
        <li class="<?= (isset($nav['active']) && $nav['active']) ? 'active menu-open': ''; ?> treeview">
          <a href="<?= Url::to($nav['action']); ?>">
            <i class="<?= $nav['icon']; ?>"></i> 
            <span><?= Yii::t('common', $nav['name']); ?></span>
            <?php if(isset($nav['message'])): ?>
              <span class="pull-right-container">
                <small class="label pull-right bg-green"><?= $nav['message'] ?></small>
              </span>
            <?php endif; ?>
          </a>
          <?php if(isset($nav['items']) && $nav['items']): ?>
          <ul class="treeview-menu">
            <?php foreach ($nav['items'] as $item) : ?>
              <li class="<?= (Yii::$app->request->getUrl() == $item['action'])?'active':''; ?>"><a href="<?= Url::to($item['action']); ?>">
                  <i class="<?= $item['icon']; ?>"></i> <?= $item['name']?>
              </a></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        </li>
      <?php endforeach; endif; ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>