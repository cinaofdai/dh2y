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
    <?= Html::input('hidden','nid',$name); ?>
    <div class="form-group">
        <?=$form->field($model,'name') ?>
    </div>
    <div class="form-group">
        <?=$form->field($model,'description')->textarea(['rows'=>3])?>
    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <?=Html::submitButton('修改',['class'=>'btn btn-info'])?>
            &nbsp; &nbsp; &nbsp;
            <?=Html::resetButton('清除', ['class' => 'btn'])?>
        </div>
    </div>

<?php ActiveForm::end()?>