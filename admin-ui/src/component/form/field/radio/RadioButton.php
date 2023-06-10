<?php

namespace Tadm\ui\component\form\field\radio;

use Tadm\ui\component\Component;

/**
 * 单选框 - 按钮
 * Class RadioButton
 * @link    https://next.antdv.com/components/radio-cn 单选框组件
 * @method $this autofocus(bool $focus = false) 自动获取焦点																boolean
 * @method $this checked(bool $checked = false) 指定当前是否选中															boolean
 * @method $this disabled(bool $disabled = false) 禁用 Radio															boolean
 * @package Tadm\ui\component\form\field
 */
class RadioButton extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'closeText',
        'description',
        'message',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ARadioButton';

	
}