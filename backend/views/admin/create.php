<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<?= Html::errorSummary($model)?>
<?php $form=ActiveForm::begin([
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "<div class='col-xs-3 col-sm-2 text-right'>{label}</div><div class='col-xs-12 col-sm-4'>{input}</div><div class='help-block col-xs-12 col-sm-reset inline'>{error}</div>",
    ]
])?>
<div class="form-group">
    <?= $form->field($model, 'username') ?>
</div>
<div class="form-group">
    <?= $form->field($model, 'email') ?>
</div>
<div class="form-group">
    <?= $form->field($model, 'password')->passwordInput() ?>
</div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <?= Html::submitButton('添加', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        &nbsp; &nbsp; &nbsp;
        <?=Html::resetButton('重置', ['class' => 'btn'])?>
    </div>
</div>

<?php ActiveForm::end()?>


