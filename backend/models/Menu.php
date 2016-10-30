<?php

namespace backend\models;

use common\lib\Util;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id Menu id(autoincrement)
 * @property string $name Menu name
 * @property integer $parent Menu parent
 * @property string $route Route for this menu
 * @property integer $order Menu order
 * @property string $data Extra information for this menu
 *
 * @property Menu $menuParent Menu parent
 * @property Menu[] $menus Menu children
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Menu extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent', 'route', 'data', 'order'], 'default'],
            [['parent'], 'filterParent', 'when' => function() {
                return !$this->isNewRecord;
            }],
            [['order'], 'integer'],
            [['route'], 'in',
                'range' => static::getSavedRoutes(),
                'message' => '路由 "{value}" 不存在.']
        ];
    }

    /**
     * Use to loop detected.
     */
    public function filterParent()
    {
        $parent = $this->parent;
        $db = static::getDb();
        $query = (new Query)->select(['parent'])
            ->from(static::tableName())
            ->where('[[id]]=:id');
        while ($parent) {
            if ($this->id == $parent) {
                $this->addError('parent_name', 'Loop detected.');
                return;
            }
            $parent = $query->params([':id' => $parent])->scalar($db);
        }
    }

    /**
     * 得到安全路由 routes.
     * @return array
     */
    private static $_routes;
    public static function getSavedRoutes()
    {
        if (self::$_routes === null) {
            self::$_routes = [];
            foreach (Yii::$app->getAuthManager()->getPermissions() as $name => $value) {
                self::$_routes[] = $name;
            }
        }
        return self::$_routes;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '菜单名称',
            'parent' => '父级菜单',
            'route' => '路由',
            'order' => '排序',
            'data' => '字体图标',
        ];
    }

    /**
     * 构造菜单选着列表
     * @return array
     */
    public function getOptions()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        $tree = $this->set2Prefix($tree);
        $options = ['添加顶级分类'];
        foreach($tree as $cate) {
            $options[$cate['id']] = $cate['name'];
        }
        return $options;
    }

    /**
     * 菜单树形列表
     * @return mixed
     */
    public function getTreeList()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        return $tree = $this->setPrefix($tree);
    }

    /**
     * 得到菜单数据
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getData()
    {
        $cates = self::find()->all();
        $cates = ArrayHelper::toArray($cates);
        return $cates;
    }

    /**
     * 构造菜单数-数组
     * @param $cates
     * @param int $pid
     * @return array
     */
    public function getTree($cates, $pid = null)
    {
        $tree = [];
        foreach($cates as $cate) {
            if ($cate['parent'] == $pid) {
                $tree[] = $cate;
                $tree = array_merge($tree, $this->getTree($cates, $cate['id']));
            }
        }
        return $tree;
    }

    /**
     * 设置树形前缀
     * @param $data
     * @param string $p
     * @return array
     */
    public function setPrefix($data, $p = "|-----")
    {
        $tree = [];
        $num = 1;
        $prefix = [0 => 1];
        while($val = current($data)) {
            $key = key($data);
            if ($key > 0) {
                if ($data[$key - 1]['parent'] != $val['parent']) {
                    $num ++;
                }
            }
            if (array_key_exists($val['parent'], $prefix)) {
                $num = $prefix[$val['parent']];
            }
            $val['name'] = str_repeat($p, $num).$val['name'];
            $prefix[$val['parent']] = $num;
            $tree[] = $val;
            next($data);
        }
        return $tree;
    }

    /**
     * 设置2级树形前缀
     * @param $data
     * @param string $p
     * @return array
     */
    public function set2Prefix($data, $p = "|-----")
    {
        $tree = [];
        $num = 1;
        $prefix = [0 => 1];
        while($val = current($data)) {
            $key = key($data);
            if ($key > 0) {
                if ($data[$key - 1]['parent'] != $val['parent']) {
                    $num ++;
                }
            }
            if (array_key_exists($val['parent'], $prefix)) {
                $num = $prefix[$val['parent']];
            }
            $Prefix = str_repeat($p, $num);
            if($Prefix!=='|-----|-----'){
                $val['name'] = $Prefix.$val['name'];
                $prefix[$val['parent']] = $num;
                $tree[] = $val;
            }
            next($data);
        }
        return $tree;
    }

    /**
     * 添加菜单
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $data['Menu']['parent']=$data['Menu']['parent']==0?NULL:$data['Menu']['parent'];
        if ($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }

    /**
     * Get menu parent
     * @return \yii\db\ActiveQuery
     */
    public function getMenuParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent']);
    }

    /**
     * Get menu children
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }


}
