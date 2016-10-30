<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<p>
    <?= Html::a('添加菜单', ['create'], ['class' => 'btn btn-success']) ?>
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
                <th>菜单名称</th>
                <th>路由</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $v){?>
                <tr>
                    <td class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace">
                            <span class="lbl"></span>
                        </label>
                    </td>

                    <td><?= $v['name']?></td>
                    <td><?= $v['route']?></td>
                    <td><?= $v['order']?></td>
                    <td>
                        <?= Html::a('删除',['/menu/delete','id'=>$v['id']],[
                            'data' => [
                                'confirm' => '确认删除吗？',
                                'method' => 'post',
                            ]
                        ])?>
                        &nbsp;
                        <a href="<?=Url::to(['menu/update','id' => $v['id']])?>">修改</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div><!-- /.span -->
</div>
