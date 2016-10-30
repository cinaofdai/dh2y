<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/31
 * Time: 21:49
 */

namespace backend\models;

use common\models\rbac\AuthItemModel;
use Yii;
use common\core\back\BaseBackModel;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

class RoleForm extends BaseBackModel
{
    public $name;
    public $description;

    private $type;
    const ROLE_Item = 2;


    public function rules(){
        return [
            [['name'],'string','max'=>20],
            [['name','description'],'required'],
            ['description','filter','filter'=>function($value){
                return Html::encode($value);
            }],
        ];
    }

    //自动设置 created_at updated_at
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),  //自动设置 created_at updated_at
        ];
    }

    public function setType($type){
        $this->type=$type;
    }

    public function attributeLabels(){
        if($this->type==self::ROLE_Item){
            return [
                'name'=>'路由名称',
                'description'=>'路由描述',
            ];
        }
        return [
            'name'=>'角色名称',
            'description'=>'角色描述',
        ];
    }

    public function save(){
        if($this->validate()){
            $authManager = Yii::$app->authManager;
            $role = $authManager->createRole($this->name);
            $role->description = $this->description?$this->description:'创建了 ' . $this->name. '角色、部门、权限组';
            /*   $role->description = $this->description; */
            $authManager->add($role);
            return true;
        }else{
            return false;
        }
    }

    public function update($name){
        if($this->validate()){
            $authManager = Yii::$app->authManager;
            $role = $authManager->getRole($name);
            if(!$role) return false;
            $authManager->remove($role);

            $role = $authManager->createRole($this->name);
            $role->description = $this->description;
            $authManager->add($role);
            return true;
        }
        return false;
    }

    /**
     * 创建路由
     */
    public function createRole(){
        if($this->validate()){
            $auth = Yii::$app->authManager;
            $a = $auth->createPermission($this->name);
            $a->description = $this->description?:'创建了 ' . $this->name. '路由权限';;
            $auth->add($a);
            return true;
        }else{
            return false;
        }
    }

    public function UpdateRole($nid){
        if($this->validate()){
            $rbac = new RBAC();
            $item = $rbac->getOneItem($nid);
            $item->name = $this->name;
            $item->description = $this->description;
            $item->type = self::ROLE_Item;

            if($rbac->updateOneItem($nid,$item))
                return true;

        }
        return false;
    }

}