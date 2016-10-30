<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/23
 * Time: 14:27
 */

namespace backend\controllers;

use common\lib\Util;
use yii;
use backend\models\Menu;
use yii\helpers\Url;
use common\core\back\BaseBackController;

class MenuController extends BaseBackController
{
    /**
     * 用户管理首页
     */
    public function actionIndex(){
        Yii::$app->params['p']=['name'=>'菜单列表','url'=>'menu/index'];
        Yii::$app->params['c']=['name'=>'添加菜单','url'=>'menu/create'];
        $model = new Menu();
        $list=$model->getTreeList();
        return $this->render('index',['list' => $list]);
    }

    public function actionCreate(){
        $model = new Menu;
        $list = $model->getOptions();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->add($post)) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'list' => $list,
        ]);
    }

    public function actionUpdate($id){
        $model = Menu::findOne($id);
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $post['Menu']['parent']=$post['Menu']['parent']==0?NULL:$post['Menu']['parent'];
            if ($model->load($post) && $model->save()) {
                return $this->redirect(['index']);
            }
        }
        $list = $model->getOptions();
        return $this->render('update', [
            'model' => $model,
            'list'  => $list
        ]);

    }

    public function actionDelete($id){
        try {
            if (empty($id)) {
                throw new \Exception('参数错误');
            }
            $data = Menu::find()->where('parent = :id', [":id" => $id])->one();
            if ($data) {
                throw new \Exception('该菜单下面有子菜单，不允许删除');
            }
            if (!Menu::deleteAll('id = :id', [":id" => $id])) {
                throw new \Exception('删除失败');
            }
        } catch(\Exception $e) {
            $this->_message($e->getMessage(),Url::to(['menu/index']));
        }
        return $this->redirect(['menu/index']);
    }

}