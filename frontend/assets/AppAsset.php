<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
		'css/flexslider.css',
		'css/jquery-ui.css',
    ];
    public $js = [
		'js/simpleCart.min.js',
		'js/jquery-2.1.4.min.js',
		'js/bootstrap.min.js',
		'js/imagezoom.js',
		'js/jquery.flexslider.js',
		'js/productPage.js',
		
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
