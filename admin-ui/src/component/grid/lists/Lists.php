<?php

namespace Tadm\ui\component\grid\lists;

use Tadm\ui\component\Component;

/**
 * 列表
 * Class Grid
 * @link    https://next.antdv.com/components/list-cn 列表组件
 * @method $this bordered(bool $bordered = true) 是否展示边框                                        					boolean
 * @method $this footer(mixed $footer) 列表底部                                        									string|slot
 * @method $this header(mixed $header) 列表头部                                        									string|slot
 * @method $this itemLayout(string $itemLayout) 设置 List.Item 布局, 设置成 vertical 则竖直样式显示, 默认横排               string
 * @method $this loading(mixed $loading = true) 	当卡片内容还在加载中时，可以用 loading 展示一个占位                      boolean|object
 * @method $this loadMore(mixed $loadMore) 加载更多                                        								string|slot
 * @method $this locale(mixed $locale) 默认文案设置，目前包括空数据文案                                        				object
 * @method $this pagination(mixed $pagination = true) 对应的 pagination 配置, 设置 false 不显示                           boolean|object
 * @method $this size(string $size = 'default') list 的尺寸                                        						default | middle | small
 * @method $this split(bool $split) 是否展示分割线                                        								boolean
 * @method $this dataSource(mixed $dataSource) 是否展示分割线                                        						any[]
 * @package Tadm\ui\component\form\field
 */
class Lists extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'footer',
        'header',
        'loadMore',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'AList';

    /**
     * 列表栅格配置
     * @param int $gutter 栅格间隔
     * @param int $column 列数
     * @return $this
     */
    public function grid($gutter,$column){
        $sm = $column / 2;
        if ($sm < 1) {
            $sm = 1;
        }
        $xs = $column / 4;
        if ($xs < 1) {
            $xs = 1;
        }
        $this->attr('grid',['gutter'=>$gutter,'column'=>$column,'md'=>$column,'sm'=>$sm,'xs'=>$xs]);
        return $this;
    }
}
