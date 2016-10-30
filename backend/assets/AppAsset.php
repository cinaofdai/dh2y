<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'ace/css/bootstrap.min.css',
        'ace/css/font-awesome.min.css',
        'ace/css/ace.min.css',
        'ace/css/ace-rtl.min.css',
        'ace/css/ace-skins.min.css',
    ];
    public $js = [
        //'ace/js/ace-extra.min.js', //头部引入
        'ace/js/bootstrap.min.js',
        'ace/js/typeahead-bs2.min.js',
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
