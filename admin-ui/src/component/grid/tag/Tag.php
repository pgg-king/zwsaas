<?php

namespace Tadm\ui\component\grid\tag;

use Tadm\ui\component\common\Html;
use Tadm\ui\component\Component;

/**
 * 标签
 * Class Tag
 * @link    https://next.antdv.com/components/tag-cn 标签组件
 * @method $this closable(bool $closable = true) 标签是否可以关闭                                        				boolean
 * @method $this color(string $color) 标签色                                        										string
 * @method $this icon(string $icon) 图标                                        										string
 * @method $this visible(bool $visible = true) 是否显示标签                                 								boolean
 * @method static $this create($content) 创建
 * @package Tadm\ui\component\form\field
 */
class Tag extends Component
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
	protected $name = 'ATag';

	public function __construct($content)
    {
        parent::__construct();
        $this->content(Html::create($content));
    }
}
