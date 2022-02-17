<?php
namespace pjkui\uikit;

use yii\web\AssetBundle;

/**
 * Gradient theme for UIkit
 *
 * @author Quinn Pan <pjkui@qq.com>
 * @since 3.0
 */
class UIkitGradientAsset extends AssetBundle
{
    public $sourcePath = '@vendor/uikit/uikit/dist';
    public $css = [
        'css/uikit.gradient.css',
    ];
    public $depends = [
        'pjkui\uikit\UIkitAsset',
    ];
}