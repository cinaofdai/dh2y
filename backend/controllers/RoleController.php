<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/31
 * Time: 20:55
 */

namespace backend\controllers;

use backend\models\RBAC;
use backend\models\RoleForm;
use common\lib\Util;
use Yii;
use common\core\back\BaseBackController;
use yii\db\Query;
use yii\rbac\DbManager;
use yii\rbac\Item;

class RoleController extends BaseBackController
{
    /**
     * 角色管理首页
     * string $uid
     */
    public function actionRoleIndex($userid=NULL)
    {
        Yii::$app->params['p']=['name'=>'角色列表','url'=>'role/role-index'];
        Yii::$app->params['c']=['name'=>'添加角色','url'=>'role/role-create'];
        $authManager = Yii::$app->authManager;
        $roles = $authManager->getRoles();

        return $this->render('index',[
            'roles'=>$roles,
            'uid'=>$userid
        ]);
    }

    //创建角色
    public function actionRoleCreate($userid=NULL){
        if(!$userid) $userid='';
        //角色表单
        $model = new RoleForm();

        if($model->load(Yii::$app->request->post()) && $model->save()){
            if($userid)
            {

                return $this->_message('角色添加成功','/role/role?uid='.$userid);
            }
            else{
                //操作日志
                //$content = '创建了'.$model['name'].'角色';
                // $operate = Operate::add_operate($content);
                return $this->_message('角色添加成功','/role/role-index');
            }
        }else{
            return $this->render('create',[
                'model'=>$model,
                'uid'=>$userid
            ]);
        }
    }

    //修改角色
    public function actionRoleUpdate($name,$userid=NULL){
        $authManager = Yii::$app->authManager;
        //是否有下级
        $child = $authManager->getChildren($name);
        //如果有下级不允许修改
        if($child){
            if($userid)
            {
                return $this->_message('角色有用户,不能修改','/role/role?uid='.$userid);
            }
            else{
                return $this->_message('角色有用户,不能修改','/role/role-index');
            }
        }
        //获取角色
        $role = $authManager->getRole($name);
        if(!$role) return false;

        //角色表单
        $model = new RoleForm();
        //角色名称
        $model->name = $role->name;
        //角色描述
        $model->description = $role->description;

        if($model->load(\Yii::$app->request->post()) && $model->update($name)){
            if($userid)
            {
                //操作日志
                // $content = '修改了角色名'.$name.'为'.$model['name'].'角色';
                //$operate = Operate::add_operate($content);
                return $this->_message('角色修改成功','/role/role?uid='.$userid);
            }
            else{
                //操作日志
                //$content = '修改了角色名'.$name.'为'.$model['name'].'角色';
                //$operate = Operate::add_operate($content);
                return $this->_message('角色修改成功','/role/role-index');
            }

        }else{
            return $this->render('update',[
                'model'=>$model,
                'uid'=>$userid
            ]);
        }
    }

    //删除角色
    public function actionRoleDelete($name,$userid=NULL){
        $authManager = Yii::$app->authManager;
        //是否有子角色
        $child = $authManager->getChildren($name);
        //有子角色不能删除
        if($child){
            if($userid)
            {
                return $this->_message('节点有子角色,不能删除','/role/role?uid='.$userid);
            }
            else{
                return $this->_message('节点有子角色,不能删除','/role/role-index');
            }
        }
        //获取角色
        $role = $authManager->getRole($name);
        if(!$role) return false;
        if($authManager->remove($role)){
            if($userid)
            {
                //操作日志
                //$content = '删除了'.$name.'角色';
                //$operate = Operate::add_operate($content);
                return $this->_message('角色删除成功','/role/role?uid='.$userid);
            }
            else{
                //操作日志
                //$content = '删除了'.$name.'角色';
                //$operate = Operate::add_operate($content);
                return $this->_message('角色删除成功','/role/role-index');
            }
        }else{
            if($userid)
            {
                return $this->_message('角色删除失败','/role/role?uid='.$userid);
            }
            else{
                return $$this->_message('角色删除失败','/setting/roleindex');
            }
        }

    }

    //为角色赋予权限
    public function actionRoleNode($name,$userid=NULL)
    {
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($name);
        if(!$role){
            return  $this->_message('节点未找到');
        }
        if(Yii::$app->request->isPost){
            $nodes = Yii::$app->request->post('node');
            $authManager->removeChildren($role);
            foreach($nodes as $v){
                $node = $authManager->getPermission($v);
                if(!$node)continue;
                $authManager->addChild($role,$node);
            }
            if($userid)
            {
                return $this->redirect(['/role/admin-lists']);
            }
            else{
                return $this->redirect(['/role/role-index']);
            }
        }
        $roleNodes = $authManager->getPermissionsByRole($name);
        $roleNodes = array_keys($roleNodes);
        $nodes = $authManager->getPermissions();
        return $this->render('node',[
            'nodes'=>$nodes,
            'roleNodes'=>$roleNodes,
            'name'=>$name,
            'uid'=>$userid
        ]);
    }

    /**
     * 节点列表路由列表
     */
    public function actionNodeList(){
        $authManager = Yii::$app->authManager;
        $name = Yii::$app->request->get('name');
        if($name!=null){
            $rbac = new RBAC();
            //使用了MyISAM引擎，因此不支持级联删除，所以不允许有子节点的情况下删除父节点
            if((new Query())->from($rbac->itemChildTable)->andWhere(['parent'=>$name])->orWhere(['child'=>$name])->count()>0)
                return $this->_message('该项目下还有子节点，请先删除子节点再删除该节点');
            if($rbac->deleteOneItem($name))
                return $this->_message('路由删除成功');
            else
                return $this->_message('删除失败！');
        }
        $list = $authManager->getPermissions();
        return $this->render('list',[
            'list'=>$list
        ]);
    }

    /**
     * 添加路由节点
     */
    public function actionNodeCreate(){
        $model = new RoleForm();
        $model->setType(RoleForm::ROLE_Item);
        if(Yii::$app->request->isPost){
            if($model->load(Yii::$app->request->post()) && $model->createRole()){
                return $this->_message('路由添加成功','/role/node-list');
            }else{
                return $this->_message('路由添加失败');
            }
        }else{
            return $this->render('addnode',[
                'model'=>$model,
            ]);
        }
    }

    /**
     * 修改路由节点
     */
    public function actionNodeUpdate($nid){
        $model = new RoleForm();
        $model->setType(RoleForm::ROLE_Item);
        if($data = Yii::$app->request->post()){
            $model->load(Yii::$app->request->post());
            $model->UpdateRole($nid);
            return $this->_message('修改路由节点成功','/role/node-list');
        }
        $authManager = Yii::$app->authManager;
        $node =  $authManager->getPermission($nid);

        $model->name = $node->name;
        $model->description = $node->description;
        return $this->render('upnode',[
            'model'=>$model,
            'name' => $nid
        ]);
    }
}