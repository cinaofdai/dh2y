<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-xs-12">
        <?= Html::beginForm(['/role/role-node','name'=>$name],'post')?>
        <table class="table  table-bordered table-hover" id="simple-table">
            <thead>
            <tr>
                <th class="center">
                    <label class="pos-rel">
                        <?=Html::checkbox('check',false,['id'=>'check_all','class'=>'ace'])?>
                        <span class="lbl"></span>
                    </label>
                </th>
                <th>规则</th>
                <th>规则名</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($nodes as $v){?>
                <tr>
                    <td class="center">
                        <label class="pos-rel">
                            <?= Html::checkbox('node[]',in_array($v->name,$roleNodes)?true:false,['value'=>$v->name,'class'=>'ace'])?>
                            <span class="lbl"></span>
                        </label>
                    </td>

                    <td> <?= $v->name?></td>
                    <td><?= $v->description?></td>
                </tr>
            <?php }?>
            <tr>
                <td align="center" colspan="3">
                    <?= Html::submitButton('提交',['class'=>'btn btn-info'])?>
                </td>
            </tr>
            </tbody>
        </table>
        <?= Html::endForm()?>
    </div><!-- /.span -->
</div>
