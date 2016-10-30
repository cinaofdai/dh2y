<?php
/**
 * Created by PhpStorm.
 * User: DaiHaoHeiYing
 * Date: 2016/7/9
 * Time: 23:50
 */
namespace common\core\back;

use common\core\base\BaseController;
use Yii;

class BaseBackController extends BaseController
{
    public function behaviors()
    {
        return [
            PermissionBehavior::className(),
            MessageBehavior::className(),
        ];
    }
}