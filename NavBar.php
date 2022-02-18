<?php
namespace pjkui\uikit;

use yii\helpers\Html;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * NavBar renders a navbar HTML component.
 *
 * Any content enclosed between the [[begin()]] and [[end()]] calls of NavBar
 * is treated as the content of the navbar. You may use widgets such as [[Nav]]
 * or [[\yii\widgets\Menu]] to build up such content. For example,
 *
 * ```php
 * use yii\bootstrap4\NavBar;
 * use yii\bootstrap4\Nav;
 *
 * NavBar::begin(['brandLabel' => 'NavBar Test']);
 * echo Nav::widget([
 *     'items' => [
 *         ['label' => 'Home', 'url' => ['/site/index']],
 *         ['label' => 'About', 'url' => ['/site/about']],
 *     ],
 *     'options' => ['class' => 'navbar-nav'],
 * ]);
 * NavBar::end();
 * ```
 *
 * @see https://getbootstrap.com/docs/4.5/components/navbar/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class NavBar extends Widget
{
    /**
     * @var array the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "nav", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
    /**
     * @var array the HTML attributes for the container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $collapseOptions = [];
    /**
     * @var string|bool the text of the brand or false if it's not used. Note that this is not HTML-encoded.
     * @see https://getbootstrap.com/docs/4.5/components/navbar/
     */
    public $brandLabel = false;
    /**
     * @var string|bool src of the brand image or false if it's not used. Note that this param will override `$this->brandLabel` param.
     * @see https://getbootstrap.com/docs/4.5/components/navbar/
     * @since 2.0.8
     */
    public $brandImage = false;
    /**
     * @var array|string|bool $url the URL for the brand's hyperlink tag. This parameter will be processed by [[\yii\helpers\Url::to()]]
     * and will be used for the "href" attribute of the brand link. Default value is false that means
     * [[\yii\web\Application::homeUrl]] will be used.
     * You may set it to `null` if you want to have no link at all.
     */
    public $brandUrl = false;
    /**
     * @var array the HTML attributes of the brand link.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $brandOptions = [];
    /**
     * @var string text to show for screen readers for the button to toggle the navbar.
     */
    public $screenReaderToggleText = 'Toggle navigation';
    /**
     * @var string the toggle button content. Defaults to bootstrap 4 default `<span class="navbar-toggler-icon"></span>`
     */
    public $togglerContent = '  <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left">Menu</span>';
    /**
     * @var array the HTML attributes of the navbar toggler button.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $togglerOptions = [];

    /**
     * {@inheritdoc}
     */
    public $clientOptions = false;


    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['class']) || empty($this->options['class'])) {
            \yii\bootstrap4\Html::addCssClass($this->options, [
                'widget' => 'navbar',
                'toggle' => 'navbar-expand-lg',
            ]);
        } else {
            Html::addCssClass($this->options, ['uk-navbar' => true]);
        }

        Html::addCssClass($this->options, ['uk-navbar', "uk-navbar-container", 'uk-margin']);
        $this->options['uk-navbar'] = true;
        $navOptions = $this->options;
        $navTag = ArrayHelper::remove($navOptions, 'tag', 'nav');
        $brand = '';

        if (!isset($this->collapseOptions['id'])) {
            $this->collapseOptions['id'] = "{$this->options['id']}-collapse";
        }
        if ($this->brandImage !== false) {
            $this->brandLabel = Html::img($this->brandImage);
        }
        if ($this->brandLabel !== false) {
            Html::addCssClass($this->brandOptions, ['widget' => 'navbar-brand']);
            if ($this->brandUrl === null) {
                $brand = Html::tag('span', $this->brandLabel, $this->brandOptions);
            } else {
                $brand = Html::a(
                    $this->brandLabel,
                    $this->brandUrl === false ? Yii::$app->homeUrl : $this->brandUrl,
                    $this->brandOptions
                );
            }
        }
        Html::addCssClass($this->collapseOptions, ['collapse' => 'collapse', 'widget' => 'navbar-collapse']);
        $collapseOptions = $this->collapseOptions;
        $collapseTag = ArrayHelper::remove($collapseOptions, 'tag', 'div');

        echo Html::beginTag($navTag, $navOptions) . "\n";
        echo Html::beginTag('div', ['class'=>'uk-navbar-left']) ."\n";
        echo $brand . "\n";
        echo Html::endTag('div');

        echo Html::beginTag('div', ['class'=>'uk-navbar-right']) ."\n";

        echo $this->renderToggleButton() . "\n";
        echo Html::beginTag($collapseTag, $collapseOptions) . "\n";
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $tag = ArrayHelper::remove($this->collapseOptions, 'tag', 'div');
        echo Html::endTag($tag) . "\n";

        echo Html::endTag('div');//end of right navbar
        $tag = ArrayHelper::remove($this->options, 'tag', 'nav');

        echo Html::endTag($tag);
        UIkitAllAsset::register($this->getView());
    }

    /**
     * Renders collapsible toggle button.
     * @return string the rendering toggle button.
     */
    protected function renderToggleButton()
    {
        $options = $this->togglerOptions;
        Html::addCssClass($options, ['widget' => 'uk-navbar-toggle']);
        return Html::a(
            $this->togglerContent,
            $options['href'],
            ArrayHelper::merge($options, [
                'uk-toggle'=>true,
            ])
        );
    }

    /**
     * Container options setter for backwards compatibility
     * @param array $collapseOptions
     * @deprecated
     */
    public function setContainerOptions($collapseOptions)
    {
        $this->collapseOptions = $collapseOptions;
    }
}
