<?php

namespace Tadm\ui\component\grid\card;

use Tadm\ui\component\Component;

/**
 * 卡片 - 描述卡片
 * Class CardMeta
 * @link    https://next.antdv.com/components/card-cn 卡片组件
 * @method $this avatar(mixed $avatar) 头像/图标                                      									slot
 * @method $this description(mixed $description) 描述内容                                       							string|slot
 * @method $this title(mixed $title) 标题内容                                        									string|slot
 * @package Tadm\ui\component\form\field
 */
class CardMeta extends Component
{
	/**
     * 插槽
     * @var string[]
     */
    protected $slot = [
        'avatar',
        'description',
        'title',
    ];

    /**
     * 组件名称
     * @var string
     */
	protected $name = 'ACardMeta';

	
}