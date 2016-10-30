<?php
namespace backend\widgets;

/**
 * 后台siderbar插件
 */
use backend\models\Menu;
use common\lib\Util;
use yii\helpers\Url;
use yii;

class SidebarWidget{

    /**
     * 用户所有用的权限
     * @param $uid
     * @return mixed
     */
    public static function widget(){
       echo static::getAssignedMenu(Yii::$app->user->identity->id);
    }


    private static function getAssignedMenu($userId,$refresh = false){

        /* @var $manager \yii\rbac\BaseManager */
        $manager = Yii::$app->getAuthManager();
        $menus = Menu::find()->asArray()->indexBy('id')->all();
        $key = [__METHOD__, $userId, $manager->defaultRoles];

        if ($refresh || ($assigned = Yii::$app->cache->get($key)) === false) {
            $routes =  [];
            if ($userId !== null) {
                foreach ($manager->getPermissionsByUser($userId) as $name => $value) {
                    $routes[] = $name;
                }
            }
            $query = Menu::find()->select(['*'])->asArray();
            if (count($routes)) {
                $assigned = $query->where(['route' => $routes])->column();
            }
            $assigned = static::requiredParent($assigned, $menus);
            $MenuTree = static::normalizeMenu($assigned, $menus);
            return static::makeHtml($MenuTree);
        }

    }

    /**
     * 得到所有菜单
     * @param $assigned
     * @param $menus
     * @return mixed
     */
    private static function requiredParent($assigned, &$menus)
    {
        $l = count($assigned);
        for ($i = 0; $i < $l; $i++) {
            $id = $assigned[$i];
            $parent_id = $menus[$id]['parent'];
            if ($parent_id !== null && !in_array($parent_id, $assigned)) {
                $assigned[$l++] = $parent_id;
            }
        }
        return $assigned;
    }

    /**
     * 格式化菜单树
     * @param $assigned
     * @param $menus
     * @param null $parent
     * @return array
     */
    private static function normalizeMenu(&$assigned, &$menus,$parent = null)
    {
        $result = [];
        $order = [];
        foreach ($assigned as $id) {
            $menu = $menus[$id];
            if ($menu['parent'] == $parent) {
                $menu['children'] = static::normalizeMenu($assigned, $menus, $id);
                  $item = [
                        'label' => $menu['name'],
                        'ico' => $menu['data'],
                        'url' => $menu['route'],
                    ];
                    if ($menu['children'] != []) {
                        $item['items'] = $menu['children'];
                    }

                $result[] = $item;
                $order[] = $menu['order'];
            }
        }
        if ($result != []) {
            array_multisort($order, $result);
        }
        return $result;
    }

    /**
     * 生成html页面
     */
    private static function makeHtml($MenuTree){

        $html  = '<li class="active">';
        $html .=     '<a href="'.Url::to(['site/index']).'">';
        $html .=         '<i class="icon-dashboard"></i>';
        $html .=         '<span class="menu-text"> 控制台 </span>';
        $html .=     '</a>';
        $html .= '</li>';
        foreach($MenuTree as $item){
            $html .= '<li>';
            $html .=     '<a href="#" class="dropdown-toggle">';
            $html .=        '<i class="'.$item['ico'].'"></i>';
            $html .=        '<span class="menu-text">'.$item['label'].'</span>';
            $html .=        '<b class="arrow icon-angle-down"></b>';
            $html .=     '</a>';
            $html .=     '<ul class="submenu">';
            foreach($item['items'] as $child){
                $html   .=  '<li>';
                $html   .=      '<a href="'. Url::to([$child['url']]).'">';
                $html   .=        '<i class="icon-double-angle-right"></i>';
                $html   .=               $child['label'];
                $html   .=      '</a>';
                $html   .=  '</li>';
            }
            $html .=   '</ul>';
            $html .='</li>';
        }
        return $html;
    }

}