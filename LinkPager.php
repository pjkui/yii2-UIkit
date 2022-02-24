<?php

namespace pjkui\uikit;

/**
 * pjkui\uikit\LinkPager is the base class for all UIkit widgets.
 *
 * @author Quinn Pan <pjkui@qq.com>
 * @since 3.0
 */
class LinkPager extends \yii\widgets\LinkPager
{
    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->options = ['class' => 'uk-pagination uk-flex-center'];
        $this->activePageCssClass = 'uk-active';
        $this->disabledPageCssClass = 'uk-disable';
    }

}