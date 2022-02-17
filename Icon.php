<?php
namespace pjkui\uikit;

use yii\helpers\Html;
use yii\base\InvalidConfigException;

/**
 * Icon renders a UIkit icon
 *
 * For example,
 *
 * ```php
 * echo Icon::widget(['name' => 'fast-backward']);
 * ]);
 * ```
 * @see https://getuikit.com/docs/icon
 * @author Quinn Pan <pjkui@qq.com>
 * @since 3.0
 */
class Icon extends Widget
{

    /**
     * @var string the icon name
     */
    public $name = '';

    /**
     * Renders the widget.
     */
    public function run()
    {
        if (!$this->name) {
            throw new InvalidConfigException("The 'name' option is required.");
        }

        echo Html::tag('i', '', ['class' => 'uk-icon-' . $this->name]);
    }
}
