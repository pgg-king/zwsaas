<?php

namespace Tadm\ui\component\form\field;

use Tadm\ui\component\form\Field;
use Tadm\ui\component\form\RangeField;

/**
 * NumberRange
 * @method $this separator(string $value = '-') 设置分隔符
 * @mixin InputNumber
 */
class NumberRange extends RangeField
{
    protected $name = 'ExNumberRange';
    public function __construct($startField, $endField, $value = [])
    {
        $this->attr('type','number');
        parent::__construct($startField, $endField, $value);
    }
}
