<?php

namespace Tadm\ui\component\navigation\menu;

use Tadm\ui\component\Component;

/**
 * 菜单
 * Class MenuItemGroup
 * @link    https://next.antdv.com/components/menu-cn 菜单组件
 * @method $this title(mixed $title) 分组标题                            	string|function|slot
 * @package Tadm\ui\component\form\field
 */
class MenuItemGroup extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'title',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ASubMenu';

	
}