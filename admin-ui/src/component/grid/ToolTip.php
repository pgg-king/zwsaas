<?php

namespace Tadm\ui\component\grid;

use Tadm\ui\component\common\Html;
use Tadm\ui\component\Component;

/**
 * 文字提醒
 * Class ToolTip
 * @link    https://next.antdv.com/components/tooltip-cn 气泡卡片组件
 * @method $this title(mixed $title) 卡片标题                                        									string|slot
 * @method $this arrowPointAtCenter(bool $arrowPointAtCenter = false) 箭头是否指向目标元素中心                             boolean
 * @method $this autoAdjustOverflow(bool $autoAdjustOverflow = true) 气泡被遮挡时自动调整位置                              boolean
 * @method $this color(string $color) 背景颜色                                        									string
 * @method $this defaultVisible(bool $defaultVisible = false) 默认是否显隐                                        		boolean
 * @method $this mouseEnterDelay(int $mouseEnterDelay = 0.1) 鼠标移入后延时多少才显示 Tooltip，单位：秒                     number
 * @method $this mouseLeaveDelay(int $mouseLeaveDelay = 0.1) 鼠标移出后延时多少才隐藏 Tooltip，单位：秒                     number
 * @method $this overlayClassName(string $overlayClassName) 卡片类名                                        				string
 * @method $this overlayStyle(mixed $overlayStyle) 卡片样式                                        						object
 * @method $this placement(string $placement = 'top') 气泡框位置，可选 top left right bottom topLeft topRight
 * 														bottomLeft bottomRight leftTop leftBottom rightTop rightBottom  string
 * @method $this trigger(string $trigger = 'hover') 触发行为，可选 hover/focus/click/contextmenu                          string
 * @method $this visible(bool $visible = false) 用于手动控制浮层显隐                                        				boolean
 * @method $this destroyTooltipOnHide(bool $destroyTooltipOnHide = false) 隐藏后是否销毁 tooltip                          boolean
 * @method $this align(mixed $align) 该值将合并到 placement 的配置中，设置参考 dom-align                                    Object
 * @method static $this create($content='') 创建
 * @package Tadm\ui\component\form\field
 */
class ToolTip extends Component
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
	protected $name = 'ATooltip';

    public function __construct($content='')
    {
        parent::__construct();
        if($content){
            $this->content(Html::create($content));
        }
    }


}
