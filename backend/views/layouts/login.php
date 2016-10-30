<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

LoginAsset::register($this);
$this->registerJsFile('@web/ace/js/html5shiv.js',['position' =>View::POS_HEAD]);
$this->registerJsFile('@web/ace/js/respond.min.js',['position' =>View::POS_HEAD]);
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-layout">
<?php $this->beginBody() ?>
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <i class="icon-leaf green"></i>
                            <span class="red">dh2y</span>
                            <span class="white">后台管理</span>
                        </h1>
                        <h4 class="blue">&copy; 代号黑鹰</h4>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <?= $content ?>
                    </div><!-- /position-relative -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div><!-- /.main-container -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
