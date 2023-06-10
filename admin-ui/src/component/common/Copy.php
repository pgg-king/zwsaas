<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-01
 * Time: 11:43
 */

namespace Tadm\ui\component\common;


use Tadm\ui\component\Component;

/**
 * Class Copy
 * @package Tadm\ui\component\common
 * @method static $this create($copy = '') 创建
 */
class Copy extends Component
{
    public function __construct($content)
    {
        parent::__construct();
        $this->attr('data-tag', 'i')
            ->copy($content)
            ->style(['cursor' => 'pointer'])
            ->attr('class', ['far fa-copy', 'editable-cell-icon']);
    }
}