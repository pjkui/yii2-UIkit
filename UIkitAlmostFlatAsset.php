<?php
namespace pjkui\uikit;

use yii\web\AssetBundle;

/**
 * Almost flat theme for UIkit
 *
 * @author Quinn Pan <pjkui@qq.com>
 * @since 3.0
 */
class UIkitAlmostFlatAsset extends AssetBundle
{
    public $sourcePath = '@vendor/uikit/uikit/dist';
    public $css = [
        'css/uikit.almost-flat.css',
    ];
    public $depends = [
        'pjkui\uikit\UIkitAsset',
    ];
}