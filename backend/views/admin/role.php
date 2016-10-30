<?php
use yii\helpers\Html;

?>

<div class="row">
    <div class="col-xs-12">
        <?=Html::beginForm() ?>
        <table class="table  table-bordered table-hover" id="simple-table">
            <thead>
            <tr>
                <th class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace">
                        <span class="lbl"></span>
                    </label>
                </th>
                <th>角色、部门、权限组名称</th>
                <th>分配权限</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($roles as $v){?>
                <tr>
                    <td class="center">
                        <label class="pos-rel">
                            <?= Html::checkbox('roles[]',in_array($v->name,$roleNames),['value'=>$v->name,'id'=>$v->name,'class'=>'ace']) ?>
                            <span class="lbl"></span>
                        </label>
                    </td>

                    <td> <?= $v->name?></td>
                    <td>
                        <a href="/role/role-update?name=<?=$v->name ?>&uid=<?=$uid?>">修改</a>
                        &nbsp;
                        <a href="/role/role-node?name=<?=$v->name ?>&uid=<?=$uid?>">权限</a>
                        &nbsp;
                        <?= Html::a('删除',['/role/role-delete','name'=>$v->name],[
                            'data' => [
                                'confirm' => '确认删除吗？',
                                'method' => 'post',
                            ]
                        ])?>
                    </td>
                </tr>
            <?php }?>
            <tr>
                <td align="center" colspan="3">
                    <?= Html::submitButton('提交',['class'=>'btn btn-info'])?>
                </td>
            </tr>
            </tbody>
        </table>
        <?= Html::endForm() ?>
    </div><!-- /.span -->
</div>


