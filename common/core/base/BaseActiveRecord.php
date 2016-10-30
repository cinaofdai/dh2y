<?php
/**
 * Created by PhpStorm.
 * User: DaiHaoHeiYing
 * Date: 2016/7/9
 * Time: 23:41
 */
namespace common\core\base;
use Yii;
use yii\db\ActiveRecord;


class BaseActiveRecord extends ActiveRecord
{

    public function afterValidate()
    {
        parent::afterValidate();
        if($this->hasErrors()){
            var_dump($this->errors);
        }
    }
}