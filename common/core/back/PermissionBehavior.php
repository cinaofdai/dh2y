<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/31
 * Time: 13:39
 */

namespace common\core\back;

use yii;
use yii\web\Controller;
use yii\base\Behavior;
use yii\web\ForbiddenHttpException;


class PermissionBehavior extends Behavior
{
    public $actions = [];

    public function events()
    {
        return [
           Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    /**
     *
     * @param \yii\base\ActionEvent $event
     * @throws ForbiddenHttpException
     * @return boolean
     */
    public function beforeAction($event)
    {
        $controller = $event->action->controller->id; //获取到控制器
        $action = $event->action->id; //获取到action

        //验证权限
        $access = $controller."/".$action;  //权限name

        /* @var yii\rbac\DbManager $auth*/
        $auth = Yii::$app->authManager;

        //这一步在权限表中添加默认权限，和默认用户id给许可
        if (!$a=$auth->getPermission($access)) {
            $a = $auth->createPermission($access);
            $a->description = '创建了 ' .$access. ' 许可';
            $auth->add($a);
            $auth->assign($a, Yii::$app->user->id); //添加许可
        }



        //超级管理员不需要验证权限 ,以后这里可以添加不需要验证的用户
        if (Yii::$app->user->id==1) return true;

        if (!Yii::$app->user->can($access)) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }

        return true;

    }
}