<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/18
 * Time: 13:28
 */

namespace backend\controllers;

use backend\models\Signup;
use yii;
use yii\helpers\ArrayHelper;
use common\core\back\BaseBackController;
use backend\models\Admin;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\base\UserException;

class AdminController extends BaseBackController
{
    /**
     * 用户管理首页
     */
    public function actionIndex(){
        Yii::$app->params['p']=['name'=>'管理员列表','url'=>'admin/index'];
        Yii::$app->params['c']=['name'=>'添加管理员','url'=>'admin/add'];
        $query = Admin::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount'=>$countQuery->count(),'defaultPageSize'=>20]);
        $list = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',[
            'list' => $list,
            'pages' => $pages
        ]);
    }

    /**
     * 为用户选择角色
     */
    public function actionRole($uid=NULL){
        //从用户跳转过来，目的获取用户id
        $admin = Admin::find()->where(['id'=>$uid])->one();
        if(!$admin)  $this->_message('用户未找到');
        $authManager = Yii::$app->authManager;
        if(Yii::$app->request->isPost){
            $roleNames=Yii::$app->request->post('roles');
            $authManager->revokeAll($uid);
            //print_r($roleNames);exit();

            if(!empty($roleNames)&&is_array($roleNames)){
                foreach($roleNames as $roleName){
                    $role=$authManager->getRole($roleName);
                    if(!$role){
                        continue;
                    }
                    $authManager->assign($role,$uid);
                }
            }
            if($admin->save())
            {
                if($uid)
                {
                    //操作日志
                    //$content = '更新'.$admin['username'].'的角色权限';
                   //$operate = Operate::add_operate($content);
                    return  $this->_message('更新成功','/admin/index');
                }
            }else{
                return  $this->_message('更新失败');
            }

        }else{
            $userRoles=$authManager->getRolesByUser($uid);
            $roleNames=ArrayHelper::getColumn(ArrayHelper::toArray($userRoles),'name');
            $roles=$authManager->getRoles();
            return $this->render('role',['roles'=>$roles,'roleNames'=>$roleNames,'uid'=>$uid]);
        }
    }

    /**
     * 添加管理员
     */
    public function actionCreate(){

        $model = new Signup();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                //return $this->redirect(['/admin/user/view','id'=>$user->id]);
                return $this->redirect(['/admin/index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * 删除管理员
     */
    public function actionDelete($id){
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * 管理员禁用更改
     * @param $id
     * @return yii\web\Response
     * @throws NotFoundHttpException
     * @throws UserException
     */
    public function actionActivate($id){
        $user = $this->findModel($id);
        if ($user->status == Admin::STATUS_ACTIVE) {
            $user->status = Admin::STATUS_INACTIVE;
        }else if($user->status == Admin::STATUS_INACTIVE){
            $user->status = Admin::STATUS_ACTIVE;
        }
        if ($user->save()) {
            return $this->goHome();
        } else {
            $errors = $user->firstErrors;
            throw new UserException(reset($errors));
        }
    }


    /**
     * 根据key,找到模型.
     * 模型没有找到, 抛出404错误.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('您请求的页面不存在!');
        }
    }

}