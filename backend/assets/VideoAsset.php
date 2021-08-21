<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 26.03.2020
 * Time: 9:52
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

namespace backend\assets;

use yii\web\AssetBundle;


class VideoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/video.css',
    ];
    public $js = [
        'js/video/jwplayer.js',
        'js/video.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
