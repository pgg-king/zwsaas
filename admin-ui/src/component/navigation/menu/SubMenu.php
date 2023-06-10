<?php

namespace Tadm\ui\component\navigation\menu;

use Tadm\ui\component\Component;

/**
 * 菜单
 * Class SubMenu
 * @link    https://next.antdv.com/components/menu-cn 菜单组件
 * @method $this popupClassName(string $popupClassName) 是否禁用                            	string
 * @method $this disabled(bool $disabled = true) 是否禁用                            		boolean
 * @method $this key(string $key) 唯一标志, 必填                            					string
 * @method $this title(mixed $title) 子菜单项值                           					string|slot
 * @method $this expandIcon(mixed $expandIcon) 自定义 Menu 展开收起图标                       slot
 * @method $this icon(mixed $icon) 菜单图标                           						slot
 * @package Tadm\ui\component\form\field
 */
class SubMenu extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'title',
        'expandIcon',
        'icon',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ASubMenu';

	
}