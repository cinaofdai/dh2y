<?php
use yii\helpers\Html;

?>
<p>
    <?= Html::a('添加角色', ['role-create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="row">
    <div class="col-xs-12">
        <table class="table  table-bordered table-hover" id="simple-table">
            <thead>
            <tr>
                <th class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace">
                        <span class="lbl"></span>
                    </label>
                </th>
                <th>角色名称</th>
                <th>角色描述</th>
                <th>操 作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($roles as $v){?>
            <tr>
                <td class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace">
                        <span class="lbl"></span>
                    </label>
                </td>

                <td> <?= $v->name?></td>
                <td><?= $v->description?></td>
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
            </tbody>
        </table>
    </div><!-- /.span -->
</div>
