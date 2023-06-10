<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 2022-07-13
 * Time: 16:57
 */

namespace Tadm\ui\component\form\field\input;


use Tadm\ui\component\form\FormItem;


class Hidden extends Input
{
    public function __construct($field = null, $value = '')
    {
        parent::__construct($field, $value);
        $this->type('hidden');
    }

    /**
     * @param FormItem $formItem
     */
    public function setFormItem($formItem)
    {
        parent::setFormItem($formItem);
        $field = $this->random();
        $this->exceptField($field);
        $formItem->bind($field, 1);
        $formItem->whereShow($field, 0);
    }
}
