<?php

namespace Tadm\ui\component\navigation\menu;

use Tadm\ui\component\common\Icon;
use Tadm\ui\component\Component;

/**
 * 菜单
 * Class Menu
 * @link    https://next.antdv.com/components/menu-cn 菜单组件
 * @method $this forceSubMenuRender(bool $forceSubMenuRender = true) 在子菜单展示之前就渲染进 DOM                            boolean
 * @method $this inlineCollapsed(bool $inlineCollapsed) inline 时菜单是否收起状态                                            boolean
 * @method $this inlineIndent(int $inlineIndent = 24) inline 模式的菜单缩进宽度                                            number
 * @method $this mode(string $mode = 'vertical') 菜单类型，现在支持垂直、水平、和内嵌模式三种                                    string
 * @method $this multiple(bool $multiple = true) 是否允许多选                                                            boolean
 * @method $this openKeys(mixed $openKeys) 当前展开的 SubMenu 菜单项 key 数组                                                string[]
 * @method $this selectable(bool $selectable = true) 是否允许选中                                                            boolean
 * @method $this selectedKeys(mixed $selectedKeys) 当前选中的菜单项 key 数组                                                string[]
 * @method $this subMenuCloseDelay(int $subMenuCloseDelay = 0.1) 用户鼠标离开子菜单后关闭延时，单位：秒                        number
 * @method $this subMenuOpenDelay(int $forceSubMenuRender = 0) 用户鼠标进入子菜单后开启延时，单位：秒                            number
 * @method $this theme(string $theme = 'light') 主题颜色                                                                    string: light dark
 * @method $this triggerSubMenuAction(string $triggerSubMenuAction = 'hover') 修改 Menu 子菜单的触发方式                    click | hover
 * @package Tadm\ui\component\form\field
 */
class Menu extends Component
{
    /**
     * 组件名称
     * @var string
     */
    protected $name = 'AMenu';

    /**
     * 下拉菜单选项
     * @param mixed $content
     * @param string $icon 图标
     * @param int $type 1追加尾部 2追加前面
     * @return MenuItem
     */
    public function item($content, $icon = null,$type=1)
    {
        $item = MenuItem::create($this,$type)
            ->content($content);
        if($icon){
            $item->icon(Icon::create($icon));
        }
        if($type == 1){
            $function = 'array_push';
        }else{
            $function = 'array_unshift';
        }
        if(isset($this->content['default'])){
            $function($this->content['default'],$item);
        }else{
            $this->content['default'][] = $item;
        }
        return $item;
    }

}
