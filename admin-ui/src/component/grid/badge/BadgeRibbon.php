<?php

namespace Tadm\ui\component\grid\badge;

use Tadm\ui\component\Component;

/**
 * 徽标数
 * Class BadgeRibbon
 * @link    https://next.antdv.com/components/badge-cn 徽标数组件
 * @method $this color(string $color) 自定义缎带的颜色                                        							string
 * @method $this placement(string $placement = 'end') 缎带的位置，start 和 end 随文字方向（RTL 或 LTR）变动                 string
 * @method $this text(mixed $text) 缎带中填入的内容                                      									string | VNode | slot
 * @method static $this create($content='') 创建
 * @package Tadm\ui\component\form\field
 */
class BadgeRibbon extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'text',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ABadgeRibbon';
    public function __construct($content='')
    {
        parent::__construct();
        if($content){
            $this->content($content);
        }
    }
	
}