<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<?php $form=ActiveForm::begin([
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "<div class='col-xs-3 col-sm-2 text-right'>{label}</div><div class='col-xs-12 col-sm-4'>{input}</div><div class='help-block col-xs-12 col-sm-reset inline'>{error}</div>",
    ]
])?>

    <div class="form-group">
        <?=$form->field($model,'name') ?>
    </div>
    <div class="form-group">
        <?=$form->field($model,'parent')->dropDownList($list) ?>
    </div>
    <div class="form-group">
        <?=$form->field($model,'route') ?>
    </div>
    <div class="form-group">
        <?=$form->field($model,'order')->input('number') ?>
    </div>
    <div class="form-group">
        <?=$form->field($model,'data')->textarea(['rows'=>3])?>
    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <?=Html::submitButton((Yii::$app->controller->action->id == 'create')?'添加':'修改',['class'=>'btn btn-info'])?>
            &nbsp; &nbsp; &nbsp;
            <?=Html::resetButton('清除', ['class' => 'btn'])?>
        </div>
    </div>

<?php ActiveForm::end()?>