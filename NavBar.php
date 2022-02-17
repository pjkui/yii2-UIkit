<?php
namespace pjkui\uikit;

use yii\helpers\Html;

/**
 * NavBar renders a navbar HTML component.
 *
 * Any content enclosed between the [[begin()]] and [[end()]] calls of NavBar
 * is treated as the content of the navbar. You may use widgets such as [[Nav]]
 * or [[\yii\widgets\Menu]] to build up such content. For example,
 *
 * ```php
 * use yii\uikit\NavBar;
 * use yii\uikit\Nav;
 *
 * NavBar::begin();
 * echo Nav::widget([
 *     'items' => [
 *         ['label' => 'Home', 'url' => ['/site/index']],
 *         ['label' => 'About', 'url' => ['/site/about']],
 *     ],
 * ]);
 * NavBar::end();
 * ```
 *
 * @see https://getuikit.com/docs/navbar
 * @author Quinn Pan <pjkui@qq.com>
 * @since 3.0
 */
class NavBar extends Widget
{
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = false;
        Html::addCssClass($this->options, 'uk-navbar');

        if (empty($this->options['role'])) {
            $this->options['role'] = 'navigation';
        }

        echo Html::beginTag('nav', $this->options);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::endTag('nav');
    }
}
