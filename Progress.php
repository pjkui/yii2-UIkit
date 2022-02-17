<?php
namespace pjkui\uikit;

use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * Progress renders a UIkit progress bar component.
 *
 * For example,
 *
 * ```php
 * // default with label
 * echo Progress::widget([
 *     'percent' => 60,
 *     'label' => 'test',
 * ]);
 *
 * // styled
 * echo Progress::widget([
 *     'percent' => 65,
 *     'barOptions' => ['class' => 'uk-progress-success']
 * ]);
 *
 * // striped
 * echo Progress::widget([
 *     'percent' => 70,
 *     'options' => ['class' => 'uk-progress-striped']
 * ]);
 *
 * // striped animated
 * echo Progress::widget([
 *     'percent' => 70,
 *     'options' => ['class' => 'uk-progress-striped uk-active']
 * ]);
 *
 * ```
 * @see http://www.getuikit.com/docs/progress.html
 * @author Quinn Pan <pjkui@qq.com>
 * @since 3.0
 */
class Progress extends Widget
{
	/**
	 * @var string the button label
	 */
	public $label;
	/**
	 * @var integer the amount of progress as a percentage.
	 */
	public $percent = 0;
	/**
	 * @var array the HTML attributes of the
	 */
	public $barOptions = [];

	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		Html::addCssClass($this->options, 'uk-progress');
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::beginTag('div', $this->options) . "\n";
		echo $this->renderProgress() . "\n";
		echo Html::endTag('div') . "\n";
		UIkitAsset::register($this->getView());
	}

	/**
	 * Renders the progress.
	 * @return string the rendering result.
	 * @throws InvalidConfigException if the "percent" option is not set in a stacked progress bar.
	 */
	protected function renderProgress()
	{
        return $this->renderBar($this->percent, $this->label, $this->barOptions);
	}

	/**
	 * Generates a bar
	 * @param int $percent the percentage of the bar
	 * @param string $label, optional, the label to display at the bar
	 * @param array $options the HTML attributes of the bar
	 * @return string the rendering result.
	 */
	protected function renderBar($percent, $label = '', $options = [])
	{
		Html::addCssClass($options, 'uk-progress-bar');
		$options['style'] = "width:{$percent}%";
		return Html::tag('div', $label, $options);
	}
}
