<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="login-box" class="login-box visible widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header blue lighter bigger">
                <i class="icon-coffee green"></i>
                请输入你的账户密码
            </h4>
            <div class="space-6"></div>
            <?php $form = ActiveForm::begin(['id'=> 'login-form',]);?>
                <fieldset>
                    <?=$form->field($model,'username',[
                        'inputOptions' => ['class'=>'form-control'],
                        'inputTemplate' =>'<label class="block clearfix"><span class="block input-icon input-icon-right">{input} <i class="icon-user"></i></span></label>'
                    ])->label(false) ?>

                    <?=$form->field($model,'password',[
                        'inputOptions' => ['class'=>'form-control'],
                        'inputTemplate' =>'<label class="block clearfix"><span class="block input-icon input-icon-right">{input} <i class="icon-lock"></i></span></label>'
                    ])->passwordInput()->label(false) ?>
                    <div class="space"></div>
                    <div class="clearfix">
                        <?=$form->field($model,'rememberMe',[
                            'inputOptions' => ['class'=>'ace'],
                            'inputTemplate' =>'{input}<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">登录</button> '
                        ])->checkbox() ?>
                    </div>

                    <div class="space-4"></div>
                </fieldset>
            <?php ActiveForm::end();?>
        </div><!-- /widget-main -->
    </div><!-- /widget-body -->
</div><!-- /login-box -->
