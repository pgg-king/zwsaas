<?php

namespace Tadm\ui\component\form\field\input;

use Tadm\ui\component\Component;

/**
 * 输入框组合
 * Class InputSearch
 * @link    https://next.antdv.com/components/input-cn 输入框组件
 * @method $this enterButton(mixed $set = false) 是否有确认按钮，可设为按钮文字。该属性会与 addon 冲突。						boolean|slot									boolean
 * @method $this loading(bool $loading) 搜索 loading																	boolean
 * @package Tadm\ui\component\form\field
 */
class InputSearch extends Input
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'enterButton',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'AInputSearch';

	
}
