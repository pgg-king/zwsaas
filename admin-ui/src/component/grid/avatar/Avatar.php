<?php

namespace Tadm\ui\component\grid\avatar;

use Tadm\ui\component\Component;

/**
 * 头像
 * Class Avatar
 * @link    https://next.antdv.com/components/avatar-cn 头像组件
 * @method $this shape(string $shape = 'circle') 指定头像的形状                                                        	circle | square
 * @method $this size(mixed $size = 'default') 设置头像的大小                                                        		number | large | small | default | { xs: number, sm: number, ...}
 * @method $this src(string $src) 图片类头像的资源地址                                                        			string
 * @method $this srcset(string $srcset) 设置图片类头像响应式资源地址                                                        string
 * @method $this alt(string $alt) 图像无法显示时的替代文本                                                        			string
 * @method $this gap(int $gap = 4) 字符类型距离左右两侧边界单位像素                                                        	number
 * @method $this draggable(mixed $draggable) 图片是否允许拖动                                                        		boolean | 'true' | 'false'
 * @method $this icon(mixed $content) 图标
 * @package Tadm\ui\component\form\field
 */
class Avatar extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'icon',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'AAvatar';

	
}