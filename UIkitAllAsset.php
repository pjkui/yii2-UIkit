<?php
namespace pjkui\uikit;

use yii\web\AssetBundle;

/**
 * Plugins js code
 *
 * @author Quinn Pan <pjkui@qq.com>
 * @since 3.0
 */
class UIkitAllAsset extends AssetBundle
{
    public $sourcePath = '@vendor/uikit/uikit/dist';
    public $js = [
        'js/uikit.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'pjkui\uikit\UIkitAsset',
    ];
}