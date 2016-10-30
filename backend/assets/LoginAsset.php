<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/30
 * Time: 23:50
 */

namespace backend\assets;


use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'ace/css/bootstrap.min.css',
        'ace/css/font-awesome.min.css',
        'ace/css/font-awesome-ie7.min.css',
        'ace/css/ace.min.css',
        'ace/css/ace-ie.min.css',
        'ace/css/ace-rtl.min.css',
    ];
    public $js = [
        'ace/js/bootstrap.min.js',
        'ace/js/js/typeahead-bs2.min.js',
        'ace/js/ace-elements.min.js',
        'ace/js/ace.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }

    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
}