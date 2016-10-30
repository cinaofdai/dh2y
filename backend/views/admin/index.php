<?php
use yii\helpers\Html;
?>
<p>
    <?= Html::a('添加管理员', ['create'], ['class' => 'btn btn-success']) ?>
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
                <th>管理员名称</th>
                <th>最后登录时间</th>
                <th>管理员状态</th>
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

        <td> <?= $v->username?></td>
        <td><?=  date('Y-m-d H:i:s',$v->updated_at)?></td>
        <td><?= $v->status?'激活':'失效'?></td>
        <td>
            <?= Html::a('删除',['/admin/delete','id'=>$v->id],[
                'data' => [
                    'confirm' => '确认删除吗？',
                    'method' => 'post',
                ]
            ])?>
            &nbsp;
            <a href="/admin/activate?id=<?=$v->id?>"><?= $v->status?'禁用':'激活'?></a>
            &nbsp;
            <a href="/admin/role?uid=<?=$v->id?>">修改管理组</a>

        </td>
    </tr>
<?php }?>
</tbody>
</table>
</div><!-- /.span -->
</div>
