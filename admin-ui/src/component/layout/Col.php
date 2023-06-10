<?php

namespace Tadm\ui\component\layout;

use Tadm\ui\component\Component;

/**
 * 列
 * Class Col
 * @link   https://next.antdv.com/components/grid-cn 列组件
 * @method $this flex(mixed $flex = 'top') flex 布局填充                                                                    string|number
 * @method $this offset(int $offset = 0) 栅格左侧的间隔格数，间隔内不可以有栅格                                               number
 * @method $this order(int $order = 0) 栅格顺序，flex 布局模式下有效                                                        number
 * @method $this pull(int $pull = 0) 栅格向左移动格数                                                                        number
 * @method $this push(int $push = 0) 栅格向右移动格数                                                                        number
 * @method $this span(int $span) 栅格占位格数，为 0 时相当于 display: none                                                    number
 * @method $this xs(mixed $warp = true) <576px 响应式栅格，可为栅格数或一个包含其他属性的对象                                    number|object
 * @method $this sm(mixed $warp = true) ≥576px 响应式栅格，可为栅格数或一个包含其他属性的对象                                    number|object
 * @method $this md(mixed $warp = true) ≥768px 响应式栅格，可为栅格数或一个包含其他属性的对象                                    number|object
 * @method $this lg(mixed $warp = true) ≥992px 响应式栅格，可为栅格数或一个包含其他属性的对象                                    number|object
 * @method $this xl(mixed $warp = true) ≥1200px 响应式栅格，可为栅格数或一个包含其他属性的对象                                    number|object
 * @method $this xxl(mixed $warp = true) ≥1600px 响应式栅格，可为栅格数或一个包含其他属性的对象                                number|object
 * @method $this xxxl(mixed $warp = true) ≥2000px 响应式栅格，可为栅格数或一个包含其他属性的对象                                number|object
 * @package Tadm\ui\component\form\field
 */
class Col extends Component
{
    /**
     * 组件名称
     * @var string
     */
    protected $name = 'ACol';

    /**
     * 添加一行
     * @param mixed $content
     * @return Row
     */
    public function row($content)
    {
        $row = Row::create();
        if ($content instanceof \Closure) {
            call_user_func($content, $row);
        } else {
            $row->column($content);
        }
        $this->content($row);
        return $row;
    }

    /**
     * 栅格占据的列数
     * @param int $value
     * @return $this
     */
    public function span(int $value)
    {
        $this->md($value);
        $sm = $value + $value / 2;
        if ($sm > 24) {
            $sm = 24;
        }
        $this->sm($sm);
        $xs = $value * 4;
        if ($xs > 24) {
            $xs = 24;
        }
        $this->xs($xs);
        return $this->attr(__FUNCTION__, $value);
    }
}
