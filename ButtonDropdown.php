<?php

namespace pjkui\uikit;

use yii\helpers\Html;

/**
 * ButtonDropdown renders a group or split button dropdown component.
 *
 * For example,
 *
 * ```php
 * // a button group using Dropdown widget
 * echo ButtonDropdown::widget([
 *     'label' => 'Action',
 *     'dropdown' => [
 *         'items' => [
 *             ['label' => 'DropdownA', 'url' => '/'],
 *             ['label' => 'DropdownB', 'url' => '#'],
 *         ],
 *     ],
 * ]);
 * ```
 * @see https://getuikit.com/docs/button
 * @see https://getuikit.com/docs/dropdown
 * @author Quinn Pan <pjkui@qq.com>
 * @since 3.0
 */
class ButtonDropdown extends Widget
{
	/**
	 * @var string the button label
	 */
	public $label = 'Button';
	/**
	 * @var array the HTML attributes of the button.
	 */
	public $options = [];
	/**
	 * @var array the configuration array for [[Dropdown]].
	 */
	public $dropdown = [];
	/**
	 * @var boolean whether to display a group of split-styled button group.
	 */
	public $split = false;


	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo $this->renderButton() . "\n" . $this->renderDropdown();
		$this->registerPlugin('button');
	}

	/**
	 * Generates the button dropdown.
	 * @return string the rendering result.
	 */
	protected function renderButton()
	{
		Html::addCssClass($this->options, 'btn');
		if ($this->split) {
			$tag = 'button';
			$options = $this->options;
			$this->options['data-toggle'] = 'dropdown';
			Html::addCssClass($this->options, 'dropdown-toggle');
			$splitButton = Button::widget([
				'label' => '<span class="caret"></span>',
				'encodeLabel' => false,
				'options' => $this->options,
			]);
		} else {
			$tag = 'a';
			$this->label .= ' <span class="caret"></span>';
			$options = $this->options;
			if (!isset($options['href'])) {
				$options['href'] = '#';
			}
			Html::addCssClass($options, 'dropdown-toggle');
			$options['data-toggle'] = 'dropdown';
			$splitButton = '';
		}
		return Button::widget([
			'tagName' => $tag,
			'label' => $this->label,
			'options' => $options,
			'encodeLabel' => false,
		]) . "\n" . $splitButton;
	}

	/**
	 * Generates the dropdown menu.
	 * @return string the rendering result.
	 */
	protected function renderDropdown()
	{
		$config = $this->dropdown;
		$config['clientOptions'] = false;
		return Dropdown::widget($config);
	}
}
