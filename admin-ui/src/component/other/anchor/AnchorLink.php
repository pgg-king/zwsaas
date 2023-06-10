<?php

namespace Tadm\ui\component\other\anchor;

use Tadm\ui\component\Component;

/**
 * 锚点
 * Class AnchorLink
 * @link    https://next.antdv.com/components/anchor-cn 锚点组件
 * @method $this href(string $href) 锚点链接                                  											string
 * @method $this title(mixed $title) 文字内容                                        									string|slot
 * @method $this target(string $target) 该属性指定在何处显示链接的资源。                            						string
 * @package Tadm\ui\component\form\field
 */
class AnchorLink extends Component
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
	protected $name = 'AAnchorLink';

	
}