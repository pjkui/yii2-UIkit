<?php
namespace pjkui\uikit;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 3.0
 */
class PrismAsset extends AssetBundle
{
    public $sourcePath = '@vendor/prismjs/prism/';
    public $css = [
        'themes/prism.css',
    ];
    public $publishOptions = [
        'only' => [
            'plugins/*',
            'themes/*',
        ]
    ];
    public $js = [
        'prism.js'
    ];
}