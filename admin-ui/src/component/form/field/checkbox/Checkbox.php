<?php

namespace Tadm\ui\component\form\field\checkbox;

use Tadm\ui\component\Component;
use Tadm\ui\component\form\Field;

/**
 * 多选框
 * Class Checkbox
 * @link   https://next.antdv.com/components/checkbox-cn 多选框组件
 * @method $this autofocus(bool $focus = true) 	自动获取焦点															boolean
 * @method $this checked(bool $checked = true) 指定当前是否选中															boolean
 * @method $this disabled(bool $disabled = true) 失效状态																boolean
 * @method $this indeterminate(bool $disabled = true) 设置 indeterminate 状态，只负责样式控制								boolean
 * @package Tadm\ui\component\form\field
 */
class Checkbox extends Field
{
    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ACheckbox';

	protected $vModel = 'checked';

	public function __construct($field = null, $value = false)
    {
        parent::__construct($field, $value);
    }
}
