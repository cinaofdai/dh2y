<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<p>
    <?= Html::a('添加路由', ['node-create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="row">
    <div class="col-xs-12">
        <table class="table  table-bordered table-hover" id="simple-table">
            <thead>
            <tr>
                <th class="center">
                    <label class="pos-rel">
                        <?=Html::checkbox('check',false,['id'=>'check_all','class'=>'ace'])?>
                        <span class="lbl"></span>
                    </label>
                </th>
                <th>路由</th>
                <th>描述</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $v){?>
                <tr>
                    <td class="center">
                        <label class="pos-rel">
                            <?= Html::checkbox('check',false,['class'=>'ace'])?>
                            <span class="lbl"></span>
                        </label>
                    </td>

                    <td> <?= $v->name?></td>
                    <td><?= $v->description?></td>
                    <td>
                        <?= Html::a('删除',['/role/node-list','name'=>$v->name],[
                            'data' => [
                                'confirm' => '确认删除吗？',
                                'method' => 'post',
                            ]
                        ])?>
                        &nbsp;
                        <a href="<?=Url::to(['role/node-update','nid' =>$v->name])?>">修改</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
</div>
