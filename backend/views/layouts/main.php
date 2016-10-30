<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use \backend\widgets\SidebarWidget;


AppAsset::register($this);
$this->registerJsFile('@web/ace/js/ace-extra.min.js',['position' =>View::POS_HEAD]);
$this->registerJsFile('@web/ace/js/jquery-2.0.3.min.js',['position' => View::POS_HEAD]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!--head start-->
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    <i class="icon-leaf"></i>
                    dh2y Admin
                </small>
            </a><!-- /.brand -->
        </div><!-- /.navbar-header -->

        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="grey">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-tasks"></i>
                        <span class="badge badge-grey">4</span>
                    </a>

                    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="icon-ok"></i>
                            4 Tasks to complete
                        </li>

                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">软件更新</span>
                                    <span class="pull-right">65%</span>
                                </div>

                                <div class="progress progress-mini ">
                                    <div style="width:65%" class="progress-bar "></div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                查看任务详情
                                <i class="icon-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="purple">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-bell-alt icon-animated-bell"></i>
                        <span class="badge badge-important">8</span>
                    </a>

                    <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="icon-warning-sign"></i>
                            8 个通知
                        </li>

                        <li>
                            <a href="#">
                                <div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-comment"></i>
												新用户
											</span>
                                    <span class="pull-right badge badge-info">+12</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="btn btn-xs btn-primary icon-user"></i>
                                编辑管理员Bob登录 ...
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                查看所有通知
                                <i class="icon-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="green">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-envelope icon-animated-vertical"></i>
                        <span class="badge badge-success">5</span>
                    </a>

                    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="icon-envelope-alt"></i>
                            5 条信息
                        </li>

                        <li>
                            <a href="#">
                                <img src="<?=Url::to('@web/ace/avatars/avatar.png')?>" class="msg-photo" alt="Alex's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Alex:</span>
												Ciao sociis natoque penatibus et auctor ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>1分钟之前</span>
											</span>
										</span>
                            </a>
                        </li>

                        <li>
                            <a href="inbox.html">
                                See all messages
                                <i class="icon-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?=Url::to('@web/ace/avatars/user.jpg') ?>" alt="Jason's Photo" />
								<span class="user-info">
									<small>欢迎</small>
									<?=Yii::$app->user->identity->username?>
								</span>

                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="icon-cog"></i>
                                设置
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="<?=Url::to(['site/logout'])?>" data-method="post">
                                <i class="icon-off"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
    </div><!-- /.container -->
</div>
<!--head end-->

<!--left menu start-->
<div id="main-container" class="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

     <div class="main-container-inner">
        <a href="#" id="menu-toggler" class="menu-toggler">
            <span class="menu-text"></span>
        </a>

        <div id="sidebar" class="sidebar">
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
            </script>

            <div id="sidebar-shortcuts" class="sidebar-shortcuts">
                <div id="sidebar-shortcuts-large" class="sidebar-shortcuts-large">
                    <button class="btn btn-success">
                        <i class="icon-signal"></i>
                    </button>

                    <button class="btn btn-info">
                        <i class="icon-pencil"></i>
                    </button>

                    <button class="btn btn-warning">
                        <i class="icon-group"></i>
                    </button>

                    <button class="btn btn-danger">
                        <i class="icon-cogs"></i>
                    </button>
                </div>

                <div id="sidebar-shortcuts-mini" class="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span>

                    <span class="btn btn-info"></span>

                    <span class="btn btn-warning"></span>

                    <span class="btn btn-danger"></span>
                </div>
            </div><!-- #sidebar-shortcuts -->

            <ul class="nav nav-list">
                <?=SidebarWidget::widget()?>
            </ul><!-- /.nav-list -->

            <div id="sidebar-collapse" class="sidebar-collapse">
                <i data-icon2="icon-double-angle-right" data-icon1="icon-double-angle-left" class="icon-double-angle-left"></i>
            </div>

            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
            </script>
        </div>

        <div class="main-content">
            <div id="breadcrumbs" class="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home home-icon"></i>
                        <a href="<?=Url::to(['site/index']) ?>">主页</a>
                    </li>
                    <?php if(Yii::$app->params['p']['name']):?>
                    <li class="<?=Yii::$app->params['p']['url']?'':'active'?>">
                        <a href="<?=Url::to([Yii::$app->params['p']['url']])?>"><?=Yii::$app->params['p']['name']?></a>
                    </li>
                    <?php endif;?>
                    <?php if(Yii::$app->params['c']['name']):?>
                    <li class="<?=Yii::$app->params['c']['url']?'':'active'?>">
                        <a href="<?=Url::to([Yii::$app->params['c']['url']])?>"><?=Yii::$app->params['c']['name']?></a>
                    </li>
                    <?php endif;?>
                </ul><!-- .breadcrumb -->

            </div>

            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <?= $content ?>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div><!-- /.main-content -->

        <div id="ace-settings-container" class="ace-settings-container">
            <div id="ace-settings-btn" class="btn btn-app btn-xs btn-warning ace-settings-btn">
                <i class="icon-cog bigger-150"></i>
            </div>

            <div id="ace-settings-box" class="ace-settings-box">
                <div>
                    <div class="pull-left">
                        <select class="hide" id="skin-colorpicker" style="display: none;">
                            <option value="#438EB9" data-skin="default">#438EB9</option>
                            <option value="#222A2D" data-skin="skin-1">#222A2D</option>
                            <option value="#C6487E" data-skin="skin-2">#C6487E</option>
                            <option value="#D0D0D0" data-skin="skin-3">#D0D0D0</option>
                        </select>
                        <div class="dropdown dropdown-colorpicker">
                            <ul class="dropdown-menu dropdown-caret">
                                <li><a data-color="#438EB9" style="background-color:#438EB9;" href="#" class="colorpick-btn selected"></a></li><li><a data-color="#222A2D" style="background-color:#222A2D;" href="#" class="colorpick-btn"></a></li><li><a data-color="#C6487E" style="background-color:#C6487E;" href="#" class="colorpick-btn"></a></li><li><a data-color="#D0D0D0" style="background-color:#D0D0D0;" href="#" class="colorpick-btn"></a></li>
                            </ul>
                        </div>
                    </div>
                    <span>&nbsp; 更换皮肤</span>
                </div>

            </div>
        </div><!-- /#ace-settings-container -->
    </div><!-- /.main-container-inner -->

    <a class="btn-scroll-up btn btn-sm btn-inverse" id="btn-scroll-up" href="#">
        <i class="icon-double-angle-up icon-only bigger-110"></i>
    </a>
</div>
<!--lest menu end-->



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
