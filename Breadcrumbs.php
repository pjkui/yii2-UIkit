<?php

namespace pjkui\uikit;

use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * Breadcrumbs displays a list of links indicating the position of the current page in the whole site hierarchy.
 *
 * For example, breadcrumbs like "Home / Sample Post / Edit" means the user is viewing an edit page
 * for the "Sample Post". He can click on "Sample Post" to view that page, or he can click on "Home"
 * to return to the homepage.
 *
 * To use Breadcrumbs, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo Breadcrumbs::widget([
 *     'links' => [
 *         ['label' => 'Sample Post', 'url' => ['post/edit', 'id' => 1]],
 *         'Edit',
 *     ],
 * ]);
 * ~~~
 *
 * Because breadcrumbs usually appears in nearly every page of a website, you may consider placing it in a layout view.
 * You can use a view parameter (e.g. `$this->params['breadcrumbs']`) to configure the links in different
 * views. In the layout view, you assign this view parameter to the [[links]] property like the following:
 *
 * ~~~
 * // $this is the view object currently being used
 * echo Breadcrumbs::widget([
 *     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
 * ]);
 * ~~~
 *
 * @see https://getuikit.com/docs/breadcrumb
 * @author Quinn Pan <pjkui@qq.com>
 * @since 3.0
 */
class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    /**
     * @var string the name of the breadcrumb container tag.
     */
    public $tag = 'ul';
    /**
     * @var array the HTML attributes for the breadcrumb container tag.
     */
    public $options = ['class' => 'uk-breadcrumb'];
    /**
     * @var boolean whether to HTML-encode the link labels.
     */
    public $encodeLabels = true;
    /**
     * @var string the first hyperlink in the breadcrumbs (called home link).
     * If this property is not set, it will default to a link pointing to [[\yii\web\Application::homeUrl]]
     * with the label 'Home'. If this property is false, the home link will not be rendered.
     */
    public $homeLink;
    /**
     * @var array list of links to appear in the breadcrumbs. If this property is empty,
     * the widget will not render anything. Each array element represents a single link in the breadcrumbs
     * with the following structure:
     *
     * ~~~
     * [
     *     'label' => 'label of the link',  // required
     *     'url' => 'url of the link',      // optional, will be processed by Html::url()
     * ]
     * ~~~
     *
     * If a link is active, you only need to specify its "label", and instead of writing `['label' => $label]`,
     * you should simply use `$label`.
     */
    public $links = [];
    /**
     * @var string the template used to render each inactive item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each inactive item.
     */
    public $itemTemplate = "<li>{link}</li>\n";
    /**
     * @var string the template used to render each active item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each active item.
     */
    public $activeItemTemplate = "<li class=\"uk-active\">{link}</li>\n";

    /**
     * Renders a single breadcrumb item.
     * @param array $link the link to be rendered. It must contain the "label" element. The "url" element is optional.
     * @param string $template the template to be used to rendered the link. The token "{link}" will be replaced by the link.
     * @return string the rendering result
     * @throws InvalidConfigException if `$link` does not have "label" element.
     */
    public function renderItem($link, $template): string
    {
        if (isset($link['label'])) {
            $label = $this->encodeLabels ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }
        if (isset($link['url'])) {
            return strtr($template, ['{link}' => Html::a($label, $link['url'])]);
        } else {
            return strtr($template, ['{link}' => Html::tag('span', $label)]);
        }
    }
}
