<?php
namespace pjkui\uikit;

use yii\helpers\Html;

/**
 * Button renders a UIkit button.
 *
 * For example,
 *
 * ```php
 * use pjkui\uikit\Button;
 *
 * echo Button::widget([
 *     'label' => 'Action',
 *     'options' => ['class' => 'uk-button-primary'],
 * ]);
 * ```
 * @see https://getuikit.com/docs/button 
 * @author Quinn Pan <pjkui@qq.com>
 * @since 3.0
 */
class Button extends Widget
{
	/**
	 * @var string the tag to use to render the button
	 */
	public $tagName = 'button';
	/**
	 * @var string the button label
	 */
	public $label = 'Button';
	/**
	 * @var boolean whether the label should be HTML-encoded.
	 */
	public $encodeLabel = true;


	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		$this->clientOptions = false;
		Html::addCssClass($this->options, 'uk-button');
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::tag($this->tagName, $this->encodeLabel ? Html::encode($this->label) : $this->label, $this->options);
	}
}
